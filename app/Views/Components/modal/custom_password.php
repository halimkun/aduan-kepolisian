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
                <form action="<?= base_url('/user/customPass') ?>" id="formEditPassword" method="post" autocomplete="off">
                    <input type="hidden" id="ud" name="user_detail" value="">
                    <!-- input password & confirmation password -->
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