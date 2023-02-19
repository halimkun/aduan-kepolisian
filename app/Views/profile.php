<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>

<style>
    .error{
        color: red;
    }

    /* input password have error class*/
    [type="password"].error {
        border-color: red;
    }
</style>

<section class="section">
    <div class="section-header">
        <h1>Profile Page</h1>
    </div>

    <?php $r = user()->getRoles();
    $d = date_create($me->tanggal_lahir) ?>

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
                        <div class="h6"><?= $me->tempat_lahir ?>, <span title="tanggal lahir"><?= date_format($d, "d F Y") ?></span></div>
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
                        <div class="h3 mb-0 pb-0">Aduan Terakhir</div>
                        <div class="text-sm mb-3">
                            berikut adalah aduan terakhir yang anda buat
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('aduan') ?>" class="btn btn-sm shadow btn-<?= userColor() ?>">Lihat Semua</a>
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
</section>

<?= $this->include('Components/modal/edit_user'); ?>
<?= $this->include('Components/modal/custom_password'); ?>

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

    // valdator add method only letter small and capital, number, dash, space, dot, comma, and underscore, semicolon, colon, slash, backslash, aspos, quote, and bracket
    $.validator.addMethod('mym', function(val, ele) {
        return this.optional(ele) || /^[a-z0-9\-\s\.\,\_\;\:\?\/\\\|\[\]\{\}\`\~\!\@\#\$\%\^\&\*\(\)\+\=\']{1,}$/i.test(val);
    }, 'this field not valid');

    $.validator.addMethod("selectEq", function(value, element, arg) {
        return arg !== value;
    }, `this field not valid`);

    $('#formEditUser').validate({
        rules: jqv_rules
    });

    $('.btn-edit-p').each(function() {
        $(this).on('click', function() {
            let user = $(this).data('user');
            $('#ubahCPassword #ud').val(user);
        });
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
    });
</script>
<?= $this->endSection(); ?>