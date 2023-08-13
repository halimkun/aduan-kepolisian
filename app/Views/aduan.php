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
                        <a class="btn btn-sm btn-icon btn-<?= userColor() ?> shadow-sm" href="/admin/aduan/add">
                            <i class="fas fa-plus"></i>
                        </a>
                        <!-- <button class="btn btn-sm btn-icon btn-<?= userColor() ?> shadow-sm" data-toggle="modal" data-target="#tambahAduan">
                            <i class="fas fa-plus"></i>
                        </button> -->
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
                                <?php foreach ($status as $item) : ?>
                                    <option value="<?= $item->status_aduan ?>"><?= $item->status_aduan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="filterJenis">Jenis</label>
                            <select class="form-control" id="filterJenis">
                                <option value="">Semua Jenis Aduan</option>
                                <?php foreach ($jenis as $item) : ?>
                                    <option value="<?= $item->jenis_aduan ?>"><?= $item->jenis_aduan ?></option>
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
                            <th class="d-none">kronologi</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($aduan as $item) : ?>
                            <?php $loc = explode(",", $item->latlang) ?>
                            <tr data-u="<?= $item->user_id ?>" data-i="<?= $item->id ?>">
                                <td id="row_nomor"><?= $i++ ?></td>
                                <td id="row_nomor_aduan"><kbd><?= $item->nomor ?></kbd></td>
                                <td id="row_status" data-dt='<?= $item->id ?>' data-stts='<?= $item->status ?>'><?= badgeStatusGen(getStatusAduan($item->status)->status_aduan) ?></td>
                                <td id="row_pelapor"><?= getUserName($item->user_id) ?></td>
                                <td id="row_tanggal">
                                    <abbr title="Tanggal Kejadian"><?= date_format(date_create($item->tanggal), "D, d F Y") ?></abbr>
                                </td>
                                <td id="row_jenis"><b><u><?= getJenisAduan($item->jenis) ? getJenisAduan($item->jenis)->jenis_aduan : "-" ?></u></b></td>
                                <td id="row_judul"><?= $item->judul ?></td>
                                <td id="row_lokasi"><?= $item->lokasi ?></td>
                                <td id="row_kronologi" class="d-none"><?= $item->keterangan ?></td>
                                <td id="row_action" style="width: 60px">
                                    <a class="btn btn-sm btn-icon shadow btn-secondary text-danger" href="https://maps.google.com/maps?&z=15&q=<?= $loc[0] ?>+<?= $loc[1] ?>" target="_blank" title="buka maps"><i class="fa fa-map-marker-alt"></i></a>
                                    <button class="btn btn-update-status btn-sm btn-icon btn-<?= userColor() ?> shadow-sm" data-stts='<?= $item->status ?>' data-item="<?= $item->id ?>" title="Update Status Aduan">
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
<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/build/ol.js"></script>

<script>
    $(document).ready(function() {
        var table = $("#tableAduan").DataTable({
            "responsive": !0,
            "pageLength": 25,
            "dom": 'Brtip',
            "buttons": [{
                    extend: 'excelHtml5',
                    className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm btn-<?= userColor() ?> shadow',
                    text: '<i class="fas fa-print"></i> Print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ]
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

        /** handle create */
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
        $("#tableAduan tbody").on("click", ".btn-update-status", (function() {
            const t = $("#ubahStatusAduan");
            const status = $(this).data('stts');
            const item = $(this).data('item');
            t.find("#data").val(item), t.find("#status").val(status), t.modal("toggle")
        }));

        var selector = "";
        <?php if (!$agent->isMobile()) : ?>
            selector = "tr td#row_nomor, tr td#row_nomor_aduan, tr td#row_status, tr td#row_pelapor, tr td#row_tanggal, tr td#row_jenis, tr td#row_judul, tr td#row_lokasi, tr td#row_kronologi";
        <?php else : ?>
            selector = "tr td#row_nomor_aduan, tr td#row_status, tr td#row_pelapor, tr td#row_tanggal, tr td#row_jenis, tr td#row_judul, tr td#row_lokasi, tr td#row_kronologi";
        <?php endif; ?>

        const modalDetail = $("#detailAduan");
        $('#tableAduan tbody').on('click', selector, function() {
            modalDetail.modal('toggle');

            $(".load_data_detail").show();

            modalDetail.find(".dLaporan").empty();
            modalDetail.find(".dPelapor").empty();
            modalDetail.find(".judulLaporan").empty()

            setTimeout(async () => {
                var data = table.row(this).data();
                const o = await getUserData($(this).parent().data('u'));
                const i = await getAduanData($(this).parent().data('i'));

                console.log(i);

                modalDetail.find(".judulLaporan").empty().append(i.data.judul);

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
                        <div class="mb-3"> <h5>Detail Laporan</h5><div class="dropdown-divider"></div><table style="width:100% !important;"> <tr><td style="width:40%;"><b>Nomor</b></td><td style="width:30px;">:</td><td>${i.data.nomor}</td></tr><tr><td style="width:40%;"><b>Status</b></td><td style="width:30px;">:</td><td>${i.data.status_aduan}</td></tr><tr><td style="width:40%;"><b>Tanggal Diajukan</b></td><td style="width:30px;">:</td><td>${i.data.tanggal}</td></tr><tr><td style="width:40%;"><b>Jenis</b></td><td style="width:30px;">:</td><td>${i.data.jenis_aduan}</td></tr><tr><td style="width:40%;"><b>Judul</b></td><td style="width:30px;">:</td><td>${i.data.judul}</td></tr><tr><td style="width:40%;"><b>Lokasi</b></td><td style="width:30px;">:</td><td>${i.data.lokasi} <span class="mx-3"><a class="btn btn-sm btn-icon shadow btn-secondary text-danger" href="https://maps.google.com/maps?&z=15&q=<?= $loc[0] ?>+<?= $loc[1] ?>" target="_blank" title="buka maps"><i class="fa fa-map-marker-alt"></i></a></span></td></tr><tr><td style="width:40%;"><b>kronologi</b></td><td style="width:30px;">:</td><td>${i.data.keterangan}</td></tr></table> </div> <div class="mb-3"> <h5>Bukti Laporan</h5><div class="dropdown-divider"></div><div class="gallery gallery-md" data-item-height="150"><div class="gallery-item" data-image="${foto}" data-title="${i.data.judul}"></div></div></div>
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

        var map = null;

        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    var myLatlng = new ol.proj.transform([longitude, latitude], 'EPSG:4326', 'EPSG:3857');

                    // modalSelectLocation latlang
                    $('#modalSelectLocation #latlang').val(latitude + ', ' + longitude);

                    map = new ol.Map({
                        target: 'map',
                        layers: [
                            new ol.layer.Tile({
                                source: new ol.source.OSM()
                            })
                        ],
                        view: new ol.View({
                            center: myLatlng,
                            zoom: 15
                        })
                    });

                    var marker = new ol.Feature({
                        geometry: new ol.geom.Point(
                            myLatlng
                        ),
                    });

                    var iconStyle = new ol.style.Style({
                        image: new ol.style.Icon({
                            anchor: [0.5, 1],
                            scale: 0.03,
                            src: 'https://www.iconarchive.com/download/i103443/paomedia/small-n-flat/map-marker.1024.png',
                        }),
                    });

                    marker.setStyle(iconStyle);

                    var vectorSource = new ol.source.Vector({
                        features: [marker]
                    });

                    var markerVectorLayer = new ol.layer.Vector({
                        source: vectorSource,
                    });

                    map.addLayer(markerVectorLayer);

                    // map on click get coordinate and set marker
                    map.on('click', function(evt) {
                        var coordinate = evt.coordinate;
                        var myLatlng = ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');

                        marker.setGeometry(new ol.geom.Point(
                            coordinate
                        ));

                        $('#modalSelectLocation #latlang').val(myLatlng[1] + ', ' + myLatlng[0]);

                    });
                }, function(error) {
                    alert('Lokasi diperlukan untuk menambahkan aduan, silahkan aktifkan GPS anda dan izinkan aplikasi untuk mengakses lokasi anda.');
                    window.location.href = window.history.back();
                }, {
                    maximumAge: 10000,
                    timeout: 5000,
                    enableHighAccuracy: true
                });
            } else {
                alert('Geolocation is not supported by this browser.');
                window.location.href = window.history.back();
            }
        }

        initMap();

        $('#modalSelectLocation').on('shown.bs.modal', function() {
            map.updateSize();
        });

        $('#modalSelectLocation').on('hidden.bs.modal', function() {
            map.updateSize();
        });

        clearMarker = () => {
            var vectorSource = new ol.source.Vector({
                features: []
            });

            var markerVectorLayer = new ol.layer.Vector({
                source: vectorSource,
            });

            map.addLayer(markerVectorLayer);
        }

        setLatLang = () => {
            var latlang = $('#modalSelectLocation #latlang').val();
            $('#fAddAduan #latlang').val(latlang);
        }
    });
</script>
<?= $this->endSection(); ?>