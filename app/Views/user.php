<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section user-page">
    <div class="section-header">
        <h1>Pengguna dan Jabatan</h1>
    </div>
    <div class="section-body">
        <div class="card shadow-sm rounded">
            <div class="card-header">
                <h4>Data Pengguna</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#tambahPengguna">
                        <i class="fas fa-plus"></i>
                        Pengguna
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?= $this->include('Components/flash_message'); ?>
                <div class="table-responsive">
                    <table class="table" id="tableUser">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Groups</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($users as $user) : ?>
                                <?php $roles = $user->getRoles() ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= end($roles) ?></td>
                                    <td><?= $user->nama ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->username ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info shadow-sm" title="edit user">
                                            <i class="fa fa-pen"></i>
                                        </button>

                                        <button class="btn btn-sm btn-warning shadow-sm" title="ubah password user">
                                            <i class="fa fa-key"></i>
                                        </button>

                                        <?php if (!in_array('admin', $roles)) : ?>
                                            <button class="btn btn-sm btn-danger shadow-sm" title="hapus data user" data-confirm="Woops...|Apakah anda yakin akan menghapus data <b><?= $user->nama ?></b>" data-confirm-yes="$.ajax({ url: '/user/delete/<?= $user->id ?>', type: 'DELETE', data: {'id' : <?= $user->id ?>}, success: function(result) { window.location.href='/admin/user'; } });">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahPengguna">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Perhatian!</strong>
                    <p>
                        Setiap pengguna baru akan dimasukan dalam groups <strong class="text-dark">pengguna</strong>, anda bisa merubah group setelah berhasil menambahkan pengguna.
                    </p>
                </div>
                <form action="/user/store" method="post" autocomplete="off"> <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" placeholder="nama lengkap pengguna" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                    <option value="-"> -- PILIH -- </option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tglLahir" id="tglLahir" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" placeholder="username pengguna" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" placeholder="email pengguna" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" style="height: 136px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary shadow-sm">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('topLibrary'); ?>
<!-- CSS Libraies -->
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/datatables.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/select2/dist/css/select2.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('bottomLibrary'); ?>
<!-- JS Libraies -->
<script src="<?= base_url('assets/modules/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/select2/dist/js/select2.full.min.js') ?>"></script>

<script>
    // ready
    $(document).ready(function() {
        $('#tableUser').DataTable({
            'columnDefs': [{
                targets: [0, 5],
                sortable: false
            }]
        });
    });
</script>
<?= $this->endSection(); ?>