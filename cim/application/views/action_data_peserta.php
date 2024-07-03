<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>
<?php function yield_title($_this, $data)
{ ?> Update Validasi Kode Unik ITCC <?php } ?>
<?php function yield_page_header($_this, $data)
{ ?>
    <div class="col-7 align-self-center">
        <h3 class="page-title text-dark font-weight-medium mb-1">
            <?php yield_title($_this, $data); ?>
        </h3>
    </div>
<?php } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('components/head'); ?>
    <title>Data Peserta Sertifikasi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body class="antialiased">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .tab-content {
            margin-top: 20px;
        }
    </style>
    <div class="container">
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
        <?php endif; ?>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Sertifikat Peserta</h3>
            </div>
            <div class="card-body p-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#hardskill">Hardskill</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#softskill">Softskill</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="hardskill" class="tab-pane fade show active">
                        <button id="openModalBtn" class="btn btn-success">Tambah</button>
                        <button id="editBtn" class="btn btn-success">Edit</button>
                        <button id="hapusBtn" class="btn btn-success">Hapus</button>
                        <button id="belumApproveBtn" class="btn btn-success">Belum Approve</button>
                        <div><br><?php if (empty($user_activities_hardskill)) : ?>
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
                                            foreach ($user_activities_hardskill as $activity) : ?>
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
                                                foreach ($user_activities_hardskill as $activity) : ?>
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
                                    </div>
                                <?php endif; ?>
                                </div>
                        </div>
                        <div id="softskill" class="tab-pane fade">
                            <button id="openModalBtn2" class="btn btn-success">Tambahkan Data</button>
                            <div><br><?php if (empty($user_activities_softskill)) : ?>
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
                                                foreach ($user_activities_softskill as $activity) : ?>
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
                                    </div>
                                    <div>
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
                                                    foreach ($user_activities_softskill as $activity) : ?>
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
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <?php echo form_open('main/submit'); ?>
                    <div class="form-group">
                        <label for="certification">Sertifikasi</label>
                        <input type="text" id="certification" name="nama_sertifikasi" placeholder="Contoh: Microsoft Office Specialist" required>
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select id="program" name="program" required>
                            <option value="Excel">Excel</option>
                            <option value="Word">Word</option>
                            <option value="PowerPoint">PowerPoint</option>
                            <option value="Azure AI-900">Azure AI-900</option>
                            <option value="MTCNA">MTCNA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="degree">Gelar</label>
                        <select id="degree" name="degree" required>
                            <option value="MOS">MOS</option>
                            <option value="MCF">MCF</option>
                            <option value="MTCNA">MTCNA</option>
                        </select>
                    </div>
                    <input type="submit" value="Submit">
                    <?php echo form_close(); ?>
                </div>
            </div>



            <script>
                var modal = document.getElementById("myModal");
                var btn = document.getElementById("openModalBtn");
                var btn2 = document.getElementById("openModalBtn2");
                var span = document.getElementsByClassName("close")[0];

                btn.onclick = function() {
                    modal.style.display = "block";
                }

                btn2.onclick = function() {
                    modal.style.display = "block";
                }

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>