<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<div class="section">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Tambah Data Aduan</h1>
    </div>

    <div class="section-body">
        <?php if (!$profile_lengkap) : ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-info mr-1"></i> Silahkan <a href="/warga/profile"><u>lengkapi profil</u></a> anda terlebih dahulu untuk dapat menggunakan fitur yang ada.
            </div>
        <?php else : ?>
            <div class="card card-body" id="tambahAduan">
                <form action="<?= base_url('warga/aduan/store') ?>" method="post" id="fAddAduan" enctype="multipart/form-data">
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-<?= userColor() ?>">Data Pelapor</h6>
                        <div class="dropdown-divider"></div>
                        <div class="progress load_user_input my-3" style="display:none;">
                            <div class="progress-bar-animated progress-bar-striped bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="users">Pilih Pengguna</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="<?= user()->nama ?>" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= user()->jenis_kelamin ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= user()->tempat_lahir ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" class="form-control" id="agama" name="agama" value="<?= user()->agama ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= user()->tanggal_lahir ?>" readonly>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= user()->pekerjaan ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nomor_hp">Nomor HP</label>
                                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?= user()->nomor_hp ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" readonly style="height: 136px;"><?= user()->alamat ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-<?= userColor() ?>">Detail Aduan</h6>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_aduan">Jenis Aduan</label>
                                    <select class="custom-select" id="jenis_aduan" name="jenis_aduan">
                                        <option value="-">Pilih Jenis Aduan</option>
                                        <?php foreach ($jenis as $ja) : ?>
                                            <option value="<?= $ja->id_jenis ?>"><?= $ja->jenis_aduan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_kejadian">Waktu Kejadian</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" placeholder="kejadian apa yang terjadi" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="kronologi">kronologi</label>
                            <textarea class="form-control" id="kronologi" name="keterangan" style="height: 100px;" placeholder="Jelaskan mengenai hal yang dilaporkan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="latlang">Lokasi</label>
                            <button class="btn btn-sm mx-3 shadow btn-<?= userColor() ?>" data-toggle="modal" data-target="#modalSelectLocation">
                                <i class="fa fa-map-marker-alt px-3"></i>
                            </button>
                            <input type="text" class="form-control " id="latlang" placeholder="kejadian apa yang terjadi" readonly required name="latlang">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Detail Lokasi Kejadian</label>
                            <textarea class="form-control" id="lokasi" name="lokasi" style="height: 100px;" placeholder="Tuliskan detail lokasi kejadian"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto_aduan">Foto Aduan</label>
                            <input type="file" class="form-control" id="foto_aduan" name="foto_aduan">
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-<?= userColor() ?> shadow"><i class="fa fa-save"></i> SIMPAN</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- modalSelectLocation -->
<div class="modal fade" id="modalSelectLocation" tabindex="-1" role="dialog" aria-labelledby="modalSelectLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSelectLocationLabel">Pilih Lokasi Kejadian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearMarker()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 m-0">
                <div class="p-3">
                    <input type="text" class="form-control" id="latlang" placeholder="kejadian apa yang terjadi" readonly name="latlang">
                </div>
                <div id="map" class="map" style="width:100%; height: 450px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow" data-dismiss="modal" onclick="clearMarker()">Batal</button>
                <button type="button" class="btn btn-<?= userColor() ?> shadow" data-dismiss="modal" onclick="setLatLang()">Pilih</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>



<?= $this->section('topLibrary'); ?>
<style>
    .error {
        color: red !important;
        border-color: red !important;
    }
</style>
<?= $this->endSection(); ?>



<?= $this->section('bottomLibrary'); ?>
<?php if ($profile_lengkap) : ?>
    <!-- validation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/build/ol.js"></script>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("myfield", function(value, element) {
                return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
            }, "Username must contain only letters, numbers, or dashes.");

            $.validator.addMethod('mym', function(val, ele) {
                return this.optional(ele) || /^[a-z0-9\-\s\.\,\_\;\:\?\/\\\|\[\]\{\}\`\~\!\@\#\$\%\^\&\*\(\)\+\=\']{1,}$/i.test(val);
            }, 'this field not valid');

            $.validator.addMethod("selectEq", function(value, element, arg) {
                return arg !== value;
            }, `this field not valid`);

            const fAddAfuan_rules = {
                jenis_aduan: {
                    required: true,
                    selectEq: '-'
                },
                tanggal_kejadian: {
                    required: true
                },
                judul: {
                    required: true,
                    mym: true
                },
                keterangan: {
                    required: true,
                    mym: true
                },
                lokasi: {
                    required: true,
                    mym: true
                },
                foto_aduan: {
                    required: true
                }
            };

            // fAddAduan validation
            $('#fAddAduan').validate({
                rules: fAddAfuan_rules
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
<?php endif ?>
<?= $this->endSection(); ?>