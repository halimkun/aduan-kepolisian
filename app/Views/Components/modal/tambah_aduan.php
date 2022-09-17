<div class="modal fade" tabindex="-1" role="dialog" id="tambahAduan">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Aduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/aduan/create" method="post" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Data Pelapor</h6>
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
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" readonly style="height: 136px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Detail Aduan</h6>
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
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" style="height: 100px;" placeholder="Jelaskan mengenai hal yang dilaporkan"></textarea>
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
                        <button type="submit" class="btn btn-primary shadow"><i class="fa fa-save"></i> SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>