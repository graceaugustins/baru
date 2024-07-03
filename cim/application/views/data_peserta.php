<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('components/head'); ?>
    <title>Data Peserta Sertifikasi</title>
</head>

<body class="antialiased">
    <div class="page">
        <?php $this->load->view('components/home_navbar'); ?>
        <div class="content">
            <div class="container-xl">
                <div class="row row-cards">
                    <!-- Left side with photo -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img-top img-responsive img-responsive-1x1" style="background-image: url(<?php echo base_url(config_item('UPLOAD_FOTO_PROFIL')['upload_path'] . $user->file_fotoprofil); ?>)"></div>
                            <div class="card-body text-center">
                                <h3 class="card-title mb-2"><?php echo $user->nama_depan . ' ' . $user->nama_belakang; ?></h3>
                                <p class="text-muted"><?php echo strtoupper($user->tipe_user); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Right side with user data -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Biodata Saya</h3>
                            </div>
                            <div class="card-body">
                                <!-- Your table content goes here -->

                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td style="width: 1px;">:</td>
                                            <td><?php echo $user->nama_depan . ' ' . $user->nama_belakang; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td style="width: 1px;">:</td>
                                            <td>
                                                <?php
                                                if ($user->jenis_kelamin === General_Constants::LAKI_LAKI)
                                                    echo 'Laki-laki';
                                                else echo 'Perempuan';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td style="width: 1px;">:</td>
                                            <td><?php echo $user->email; ?></td>
                                        </tr>
                                        <?php if ($user->tipe_user === General_Constants::ITPLN) { ?>
                                            <tr>
                                                <th>Posisi & Jabatan</th>
                                                <td style="width: 1px;">:</td>
                                                <td>
                                                    <?php echo $me->jabatan->nama_jabatan; ?>
                                                    -
                                                    <?php echo $me->jabatan->nama_program; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ($user->tipe_user === General_Constants::MAHASISWA) { ?>
                                            <tr>
                                                <th>Fakultas</th>
                                                <td style="width: 1px;">:</td>
                                                <td>
                                                    <?php
                                                    $list_fakultas = config_item('FAKULTAS');
                                                    $nama_fakultas = "-";
                                                    foreach ($list_fakultas as $f => $jurusan) {
                                                        if (in_array($user->jurusan, $jurusan)) {
                                                            $nama_fakultas = $f;
                                                            break;
                                                        }
                                                    }
                                                    echo $nama_fakultas;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Jurusan</th>
                                                <td style="width: 1px;">:</td>
                                                <td>
                                                    <?php
                                                    $list_jurusan = config_item('JURUSAN');
                                                    $nama_jurusan = "-";
                                                    foreach ($list_jurusan as $kode => $jurusan) {
                                                        if ($user->jurusan == $kode) {
                                                            $nama_jurusan = $jurusan;
                                                            break;
                                                        }
                                                    }
                                                    echo $nama_jurusan;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>NIM</th>
                                                <td style="width: 1px;">:</td>
                                                <td><?php echo $user->nim; ?></td>
                                            </tr>
                                        <?php } ?>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                                <!-- End of table content -->
                            </div>
                        </div>

                        <!-- Card for User Activities -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Sertifikat Peserta</h3>
                            </div>
                            <div class="card-body p-3">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a class="nav-link active" data-toggle="tab" href="#home">Hardskill</a>
                                    </li>
                                    <li class>
                                        <a class="nav-link" data-toggle="tab" href="#menu1">Softskill</a>
                                    </li>
                                </ul>
                                <br>
                                <ul class="list-unstyled">
                                    <li style="text-align: right;"><a target="_blank" class="btn btn-success" href="<?php echo base_url('login_data_peserta'); ?>">Tambahkan Data</a>
                                    </li><br>
                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade show active in">
                                            <?php if (empty($user_activities)) : ?>
                                                <p>Data sertifikat peserta tidak ditemukan. Silakan menghubungi ITCC ITPLN</p>
                                            <?php else : ?>
                                                <div class="tabelFlow">
                                                    <table class="table table-bordered table-responsive">

                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Sertifikasi</th>
                                                                <th>Program</th>
                                                                <th>Tanggal</th>
                                                                <th>Gelar</th>
                                                                <!-- Add more table headers for additional fields -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $counter = 1;
                                                            foreach ($user_activities as $activity) : ?>
                                                                <tr>
                                                                    <td><?= $counter++; ?></td>
                                                                    <td><?= $activity['nama_sertifikasi']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        // Assuming $activity['nama_program'] contains strings like "MOS: Excel"
                                                                        $program_parts = explode(': ', $activity['nama_program']);
                                                                        echo end($program_parts); // Display the last part after ": "
                                                                        ?>
                                                                    </td>
                                                                    <td><?= date('Y-m-d', strtotime($activity['tanggal_ujian'])); ?></td>
                                                                    <td>
                                                                        <?php
                                                                        // Assuming $activity['nama_program'] contains strings like "MOS: Excel"
                                                                        $program_parts = explode(': ', $activity['nama_program']);
                                                                        echo $program_parts[0]; // Display the first part before ": "
                                                                        ?>
                                                                    </td>
                                                                    <!-- Add more table cells for additional fields -->
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                                </div>
                                        </div>
                                        <div id="menu1" class="tab-pane fade">
                                            <?php if (empty($user_activities)) : ?>
                                                <p>Data sertifikat peserta tidak ditemukan. Silakan menghubungi ITCC ITPLN</p>
                                            <?php else : ?>
                                                <div class="tabelFlow">
                                                    <table class="table table-bordered table-responsive">

                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Seminar</th>
                                                                <th>program</th>
                                                                <th>Tanggal</th>
                                                                <th>Kategori</th>
                                                                <!-- Add more table headers for additional fields -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $counter = 1;
                                                            foreach ($user_activities as $activity) : ?>
                                                                <tr>
                                                                    <td><?= $counter++; ?></td>
                                                                    <td><?= $activity['nama_sertifikasi']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        // Assuming $activity['nama_program'] contains strings like "MOS: Excel"
                                                                        $program_parts = explode(': ', $activity['nama_program']);
                                                                        echo end($program_parts); // Display the last part after ": "
                                                                        ?>
                                                                    </td>
                                                                    <td><?= date('Y-m-d', strtotime($activity['tanggal_ujian'])); ?></td>
                                                                    <!-- Add more table cells for additional fields -->
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                                </div>

                                        </div>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                                    <!-- End of Card for User Activities -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->view('components/footer'); ?>
            <?php $this->load->view('components/bottomscript'); ?>
</body>

</html>