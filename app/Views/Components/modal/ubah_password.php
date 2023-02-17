<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="ubahPassword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i><b> Perhatian!</b>
                    <p>
                        apakah anda yakin akan mengubah password user <b id="namaUser"></b> ?
                    </p>
                    <hr>
                    password akan dikembalikan menjadi password default. <kbd>Password Default</kbd> user adalah tanggal lahir dengan format (ddmmyyyy), contoh <code>05121998</code>
                </div>
                <form action="<?= base_url('/user/updatePass') ?>" method="post" autocomplete="off">
                    <input type="hidden" id="ud" name="user_detail" value="">
                    <input type="hidden" id="np" name="np" value="">
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary text-dark shadow-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-<?= userColor() ?> shadow-sm">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>