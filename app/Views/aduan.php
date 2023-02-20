<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Aduan</h1>
        <div class="section-header-breadcrumb">
            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalAduanInfo">
                <i class="fa fa-info-circle"></i>
            </button>
        </div>
    </div>

    <?= $this->include('Components/flash_message'); ?>

    <div class="section-body">
        <div class="card shadow rounded">
            <div class="card-header">
                <h4 class="text-<?= userColor() ?>">Daftar Aduan</h4>
                <?php if ($tambah_aduan) : ?>
                    <div class="card-header-action">
                        <button class="btn btn-sm btn-icon btn-<?= userColor() ?> shadow-sm" data-toggle="modal" data-target="#tambahAduan">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                <?php endif ?>
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
                            <select name="filterStatus" id="filterStatus" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="belum diproses">Belum Diproses</option>
                                <option value="dalam proses">Dalam Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filterJenis">Jenis</label>
                            <select class="form-control" id="filterJenis">
                                <option value="">Semua Jenis Aduan</option>
                                <option value="kehilangan">Kehilangan</option>
                                <option value="pencurian">Pencurian</option>
                                <option value="kejadian">Kejadian</option>
                                <option value="kecelakaan">Kecelakaan</option>
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

                <table class="table table-hover" id="tableAduan">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor</th>
                            <th><span class="sr-only">Status</span></th>
                            <th>Oleh</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Aduan</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($aduan as $item) : ?>
                            <tr data-u="<?= $item->user_id ?>" data-i="<?= $item->id ?>">
                                <td id="row_nomor"><?= $i++ ?></td>
                                <td id="row_nomor_aduan"><kbd><?= $item->nomor ?></kbd></td>
                                <td id="row_status" data-dt='<?= $item->id ?>' data-stts='<?= $item->status ?>'><?= badgeStatusGen($item->status) ?></td>
                                <td id="row_pelapor"><?= getUserName($item->user_id) ?></td>
                                <td id="row_tanggal"><abbr title="Tanggal Kejadian"><?= $item->tanggal ?></abbr></td>
                                <td id="row_jenis"><b><u><?= $item->jenis ?></u></b></td>
                                <td id="row_judul"><?= $item->judul ?></td>
                                <td id="row_lokasi"><?= $item->lokasi ?></td>
                                <td id="row_keterangan"><?= $item->keterangan ?></td>
                                <td id="row_action">
                                    <button class="btn btn-update-status btn-sm btn-icon btn-<?= userColor() ?> shadow-sm" data-item="<?= $item->id ?>" title="Update Status Aduan">
                                        <i class="fas fa-tag"></i>
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
<script>
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
</script>

<?php if (isset($tambah_aduan) && $tambah_aduan) : ?>
    <?= $this->include('/Components/modal/tambah_aduan'); ?>
<?php endif ?>
<!--- Tambah Aduan Model --->
<?= $this->include('/Components/modal/detail_aduan'); ?>
<?= $this->include('/Components/modal/edit_status'); ?>

<!-- JS Libraies -->
<script src="<?= base_url('assets/modules/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/chocolat/js/jquery.chocolat.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        /** data table initialize */
        var table = $("#tableAduan").DataTable({
            responsive: !0,
            dom: "Brtp",
            buttons: [{
                extend: "copy",
                text: "Copy",
                className: "btn btn-sm btn-icon btn-secondary text-dark shadow-sm",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8]
                }
            }, {
                extend: "excel",
                text: "Excel",
                className: "btn btn-sm btn-icon btn-secondary text-dark shadow-sm",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8]
                }
            }, {
                extend: "print",
                text: "Print",
                className: "btn btn-sm btn-icon btn-secondary text-dark shadow-sm",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8]
                }
            }]
        });

        $("#filterSearch").on("keyup", (function() {
            table.search(this.value).draw()
        })), $("#filterStatus").on("change", (function() {
            table.column(2).search(this.value).draw()
        })), $("#filterTgl").on("change", (function() {
            table.column(4).search(this.value).draw()
        })), $("#filterJenis").on("change", (function() {
            table.column(5).search(this.value).draw()
        }));

        /** get data aduan dan user */
        async function getAduanData(a) {
            return await $.ajax({
                url: "<?= base_url('/aduan/getById') ?>",
                type: "POST",
                data: {
                    id: a
                },
                dataType: "JSON"
            })
        }
        async function getUserData(a) {
            return await $.ajax({
                url: "<?= base_url('/user/getById') ?>",
                type: "POST",
                data: {
                    id: a
                },
                dataType: "JSON"
            })
        }

        /** hanle create */
        $(".user_select").on("change", (async function() {
            var a = $(this).val();
            if ($(".load_user_input").show(), "-" == a) $("#tambahAduan #pekerjaan").val(""), $("#tambahAduan #jenis_kelamin").val(""), $("#tambahAduan #tanggal_lahir").val(""), $("#tambahAduan #alamat").val(""), $(".load_user_input").hide();
            else {
                const t = await getUserData(a);
                setTimeout((() => {
                    "success" == t.status ? ($("#tambahAduan #pekerjaan").val(t.data.pekerjaan), $("#tambahAduan #jenis_kelamin").val(t.data.jenis_kelamin), $("#tambahAduan #tanggal_lahir").val(t.data.tanggal_lahir), $("#tambahAduan #tempat_lahir").val(t.data.tempat_lahir), $("#tambahAduan #agama").val(t.data.agama), $("#tambahAduan #nomor_hp").val(t.data.nomor_hp), $("#tambahAduan #alamat").val(t.data.alamat)) : alert("Gagal mengambil data user"), $(".load_user_input").hide()
                }), 1e3)
            }
        }));

        /** handle update status */
        $("#tableAduan tbody").on("click", "tr td#row_action", (function() {
            const t = $("#ubahStatusAduan");
            var a = table.row(this).data(),
                d = $(this).parent().find("td#row_status").data("stts"),
                n = $(this).parent().find("td#row_status").data("dt");
            t.find("#una").empty().append(a[1]), t.find("#status").val(d), t.find("#data").val(n), t.modal("toggle")
        }));

        <?php if (!$agent->isMobile()) : ?>
            const modalDetail = $("#detailAduan");
            $('#tableAduan tbody').on('click', 'tr td#row_nomor, tr td#row_nomor_aduan, tr td#row_status, tr td#row_pelapor, tr td#row_tanggal, tr td#row_jenis, tr td#row_judul, tr td#row_lokasi, tr td#row_keterangan', function() {
                modalDetail.modal('toggle');

                $(".load_data_detail").show();

                modalDetail.find(".dLaporan").empty();
                modalDetail.find(".dPelapor").empty();
                modalDetail.find(".judulLaporan").empty()

                setTimeout(async () => {
                    var data = table.row(this).data();
                    const o = await getUserData($(this).parent().data('u'));
                    const i = await getAduanData($(this).parent().data('i'));

                    modalDetail.find(".judulLaporan").empty().append(i.data.judul + " ( " + i.data.nomor + " ) ");

                    const detailPelapor = `
                        <div class="mb-3"> <h5>Detail Pelapor</h5><div class="dropdown-divider"></div><table style="width:100% !important;"> <tr><td style="width:40%;"><b>Nama</b></td><td style="width:30px;">:</td><td>${o.data.nama}</td></tr><tr><td style="width:40%;"><b>Tempat Lahir</b></td><td style="width:30px;">:</td><td>${o.data.tempat_lahir}</td></tr><tr><td style="width:40%;"><b>Tanggal Lahir</b></td><td style="width:30px;">:</td><td>${o.data.tanggal_lahir}</td></tr><tr><td style="width:40%;"><b>Jenis Kelamin</b></td><td style="width:30px;">:</td><td>${o.data.jenis_kelamin}</td></tr><tr><td style="width:40%;"><b>Agama</b></td><td style="width:30px;">:</td><td>${o.data.agama}</td></tr><tr><td style="width:40%;"><b>Pekerjaan</b></td><td style="width:30px;">:</td><td>${o.data.pekerjaan}</td></tr><tr><td style="width:40%;"><b>Nomor HP</b></td><td style="width:30px;">:</td><td><a href='tlp:${o.data.nomor_hp}'>${o.data.nomor_hp}</a></td></tr><tr><td style="width:40%;"><b>Email</b></td><td style="width:30px;">:</td><td><a href='mailto:${o.data.email}'>${o.data.email}</a></td></tr><tr><td style="width:40%;"><b>Alamat</b></td><td style="width:30px;">:</td><td>${o.data.alamat}</td></tr></table> </div>
                    `;

                    // if i.data.foto is url http or https
                    if (i.data.foto.match(/^(http|https):\/\//)) {
                        var foto = i.data.foto;
                    } else {
                        var foto = '/foto_kejadian/' + i.data.foto;
                    }

                    const detailLaporan = `
                        <div class="mb-3"> <h5>Detail Laporan</h5><div class="dropdown-divider"></div><table style="width:100% !important;"> <tr><td style="width:40%;"><b>Nomor</b></td><td style="width:30px;">:</td><td>${i.data.nomor}</td></tr><tr><td style="width:40%;"><b>Status</b></td><td style="width:30px;">:</td><td>${i.data.status}</td></tr><tr><td style="width:40%;"><b>Tanggal Diajukan</b></td><td style="width:30px;">:</td><td>${i.data.tanggal}</td></tr><tr><td style="width:40%;"><b>Jenis</b></td><td style="width:30px;">:</td><td>${i.data.jenis}</td></tr><tr><td style="width:40%;"><b>Judul</b></td><td style="width:30px;">:</td><td>${i.data.judul}</td></tr><tr><td style="width:40%;"><b>Lokasi</b></td><td style="width:30px;">:</td><td>${i.data.lokasi}</td></tr><tr><td style="width:40%;"><b>Keterangan</b></td><td style="width:30px;">:</td><td>${i.data.keterangan}</td></tr></table> </div> <div class="mb-3"> <h5>Bukti Laporan</h5><div class="dropdown-divider"></div><div class="gallery gallery-md" data-item-height="150"><div class="gallery-item" data-image="${foto}" data-title="${i.data.judul}"></div></div></div>
                    `;

                    modalDetail.find(".dLaporan").append(detailLaporan);
                    modalDetail.find(".dPelapor").append(detailPelapor);

                    const me = $(".gallery .gallery-item");
                    me.attr("href", me.data("image")), me.attr("title", me.data("title")), me.parent().hasClass("gallery-md") && me.css({
                        height: me.parent().data("item-height"),
                        width: me.parent().data("item-height")
                    }), me.css({
                        backgroundImage: 'url("' + me.data("image") + '")'
                    }), jQuery().Chocolat && ($(".gallery").Chocolat({
                        className: "gallery",
                        imageSelector: ".gallery-item"
                    }));

                    $(".load_data_detail").hide();
                }, 1000);
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>