<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Daftar Aduan Saya</h1>
        <div class="section-header-breadcrumb">
            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalAduanInfo">
                <i class="fa fa-info-circle"></i>
            </button>
        </div>
    </div>

    <?= $this->include('Components/flash_message'); ?>

    <div class="section-body">

        <?php if (!$profile_lengkap) : ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-info mr-1"></i> Silahkan <a href="/warga/profile"><u>lengkapi profil</u></a> anda terlebih dahulu untuk dapat menggunakan fitur yang ada.
            </div>
        <?php else : ?>
            <div class="card shadow rounded">
                <div class="card-header">
                    <h4 class="text-<?= userColor() ?>">Daftar Aduan</h4>
                </div>
                <div class="card-body">
                    <?php if ($agent->isMobile()) : ?>
                        <div class="text-right">
                            <button class="btn btn-<?= userColor() ?> btn-sm mb-3 shadow-sm" type="button" data-toggle="collapse" data-target="#colFilter" aria-expanded="false" aria-controls="colFilter">
                                <i class="fa fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                    <?php endif ?>

                    <div class="row <?= $agent->isMobile() ? 'collapse' : '' ?>" <?php if ($agent->isMobile()) : ?> id="colFilter" <?php endif; ?>>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterSearch">Search</label>
                                <input type="text" name="filterSearch" class="form-control" placeholder="input keywords" id="filterSearch">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterStatus">Status</label>
                                <select name="filterStatus" id="filterStatus" class="custom-select">
                                    <option value="">Semua Status</option>
                                    <?php foreach ($status as $item) : ?>
                                        <option value="<?= $item->status_aduan ?>"><?= $item->status_aduan ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterJenis">Jenis</label>
                                <select class="custom-select" id="filterJenis">
                                    <option value="">Semua Jenis Aduan</option>
                                    <?php foreach ($jenis as $item) : ?>
                                        <option value="<?= $item->jenis_aduan?>"><?= $item->jenis_aduan ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterTgl">Tanggal</label>
                                <input type="date" name="filterTgl" id="filterTgl" class="form-control" placeholder="Pilih Tanggal">
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover" id="tableAduanWarga">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor</th>
                                <th><span class="sr-only">Status</span></th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Aduan</th>
                                <th>Lokasi</th>
                                <th>kronologi</th>
                                <th width="50"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($aduan as $item) : ?>
                                <?php $loc = explode(",", $item->latlang) ?>
                                <tr data-u="<?= $item->user_id ?>" data-i="<?= $item->id ?>">
                                    <td id="row_nomor"><?= $i++ ?></td>
                                    <td id="row_nomor_aduan"><kbd><?= $item->nomor ?></kbd></td>
                                    <td id="row_status" data-dt='<?= $item->id ?>' data-stts='<?= getStatusAduan($item->status)->status_aduan ?>'><?= badgeStatusGen(getStatusAduan($item->status)->status_aduan) ?></td>
                                    <td id="row_tanggal">
                                        <abbr title="Tanggal Kejadian"><?= $item->tanggal ?></abbr>
                                        <a href="https://maps.google.com/maps?&z=15&q=<?= $loc[0] ?>+<?=$loc[1]?>" target="_blank" title="buka maps"><i class="fa fa-map-marker-alt pl-3"></i></a>
                                    </td>
                                    <td id="row_jenis"><b><u><?= getJenisAduan($item->jenis) ? getJenisAduan($item->jenis)->jenis_aduan : "-" ?></u></b></td>
                                    <td id="row_judul"><?= $item->judul ?></td>
                                    <td id="row_lokasi"><?= $item->lokasi ?></td>
                                    <td id="row_kronologi"><?= $item->keterangan ?></td>
                                    <td id="row_manipulate_data">
                                        <button <?= getStatusAduan($item->status)->status_aduan == 'selesai' || getStatusAduan($item->status)->status_aduan == 'dibatalkan' || getStatusAduan($item->status)->status_aduan == 'dalam proses' ? 'disabled' : '' ?> class="btn btn-sm shadow btn-info btn-aduan-edit" data-nomor="<?= $item->nomor ?>"><i class="fa fa-pen"></i></button>
                                        <button <?= getStatusAduan($item->status)->status_aduan == 'selesai' || getStatusAduan($item->status)->status_aduan == 'dibatalkan' || getStatusAduan($item->status)->status_aduan == 'dalam proses' ? 'disabled' : '' ?> class="btn btn-sm shadow btn-danger btn-aduan-delete" data-nomor="<?= $item->nomor ?>" data-tanggal="<?= $item->tanggal ?>" data-judul="<?= $item->judul ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif ?>

    </div>
</section>

<?php if ($profile_lengkap) : ?>
    <!-- bootstrap modal modalAduanInfo -->
    <div class="modal fade" id="modalAduanInfo" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalAduanInfoTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAduanInfoTitle">Perhatian !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li class="font-weight-bold">
                            Aduan tidak dapat <span class="text-danger">dihapus</span>.
                        </li>
                        <li class="font-weight-bold">
                            Aduan hanya bisa <span class="text-info">diubah statusnya saja</span>.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- modal aduan delete -->
    <div class="modal fade" id="modalAduanDelete" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalAduanDeleteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAduanDeleteTitle">Perhatian !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>
                        Apakah anda yakin ingin menghapus aduan berikut ?
                    </h6>
                    <hr>

                    <div class="mb-3">
                        <label for="aduanNomor">Nomor aduan</label>
                        <input type="text" class="form-control" readonly name="aduanNomor" id="aduanNomor">
                    </div>
                    <div class="mb-3">
                        <label for="aduanJudul">Judul aduan</label>
                        <input type="text" class="form-control" readonly name="aduanJudul" id="aduanJudul">
                    </div>
                    <div class="mb-3">
                        <label for="aduanTanggal">Tanggal aduan</label>
                        <input type="datetime" class="form-control" readonly name="aduanTanggal" id="aduanTanggal">
                    </div>

                    <p class="text-danger mt-3">
                        <i class="fa fa-exclamation-triangle mr-1"></i> Aduan yang sudah dihapus tidak dapat dikembalikan lagi.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn shadow text-dark btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn shadow btn-danger" id="btnAduanDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>

<?= $this->section('topLibrary'); ?>
<!-- CSS Libraies -->
<link rel="stylesheet" href="<?= base_url('assets/modules/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/datatables.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/chocolat/css/chocolat.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('bottomLibrary'); ?>
<?php if ($profile_lengkap) : ?>
    <script>
        $.fn.modal.Constructor.prototype._enforceFocus = function() {};
    </script>

    <!--- Tambah Aduan Model --->
    <?= $this->include('/Components/modal/detail_aduan'); ?>

    <!-- JS Libraies -->
    <script src="<?= base_url('assets/modules/select2/js/select2.full.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/datatables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/chocolat/js/jquery.chocolat.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // tableAduanWarga
            var tableAduanWarga = $('#tableAduanWarga').DataTable({
                "responsive": !0,
                "pageLength": 25,
                "dom": 'Brtip',
                "buttons": [{
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        exportOptions: {
                            columns: [1, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        exportOptions: {
                            columns: [1, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: [1, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                        text: '<i class="fas fa-print"></i> Print',
                        exportOptions: {
                            columns: [1, 3, 4, 5, 6, 7]
                        }
                    }
                ]
            });

            // filterSearch on keyup
            $('#filterSearch').on('keyup', function() {
                tableAduanWarga.search(this.value).draw();
            });

            // filterStatus on change
            $('#filterStatus').on('change', function() {
                tableAduanWarga.column(2).search(this.value).draw();
            });

            // filterJenis
            $('#filterJenis').on('change', function() {
                tableAduanWarga.column(4).search(this.value).draw();
            });

            // filterTgl
            $('#filterTgl').on('change', function() {
                tableAduanWarga.column(3).search(this.value).draw();
            });

            // btn-aduan-edit on click redirect to edit aduan
            $('#tableAduanWarga tbody').on('click', '.btn-aduan-edit', function() {
                var nomor = $(this).data('nomor');
                window.location.href = '<?= base_url('warga/aduan') ?>/' + nomor;
            });

            // btn-aduan-delete on click show modal delete
            $('#tableAduanWarga tbody').on('click', '.btn-aduan-delete', function() {
                var nomor = $(this).data('nomor');
                var tanggal = $(this).data('tanggal');
                console.log(tanggal);
                var judul = $(this).data('judul');
                $('#aduanNomor').val(nomor);
                $('#aduanTanggal').val(tanggal);
                $('#aduanJudul').val(judul);
                $('#modalAduanDelete').modal('show');
            });

            // btnAduanDelete on click delete aduan
            $('#btnAduanDelete').on('click', function() {
                var nomor = $('#aduanNomor').val();
                $.ajax({
                    url: '<?= base_url('warga/aduan/delete') ?>',
                    type: 'POST',
                    data: {
                        nomor: nomor
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: true,
                                timer: 3000
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '<?= base_url('warga/aduan') ?>';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message,
                                showConfirmButton: true,
                                timer: 3000
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan, silahkan coba lagi',
                            showConfirmButton: true,
                            timer: 3000
                        });
                    }
                });
            });
        });
    </script>
<?php endif; ?>
<?= $this->endSection(); ?>