<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section user-page">
    <div class="section-header">
        <h1>Pengguna</h1>
        <div class="section-header-breadcrumb">
            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUserInfo">
                <i class="fa fa-info-circle"></i>
            </button>
        </div>
    </div>

    <?= $this->include('Components/flash_message'); ?>

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
                <div class="table-responsive">
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
                                        <td><?= badgeGen(end($roles)) ?></td>
                                        <td><?= $user->nama ?></td>
                                        <td><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td>
                                        <td><?= $user->username ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-info shadow-sm btn-edit" title="edit user" data-user="<?= $user->id ?>" data-toggle="modal" data-target="#editPengguna">
                                                <i class="fa fa-pen"></i>
                                            </button>

                                            <button class="btn btn-sm btn-warning shadow-sm btn-edit-p" data-nama="<?= $user->nama ?>" data-user="<?= $user->id ?>" data-tgl="<?= $user->tanggal_lahir ?>" data-toggle="modal" data-target="#ubahPassword" title="ubah password user">
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
    </div>
</section>

<?= $this->include('Components/modal/tambah_user'); ?>
<?= $this->include('Components/modal/edit_user'); ?>
<?= $this->include('Components/modal/ubah_password'); ?>

<!-- bootstrap modal modalUserInfo -->
<div class="modal fade" id="modalUserInfo" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalUserInfoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUserInfoTitle">Perhatian !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li class="font-weight-bold">
                        <kbd>Username</kbd> Pengguna ataupun admin tidak dapat dirubah.
                    </li>
                    <li class="font-weight-bold">
                        <kbd>Password Default</kbd> user adalah tanggal lahir dengan format (ddmmyyyy), contoh <code>05121998</code>
                    </li>
                    <li class="font-weight-bold">
                        Reset Password user akan mengembalikannya ke format default (lihat point sebelumnnya).
                    </li>
                </ul>
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

        $('.btn-edit-p').each(function() {
            $(this).on('click', function() {
                let tgl = $(this).data('tgl');
                let nama = $(this).data('nama');
                let user = $(this).data('user');

                fd = tgl.split('-');
                $('#ubahPassword #ud').val(user);
                $('#ubahPassword #np').val(fd[2] + fd[1] + fd[0]);
                $('#ubahPassword #namaUser').append(nama);
            });
        });

        $(".btn-edit").each(function() {
            $(this).on("click", function() {
                $.ajax({
                    url: '<?= base_url('user/getById') ?>',
                    type: 'POST',
                    data: {
                        id: $(this).data('user'),
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == 'success') {
                            $('#editPengguna #user_detail').val(result.data.id);
                            $('#editPengguna #nama').val(result.data.nama);
                            $('#editPengguna #tglLahir').val(result.data.tanggal_lahir);
                            $('#editPengguna #pekerjaan').val(result.data.pekerjaan);
                            $('#editPengguna #username').val(result.data.username);
                            $('#editPengguna #email').val(result.data.email);
                            $('#editPengguna #alamat').val(result.data.alamat);
                            $('#editPengguna #jenis_kelamin').val(result.data.jenis_kelamin)
                        } else {
                            alert(result.message);
                        }
                    }
                });
            });
        });

    });
</script>
<?= $this->endSection(); ?>