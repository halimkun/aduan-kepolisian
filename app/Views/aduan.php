<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Aduan</h1>
        <div class="section-header-breadcrumb">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAduanInfo">
                <i class="fa fa-info-circle"></i>
            </button>
        </div>
    </div>
    <div class="section-body">
        <div class="card shadow rounded">
            <div class="card-header">
                <h4>Daftar Aduan</h4>
                <div class="card-header-action">
                    <button class="btn btn-sm btn-icon btn-primary shadow-sm" data-toggle="modal" data-target="#tambahAduan">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Aduan</th>
                            <th>Aduan</th>
                            <th>Keterangan</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>