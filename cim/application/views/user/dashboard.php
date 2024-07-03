<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-cube"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CIM</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('user'); ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>My Profile</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrator
            </div>


            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('user/dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('user'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                </div>
                <!-- Card for User Activities -->
                <div class="card mt-4">
                    <div class="card-header">
                    </div>
                    <div class="card-body p-3">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a class="nav-link active" data-toggle="tab" href="#home">Seminar</a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="tab" href="#menu1">Hardskill & Softskill</a>
                            </li>
                        </ul>
                        <ul class="list-unstyled">
                            <div class="tab-content"><br>
                                <div id="home" class="tab-pane fade show active in">
                                    <a class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahSeminar">Tambah Data Seminar</a>
                                    <div class="modal fade" id="modalTambahSeminar" tabindex="-1" role="dialog" aria-labelledby="modalTambahSeminarLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTambahSeminarLabel">Pilih Opsi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <select id="optionSelectSeminar" class="form-control">
                                                        <option value="">Pilih Opsi</option>
                                                        <option value="otomatis">Otomatis</option>
                                                        <option value="manual">Manual</option>
                                                    </select>
                                                    <br>
                                                    <div id="otomatisFormSeminar" style="display:none;">
                                                        <form id="uploadAndProcessOcrSeminarForm" action="<?= base_url('auth/upload_and_process_ocr_seminar'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="file">Upload File</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required>
                                                                    <label class="custom-file-label" for="file">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Upload dan Proses OCR</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div id="confirmFormSeminar" style="display:none;">
                                                        <?= form_open_multipart('auth/save_data_ocr'); ?>
                                                        <div class="form-group">
                                                            <label for="kegiatan">Nama Kegiatan</label>
                                                            <input type="text" class="form-control" id="kegiatanSeminar" name="kegiatan" placeholder="Contoh: Microsoft Office Specialist" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date">Tanggal</label>
                                                            <input type="date" class="form-control" id="tanggalSeminar" name="tanggal" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kategori">Kategori</label>
                                                            <select class="form-control" id="kategoriSeminar" name="kategori" required>
                                                                <option value="Wilayah">Wilayah</option>
                                                                <option value="Kota">Kota</option>
                                                                <option value="Nasional">Nasional</option>
                                                                <option value="Internasional">Internasional</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Gambar</label>
                                                            <div class="row">
                                                                <div class="col-sm-9">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                        </form>
                                                    </div>

                                                    <div id="manualFormSeminar" style="display:none;">
                                                        <?= form_open_multipart('auth/save_data'); ?>
                                                        <div class="form-group">
                                                            <label for="kegiatan">Nama Kegiatan</label>
                                                            <input type="text" id="kegiatanManual" name="kegiatan" placeholder="Contoh: Microsoft Office Specialist" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date">Tanggal</label>
                                                            <input type="date" id="tanggalManual" name="tanggal" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kategori">Kategori</label>
                                                            <select id="kategoriManual" name="kategori" required>
                                                                <option value="Wilayah">Wilayah</option>
                                                                <option value="Kota">Kota</option>
                                                                <option value="Nasional">Nasional</option>
                                                                <option value="Internasional">Internasional</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Gambar</label>
                                                            <div class="row">
                                                                <div class="col-sm-9">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="imageManual" name="image">
                                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                        </form>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#optionSelectSeminar').change(function() {
                                                                var selectedOption = $(this).val();
                                                                if (selectedOption == 'otomatis') {
                                                                    $('#otomatisFormSeminar').show();
                                                                    $('#confirmFormSeminar').hide();
                                                                    $('#manualFormSeminar').hide();
                                                                } else if (selectedOption == 'manual') {
                                                                    $('#otomatisFormSeminar').hide();
                                                                    $('#confirmFormSeminar').hide();
                                                                    $('#manualFormSeminar').show();
                                                                } else {
                                                                    $('#otomatisFormSeminar').hide();
                                                                    $('#confirmFormSeminar').hide();
                                                                    $('#manualFormSeminar').hide();
                                                                }
                                                            });

                                                            $('.custom-file-input').on('change', function(event) {
                                                                var inputFile = event.currentTarget;
                                                                $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
                                                            });

                                                            $('#uploadAndProcessOcrSeminarForm').on('submit', function(event) {
                                                                event.preventDefault();

                                                                var formData = new FormData(this);

                                                                $.ajax({
                                                                    url: $(this).attr('action'),
                                                                    type: 'POST',
                                                                    data: formData,
                                                                    contentType: false,
                                                                    processData: false,
                                                                    success: function(response) {
                                                                        var data = JSON.parse(response);
                                                                        if (data.status === 'success') {
                                                                            $('#kegiatanSeminar').val(data.data.kegiatan);
                                                                            $('#tanggalSeminar').val(data.data.tanggal);
                                                                            $('#kategoriSeminar').val(data.data.kategori);

                                                                            $('#otomatisFormSeminar').hide();
                                                                            $('#confirmFormSeminar').show();
                                                                        } else {
                                                                            alert(data.message);
                                                                        }
                                                                    },
                                                                    error: function(xhr, status, error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tabelFlow">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kegiatan</th>
                                                    <th>Tanggal</th>
                                                    <th>Kategori</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($seminars as $seminar) : ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= $seminar['kegiatan']; ?></td>
                                                        <td><?= $seminar['tanggal']; ?></td>
                                                        <td><?= $seminar['kategori']; ?></td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #0D133F; border-color: #0D133F;">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                                    <?php if (!empty($seminar['file'])) : ?>
                                                                        <a class="dropdown-item dropdown-item-custom" href="<?= base_url('assets/img/file-sertifikat/' . $seminar['file']); ?>" target="_blank"><i class="fas fa-file-alt mr-2"></i> Buka</a>
                                                                    <?php endif; ?>
                                                                    <div>
                                                                        <a class="dropdown-item dropdown-item-custom" href="<?= base_url('auth/update_seminar/' . $seminar['id']); ?>" data-toggle="modal" data-target="#modalEditSeminar"><i class="fas fa-edit mr-2"></i> Edit</a>
                                                                        <a class="dropdown-item dropdown-item-custom text-danger" href="<?= base_url('auth/delete_seminar/' . $seminar['id']); ?>" onclick="return confirm('Are you sure you want to delete this seminar?');"><i class="fas fa-trash-alt mr-2"></i> Hapus</a>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal Pop-up untuk Edit Seminar -->
                                                                <div class="modal fade" id="modalEditSeminar" tabindex="-1" role="dialog" aria-labelledby="modalEditSeminarLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="modalEditSeminarLabel">Edit Seminar</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="<?= base_url('auth/update_seminar/' . $seminar['id']) ?>" method="post" enctype="multipart/form-data">
                                                                                    <div class="form-group">
                                                                                        <label for="kegiatanSeminar">Nama Kegiatan</label>
                                                                                        <input type="text" class="form-control" id="kegiatanSeminar" name="kegiatan" placeholder="Masukkan Nama Kegiatan" value="<?= $seminar['kegiatan'] ?>" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="tanggalSeminar">Tanggal</label>
                                                                                        <input type="date" class="form-control" id="tanggalSeminar" name="tanggal" value="<?= $seminar['tanggal'] ?>" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="kategoriSeminar">Kategori</label>
                                                                                        <select class="form-control" id="kategoriSeminar" name="kategori" required>
                                                                                            <option value="Wilayah" <?= ($seminar['kategori'] == 'Wilayah') ? 'selected' : '' ?>>Wilayah</option>
                                                                                            <option value="Kota" <?= ($seminar['kategori'] == 'Kota') ? 'selected' : '' ?>>Kota</option>
                                                                                            <option value="Nasional" <?= ($seminar['kategori'] == 'Nasional') ? 'selected' : '' ?>>Nasional</option>
                                                                                            <option value="Internasional" <?= ($seminar['kategori'] == 'Internasional') ? 'selected' : '' ?>>Internasional</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="imageSeminar">Gambar</label>
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <?php if (pathinfo($seminar['file'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                                                                                    <embed src="<?= base_url('assets/img/file-sertifikat/') . $seminar['file']; ?>" type="application/pdf" width="400px" height="300px" />
                                                                                                <?php else : ?>
                                                                                                    <img src="<?= base_url('assets/img/file-sertifikat/') . $seminar['file']; ?>" class="img-thumbnail" alt="Seminar Image">
                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="custom-file">
                                                                                                    <input type="file" class="custom-file-input" id="image" name="image">
                                                                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                                                                </div>
                                                                                            </div><br><br>
                                                                                            <div class="form-group row" justify-content-end>
                                                                                                <div class="col-sm-10">
                                                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                                                </div>
                                                                                            </div>
                                                                                </form>

                                                                                <!-- Script untuk menampilkan nama file pada input file -->
                                                                                <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
                                                                                <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        $('.custom-file-input').on('change', function(event) {
                                                                                            var inputFile = event.currentTarget;
                                                                                            $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                    </div>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                </table>
                                </div>
                            </div>

                            <!-- Tab "Hardskill & Softskill" -->
                            <div id="menu1" class="tab-pane fade">
                                <a class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahHardskill">Tambah Data Hardskill & Softskill</a>
                                <div class="modal fade" id="modalTambahHardskill" tabindex="-1" role="dialog" aria-labelledby="modalTambahHardskillLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTambahHardskillLabel">Pilih Opsi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <select id="optionSelectHardskill" class="form-control">
                                                    <option value="">Pilih Opsi</option>
                                                    <option value="otomatis">Otomatis</option>
                                                    <option value="manual">Manual</option>
                                                </select>
                                                <br>
                                                <div id="otomatisFormHardskill" style="display:none;">
                                                    <form action="upload_sertifikat" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="file">Upload File</label>
                                                            <div class="col-sm">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="image" name="image">
                                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                                </div>
                                                            </div><br>
                                                            <div class="form-group row" justify-content-end>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="manualFormHardskill" style="display:none;">
                                                    <?= form_open_multipart('auth/save_data_kompetensi'); ?>
                                                    <table class="table">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Nama Kegiatan</label>
                                                            <input type="text" id="kegiatanHardskill" name="kegiatan" placeholder="Contoh: Microsoft Office Specialist" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="program">Program</label>
                                                            <input type="text" id="programHardskill" name="program" placeholder="Contoh: Excel" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date">Tanggal</label>
                                                            <input type="date" id="tanggalHardskill" name="tanggal" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Gambar</label>
                                                            <div class="row">
                                                                <div class="col-sm-9">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </form>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('.custom-file-input').on('change', function(event) {
                                                                var inputFile = event.currentTarget;
                                                                $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
                                                            });
                                                        });
                                                    </script>
                                                    <style>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabelFlow">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Program</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; ?>
                                            <?php if (isset($hardskills) && is_array($hardskills)) : ?>
                                                <?php foreach ($hardskills as $hardskill) : ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= $hardskill['kegiatan']; ?></td>
                                                        <td><?= $hardskill['program']; ?></td>
                                                        <td><?= $hardskill['tanggal']; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #0D133F; border-color: #0D133F;">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <?php if (!empty($hardskill['file'])) : ?>
                                                                        <a class="dropdown-item" href="<?= base_url('assets/img/file-sertifikat/' . $hardskill['file']); ?>" target="_blank"><i class="fas fa-file-alt mr-2"></i> Buka</a>
                                                                    <?php endif; ?>
                                                                    <a class="dropdown-item dropdown-item-custom" href="#" data-toggle="modal" data-target="#modalEditHardskill"><i class="fas fa-edit mr-2"></i>Edit</a>
                                                                    <a class="dropdown-item text-danger" href="<?= base_url('auth/delete_hardskill/' . $hardskill['id']); ?>" onclick="return confirm('Are you sure you want to delete this hardskill & softskill?');"><i class="fas fa-trash-alt mr-2"></i> Hapus</a>
                                                                </div>
                                                            </div>
                                                            <!-- Modal Pop-up untuk Edit Hardskill -->
                                                            <div class="modal fade" id="modalEditHardskill" tabindex="-1" role="dialog" aria-labelledby="modalEditHardskillLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalEditHardskillLabel">Edit Hardskill & Softskill</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="<?= base_url('auth/update_hardskill_softskill/' . $hardskill['id']); ?>" method="post" enctype="multipart/form-data">
                                                                                <div class="form-group">
                                                                                    <label for="kegiatanHardskill">Nama Kegiatan</label>
                                                                                    <input type="text" class="form-control" id="kegiatanHardskill" name="kegiatan" placeholder="Masukkan Nama Kegiatan" value="<?= $hardskill['kegiatan']; ?>" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="programHardskill">Program</label>
                                                                                    <input type="text" class="form-control" id="programHardskill" name="program" placeholder="Masukkan program" value="<?= $hardskill['kegiatan']; ?>" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="tanggalHardskill">Tanggal</label>
                                                                                    <input type="date" class="form-control" id="tanggalHardskill" name="tanggal" value="<?= $hardskill['tanggal']; ?>" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="imageHardskill">Gambar</label>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6">
                                                                                            <?php if (pathinfo($hardskill['file'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                                                                                <embed src="<?= base_url('assets/img/file-sertifikat/') . $hardskill['file']; ?>" type="application/pdf" width="400px" height="300px" />
                                                                                            <?php else : ?>
                                                                                                <img src="<?= base_url('assets/img/file-sertifikat/') . $hardskill['file']; ?>" class="img-thumbnail" alt="Hardskill Image">
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                        <div class="col-sm-9">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                                                                <label class="custom-file-label" for="image">Choose file</label>
                                                                                            </div>
                                                                                        </div><br><br>
                                                                                        <div class="form-group row" justify-content-end>
                                                                                            <div class="col-sm-10">
                                                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                                                            </div>
                                                                                        </div>
                                                                            </form>

                                                                            <script>
                                                                                $(document).ready(function() {
                                                                                    $('.custom-file-input').on('change', function(event) {
                                                                                        var inputFile = event.currentTarget;
                                                                                        $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
                                                                                    });
                                                                                });
                                                                            </script>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="5">Tidak ada data hardskill & softskill.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#optionSelectSeminar').change(function() {
                                        var selectedOption = $(this).val();
                                        if (selectedOption === 'otomatis') {
                                            $('#otomatisFormSeminar').show();
                                            $('#manualFormSeminar').hide();
                                        } else if (selectedOption === 'manual') {
                                            $('#manualFormSeminar').show();
                                            $('#otomatisFormSeminar').hide();
                                        } else {
                                            $('#otomatisFormSeminar').hide();
                                            $('#manualFormSeminar').hide();
                                        }
                                    });

                                    $('#optionSelectHardskill').change(function() {
                                        var selectedOption = $(this).val();
                                        if (selectedOption === 'otomatis') {
                                            $('#otomatisFormHardskill').show();
                                            $('#manualFormHardskill').hide();
                                        } else if (selectedOption === 'manual') {
                                            $('#manualFormHardskill').show();
                                            $('#otomatisFormHardskill').hide();
                                        } else {
                                            $('#otomatisFormHardskill').hide();
                                            $('#manualFormHardskill').hide();
                                        }
                                    });
                                });
                            </script>


</body>

<!-- End of Main Content -->