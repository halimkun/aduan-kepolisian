<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="gantiRoles">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user-cog mr-2"></i> Ubag Group Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle mr-2"></i> <b>Perhatian !</b> <br>
                    Perubahan group pengguna akan mengubah hak akses pengguna tersebut, yang memungkinkan pengguna tersebut dapat mengakses fitur sesuai dengan group yang dipilih.
                </div>
                <form action="<?= base_url('/user/updateRoles') ?>" id="fgrole" method="post" autocomplete="off">
                    <input type="hidden" name="user_detail" id="udetail">
                    <div class="mb-3">
                        <label for="role">Pilih Group Pengguna</label>
                        <select name="role" id="rile" class="custom-select">
                            <option value="-">-- SILAHKAN PILIH --</option>
                            <option value="petugas">Petugas</option>
                            <option value="pengguna">Pengguna</option>
                        </select>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary text-dark shadow-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-<?= userColor() ?> shadow-sm">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>