<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php function yield_page_title()
{ ?>
    Masuk
<?php } ?>

<?php function yield_page_content($_this, $data)
{ ?>
    <?php $next = $data['next']; ?>
    <div class="container py-6" style="min-width: 50%;">
        <div class="text-center mb-3">
            <a href="<?php echo base_url(); ?>" class="d-block mb-1">
                <img src="https://raw.githubusercontent.com/itccitpln/static-assets/main/reusable/logo/logo-no_text.png" style="width:150px;" alt="logo">
            </a>
            <h1>
                <strong>
                    (SITASI ITCC) Sistem Terintegrasi ITCC ITPLN
                </strong>
            </h1>
        </div>
        <?php foreach (get_warning() as $w) { ?>
            <div class="alert alert-warning alert-dismissible bg-white" role="alert">
                <div class="d-flex">
                    <div>
                        <h4 class="alert-title"><?php echo $w; ?></h4>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        <?php }
        clear_warning(); ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="mx-auto my-3 btn btn-light btn-square btn-lg btn-block w-100" style="display:block; white-space: normal;" onclick="window.location.href='<?php echo base_url("mhs/login?next=$next") ?>'">
                            <img src="<?php echo base_url('assets/static/itpln.png'); ?>" class="mb-2" alt="logo">
                            <br>
                            Mahasiswa IT-PLN login di sini
                        </button>
                    </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php
$data = isset($data) ? $data : [];
$this->load->view('components/container_autentikasi', ['data' => $data]); ?>