<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="<?php echo base_url(); ?>">
                <img src="https://raw.githubusercontent.com/itccitpln/AssetFoto/main/LOGO-FIXED.png" alt="ITCC" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(<?php echo base_url($this->config->item('UPLOAD_FOTO_PROFIL')['upload_path'] . $_SESSION['user']['file_fotoprofil']); ?>)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?php echo $_SESSION['user']['nama_depan'] . ' ' . $_SESSION['user']['nama_belakang']; ?></div>
                        <div class="mt-1 small text-muted"><?php echo strtoupper($_SESSION['user']['tipe_user']); ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <a href="<?php echo base_url('profile'); ?>" class="dropdown-item">Biodata Saya</a>
                    <a href="<?php
                                if ($_SESSION['user']['tipe_user'] === 'mahasiswa') echo base_url('mhs/logout');
                                elseif ($_SESSION['user']['tipe_user'] === 'umum') echo base_url('umum/logout');
                                elseif ($_SESSION['user']['tipe_user'] === 'itpln') echo base_url('itpln/logout');
                                ?>" class="dropdown-item">Keluar</a>
                </div>
            </div>
        </div>
    </div>
</header>