<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section user-page">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Pengguna</h1>
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
                <h4 class="text-<?= userColor() ?>">Data Pengguna</h4>
                <div class="card-header-action">
                    <button class="btn btn-<?= userColor() ?> shadow-sm" data-toggle="modal" data-target="#tambahPengguna">
                        <i class="fas fa-plus"></i>
                        Pengguna
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- select group user -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="tampilkan">Tampilkan</label>
                                <select name="tampilkan" class="custom-select" id="tampilkan">
                                    <option value="5">5</option>
                                    <option selected value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="filterGroup">Group</label>
                                <select name="filterGroup" class="custom-select" id="filterGroup">
                                    <option value="">Semua</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    <option value="pengguna">Pengguna</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="filterSearch">Search</label>
                                <input type="text" name="filterSearch" id="filterSearch" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table" id="tableUser">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Groups</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <?php if (in_array('admin', user()->getRoles())) : ?>
                                <th><i class="fa fa-user-cog"></i></th>
                            <?php endif ?>
                            <th><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($users as $user) : ?>
                            <?php $roles = $user->getRoles() ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= badgeGen(end($roles)) ?></td>
                                <td><img src="/assets/img/avatar/avatar-1.png" alt="profile" height="20" width="20" class="img-fluid rounded-circle mr-2"><?= $user->nama ?></td>
                                <td><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td>
                                <?php if (in_array('admin', user()->getRoles())) : ?>
                                    <!-- TRUE -->
                                    <td>
                                        <button class="btn btn-light shadow-sm btn-sm text-dark btn-roles" data-user="<?= $user->id ?>" data-toggle="modal" data-target="#gantiRoles" title="Ubag Group Pengguna" <?= end($roles) !== 'admin' ? '' : 'disabled' ?>><i class="fa fa-list"></i></button>
                                    </td>
                                <?php endif ?>
                                <td>
                                    <button class="btn btn-sm btn-info shadow-sm btn-edit" title="edit user" data-user="<?= $user->id ?>" data-toggle="modal" data-target="#editPengguna">
                                        <i class="fa fa-pen"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning shadow-sm btn-edit-p" data-nama="<?= $user->nama ?>" data-user="<?= $user->id ?>" data-tgl="<?= $user->tanggal_lahir ?>" data-toggle="modal" data-target="#ubahPassword" title="ubah password user">
                                        <i class="fa fa-key"></i>
                                    </button>

                                    <?php
                                    if (in_array('admin', user()->getRoles())) {
                                        if (in_array('admin', $roles)) {
                                            $deldis = 'disabled';
                                        } else {
                                            $deldis = '';
                                        }
                                    } elseif (in_array('petugas', user()->getRoles())) {
                                        if (in_array('admin', $roles) || in_array('petugas', $roles)) {
                                            $deldis = 'disabled';
                                        } else {
                                            $deldis = '';
                                        }
                                    }
                                    ?>

                                    <button <?= $deldis ?> class="btn btn-sm btn-danger shadow-sm" title="hapus data user" data-confirm="Woops...|Apakah anda yakin akan menghapus data <b><?= $user->nama ?></b>" data-confirm-yes="$.ajax({ url: '/user/delete/<?= $user->id ?>', type: 'DELETE', data: {'id' : <?= $user->id ?>}, success: function(result) { window.location.href='/admin/user'; } });">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->include('Components/modal/tambah_user'); ?>
<?= $this->include('Components/modal/edit_user'); ?>
<?= $this->include('Components/modal/ubah_password'); ?>
<?= $this->include('Components/modal/ubah_group'); ?>

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
<link rel="stylesheet" href="<?= base_url('assets/modules/select2/css/select2.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('bottomLibrary'); ?>
<!-- JS Libraies -->
<script src="<?= base_url('assets/modules/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/select2/js/select2.full.min.js') ?>"></script>
<!-- validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

<script>
    // ready
    $(document).ready(function() {
        $('#tableUser').DataTable({
            "responsive": !0,
            "pageLength": 10,
            "dom": 'rtp',
        });

        $("#tableUser tbody").on('click', '.btn-edit', function() {
            $.ajax({
                url: '<?= base_url('user/getById') ?>',
                type: 'POST',
                data: {
                    id: $(this).data('user'),
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    if (result.status == 'success') {
                        $('#editPengguna #user_detail').val(result.data.id);
                        $('#editPengguna #nama').val(result.data.nama);
                        $('#editPengguna #tglLahir').val(result.data.tanggal_lahir);
                        $('#editPengguna #pekerjaan').val(result.data.pekerjaan);
                        $('#editPengguna #username').val(result.data.username);
                        $('#editPengguna #email').val(result.data.email);
                        $('#editPengguna #alamat').val(result.data.alamat);
                        $('#editPengguna #jenis_kelamin').val(result.data.jenis_kelamin)
                        $('#editPengguna #nomorHp').val(result.data.nomor_hp)
                        $('#editPengguna #tempat_lahir').val(result.data.tempat_lahir)
                        $('#editPengguna #agama').val(result.data.agama)
                    } else {
                        alert(result.message);
                    }
                }
            });
        });

        // #tampilkan onChange, change table page length
        $('#tampilkan').on('change', function() {
            $('#tableUser').DataTable().page.len($(this).val()).draw();
        });

        // filterGroup onChange, change table only show group
        $('#filterGroup').on('change', function() {
            $('#tableUser').DataTable().column(2).search($(this).val()).draw();
        });

        // filterSearch onKeyup, change table only show search
        $('#filterSearch').on('keyup', function() {
            $('#tableUser').DataTable().search($(this).val()).draw();
        });

        const jqv_rules = {
            nama: {
                required: true,
                minlength: 5,
                myfield: true
            },
            username: {
                required: true,
                minlength: 5,
                myfield: true
            },
            email: {
                required: true,
                email: true
            },
            nomorHp: {
                required: true,
                minlength: 10,
                maxlength: 13,
                mp: true
            },
            tempatLahir: {
                required: true,
                minlength: 5,
                myfield: true
            },
            tglLahir: {
                required: true,
                date: true,
                myfield: true
            },
            pekerjaan: {
                required: true,
                minlength: 5,
                myfield: true
            },
            agama: {
                required: true,
                myfield: true,
                selectEq: '-'
            },
            jenis_kelamin: {
                required: true,
                myfield: true,
                selectEq: '-'
            },
            alamat: {
                required: true,
                minlength: 10,
                mym: true
            },
        };

        jQuery.validator.setDefaults({
            errorClass: "is-invalid text-danger",
            validClass: "is-valid",
        });

        // validator add method allow only number, dash, space, and plus
        $.validator.addMethod('mp', function(val, ele) {
            return this.optional(ele) || /^[0-9\-\s\+]{1,}$/i.test(val);
        }, 'this field not valid');

        $.validator.addMethod("myfield", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        // valdator add method only letter small and capital, number, dash, space, dot, comma, and underscore, semicolon, colon, slash, backslash, aspos, quote, and bracket
        $.validator.addMethod('mym', function(val, ele) {
            return this.optional(ele) || /^[a-z0-9\-\s\.\,\_\;\:\?\/\\\|\[\]\{\}\`\~\!\@\#\$\%\^\&\*\(\)\+\=\']{1,}$/i.test(val);
        }, 'this field not valid');

        $.validator.addMethod("selectEq", function(value, element, arg) {
            return arg !== value;
        }, `this field not valid`);

        $('#formTambahUser').validate({
            rules: jqv_rules
        });
        $('#formEditUser').validate({
            rules: jqv_rules
        });

        var selectRoleRules = {
            rules: {
                role: {
                    required: true,
                    selectEq: '-'
                }
            },
            messages: {
                role: {
                    required: 'this field is required',
                    selectEq: 'this field not valid'
                }
            }
        };

        $('#fgrole').validate(selectRoleRules);

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

        $('.btn-roles').each(function() {
            $(this).on('click', function() {
                $.ajax({
                    url: '<?= base_url('user/getById') ?>',
                    type: 'POST',
                    data: {
                        id: $(this).data('user'),
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == 'success') {
                            console.log(result.data.id);
                            $('#fgrole #udetail').val(result.data.id);
                        }
                    }
                })
            });
        });



    });
</script>
<?= $this->endSection(); ?>