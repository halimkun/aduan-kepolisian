<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Daftar Pengguna</h1>
        <div class="section-header-breadcrumb">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPengguna">
                <i class="fas fa-plus"></i>
                Tambah Pengguna
            </button>
        </div>
    </div>
</section>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahPengguna">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/create" method="post"> <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" placeholder="nama lengkap pengguna" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>