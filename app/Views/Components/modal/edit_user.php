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
                <form action="/user/update" method="post" autocomplete="off"> 
                <input type="hidden" name="user_detail" id="user_detail">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" placeholder="nama lengkap pengguna" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                    <option value="-"> -- PILIH -- </option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tglLahir" id="tglLahir" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" readonly name="username" id="username" placeholder="username pengguna" class="form-control">
                                <small class="text-warning">Username tidak dapat diubah</small>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" placeholder="email pengguna" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" style="height: 136px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary shadow-sm">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>