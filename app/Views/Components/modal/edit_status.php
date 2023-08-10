<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="ubahStatusAduan">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status Aduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>
                    Anda akan merubah status aduan<br />dengan nomor aduan : <span id="una"></span>
                </h6>

                <form action="<?= base_url('/aduan/update_stts') ?>" method="post" class="mt-4">
                    <input type="hidden" id="data" name="data">
                    <div class="form-group">
                        <div class="form-label">Pilih Status</div>
                        <select name="status" id="status" class="form-control">
                            <option value="-">Pilih Status</option>
                            <?php foreach ($status as $s) : ?>
                                <option value="<?= $s->id_status ?>"><?= $s->status_aduan ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-<?= userColor() ?> btn-sm btn-icon shadow-sm"><i class="fa fa-save mr-2"></i>SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>