<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<div class="section">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Tambah Data Aduan</h1>
    </div>

    <div class="card card-body" id="tambahAduan">
        <form action="<?= base_url('/aduan/create') ?>" method="post" enctype="multipart/form-data">
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
                            <select class="select2 user_select" id="users" name="users">
                                <option value="-">Pilih Pengguna</option>
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user->id ?>"><?= $user->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_hp">Nomor HP</label>
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" readonly style="height: 136px;"></textarea>
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
                            <select class="select2" id="jenis_aduan" name="jenis_aduan">
                                <option value="-">Pilih Jenis Aduan</option>
                                <option value="kehilangan">Kehilangan</option>
                                <option value="pencurian">Pencurian</option>
                                <option value="kejadian">Kejadian</option>
                                <option value="kecelakaan">Kecelakaan</option>
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
                    <label for="lokasi">Lokasi Kejadian</label>
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
</div>
<?= $this->endSection(); ?>



<?= $this->section('topLibrary'); ?>
<!-- CSS Libraies -->
<link rel="stylesheet" href="<?= base_url('assets/modules/select2/css/select2.min.css') ?>">
<?= $this->endSection(); ?>



<?= $this->section('bottomLibrary'); ?>
<!-- JS Libraies -->
<script src="<?= base_url('assets/modules/select2/js/select2.full.min.js') ?>"></script>

<script>
    $(document).ready(function() {
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
    });
</script>
<?= $this->endSection(); ?>