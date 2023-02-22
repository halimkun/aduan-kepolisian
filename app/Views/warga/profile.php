<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>

<style>
    .error {
        color: red;
    }

    /* input password have error class*/
    [type="password"].error {
        border-color: red;
    }
</style>

<section class="section">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Profile Page</h1>
    </div>

    <?php
    $r = user()->getRoles();
    $profile_lengkap ? $d = date_create($me->tanggal_lahir) : $d = null;
    ?>

    <?= $this->include('Components/flash_message'); ?>

    <div class="section-body">

        <?php if (!$profile_lengkap) : ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-info mr-1"></i> Silahkan <a href="#" data-user="<?= user_id() ?>" data-toggle="modal" data-target="#editPengguna"><u>lengkapi profil</u></a> anda terlebih dahulu untuk dapat menggunakan fitur yang ada.
            </div>
        <?php endif; ?>

        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 py-5 px-3 d-flex align-items-center justify-content-center flex-column">
                    <img src="<?= base_url('/assets/img/avatar/avatar-1.png') ?>" alt="" class="w-50 rounded-circle">
                    <span class="h3 my-3" title="username"><?= $me->username ?></span>
                    <div class="card bg-dark card-statistic-2 mt-2">
                        <div class="card-icon bg-<?= userColor() ?>">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Aduan</h4>
                            </div>
                            <div class="card-body">
                                <?= count($aduanku) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-5 px-3 d-flex justify-content-center flex-column">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-flex alilgn-items-center">
                                <span class="h3"><?= $me->nama ?></span>
                                <span class="pl-1">
                                    <div style="border-radius: 100px; scale: 75%;" title="group <?= end($r) ?>" class="px-3 py-1 bg-<?= userColor() ?>"><strong><?= end($r) ?></strong></div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end" style="gap: 5px">
                                <button class="btn btn-sm shadow d-none d-md-block btn-edit btn-<?= userColor() ?>" data-user="<?= user_id() ?>" data-toggle="modal" data-target="#editPengguna"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-sm btn-warning shadow-sm d-none d-md-block btn-edit-p" data-user="<?= user_id() ?>" data-toggle="modal" data-target="#ubahCPassword" title="ubah password user">
                                    <i class="fa fa-key"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="h6"><?= $me->email ?></div>
                            <div class="h6"><?= $me->nomor_hp ?></div>
                            <div class="h6"><?= $me->tempat_lahir ?>, <span title="tanggal lahir"><?= $d == null ? '' : date_format($d, "d F Y") ?></span></div>
                        </div>
                        <div class="col-md-6">
                            <div class="h6"><?= $me->agama ?></div>
                            <div class="h6"><?= $me->pekerjaan ?></div>
                            <div class="h6"><?= $me->jenis_kelamin ?></div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-dark d-flex align-items-center rounded">
                        <div class="mb-0 pb-0 text-sm"><?= $me->alamat ?></div>
                    </div>
                    <!-- button full width -->
                    <div class="d-flex justify-content-center my-3 gap-3 d-block d-md-none" style="gap:10px">
                        <button class="btn btn-sm shadow btn-<?= userColor() ?> btn-edit" data-user="<?= user_id() ?>" data-toggle="modal" data-target="#editPengguna"><i class="fa fa-pen"></i> Edit Profile</button>
                        <button class="btn btn-sm btn-edit-p shadow btn-warning" data-user="<?= user_id() ?>" data-toggle="modal" data-target="#ubahCPassword"><i class="fa fa-key"></i> Ubah Password</button>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="h5 text-<?= userColor() ?> mb-0 pb-0">Aduan Terakhir</div>
                            <div class="text-sm mb-3">
                                berikut adalah aduan terakhir yang anda buat
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end">
                                <a href="<?= base_url('warga/aduan') ?>" class="btn btn-sm shadow btn-<?= userColor() ?>">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No. </th>
                                    <th width="10"></th>
                                    <th>Jenis</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($aduanku_terbaru as $a) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>
                                            <?= badgeStatusGen($a->status) ?>
                                        </td>
                                        <td><?= $a->jenis ?></td>
                                        <td><?= $a->judul ?></td>
                                        <td><?= $a->tanggal ?></td>
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

<!-- Edit User -->
<div class="modal fade" tabindex="-1" role="dialog" id="editPengguna">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/warga/profile/update') ?>" method="post" id="formEditUser" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" placeholder="nama lengkap pengguna" value="<?= user()->nama ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label ml-2">Username</label>
                                ( <small class="text-warning">tidak dapat diubah</small> )
                                <input type="text" name="username" id="username" readonly placeholder="username pengguna" value="<?= user()->username ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" placeholder="exaple@mail.com" value="<?= user()->email ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomorHp" class="form-label">Nomor HP</label>
                                <input type="number" name="nomorHp" id="nomorHp" placeholder="08xxxxxxxxxx" value="<?= user()->nomor_hp ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempatLahir" id="tempat_lahir" placeholder="Tempat lahir pengguna" value="<?= user()->tempat_lahir ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tglLahir" id="tglLahir" value="<?= user()->tanggal_lahir ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?= user()->pekerjaan ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="custom-select">
                                <option value="-">Pilih Agama</option>
                                <option <?= user()->agama == 'islam' ? 'selected' : ''  ?> value="islam">Islam</option>
                                <option <?= user()->agama == 'kristen' ? 'selected' : ''  ?> value="kristen">kristen</option>
                                <option <?= user()->agama == 'katolik' ? 'selected' : ''  ?> value="katolik">katolik</option>
                                <option <?= user()->agama == 'hindu' ? 'selected' : ''  ?> value="hindu">hindu</option>
                                <option <?= user()->agama == 'buddha' ? 'selected' : ''  ?> value="buddha">buddha</option>
                                <option <?= user()->agama == 'konghucu' ? 'selected' : ''  ?> value="konghucu">konghucu</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                    <option value="-"> -- PILIH -- </option>
                                    <option <?= user()->jenis_kelamin == 'laki-laki' ? 'selected' : ''  ?> value="laki-laki">Laki-laki</option>
                                    <option <?= user()->jenis_kelamin == 'perempuan' ? 'selected' : ''  ?> value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" style="height: 136px;"><?= user()->alamat ?></textarea>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-<?= userColor() ?> shadow-sm">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- update password -->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="ubahCPassword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/warga/pass/update') ?>" id="formEditPassword" method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Password Confirmation</label>
                        <input type="password" name="cpassword" id="cpassword" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-<?= userColor() ?>">Simpan</button>
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
            number: true,
            minlength: 10,
            maxlength: 13,
            myfield: true
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

    $.validator.addMethod("myfield", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    }, "Username must contain only letters, numbers, or dashes.");

    $.validator.addMethod('mym', function(val, ele) {
        return this.optional(ele) || /^[a-z0-9\-\s\.\,\_\;\:\?\/\\\|\[\]\{\}\`\~\!\@\#\$\%\^\&\*\(\)\+\=\']{1,}$/i.test(val);
    }, 'this field not valid');

    $.validator.addMethod("selectEq", function(value, element, arg) {
        return arg !== value;
    }, `this field not valid`);

    $('#formEditUser').validate({
        rules: jqv_rules
    });

    // password validation
    $('#formEditPassword').validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
            },
            cpassword: {
                required: true,
                minlength: 8,
                equalTo: '#password'
            }
        },
    });
</script>
<?= $this->endSection(); ?>