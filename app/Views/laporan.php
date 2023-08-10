<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Laporan</h1>
    </div>

    <?php $r = user()->getRoles(); ?>

    <div class="card">
        <div class="card-header">
            <h4 class="text-<?= userColor() ?>">Cetak Periode Laporan</h4>
        </div>
        <div class="card-body">
            <form action="/admin/laporan/cetak" method="post">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="custom-select">
                                <option value="">Semua Status</option>
                                <?php foreach ($status as $item) : ?>
                                    <option value="<?= $item->id_status ?>"><?= $item->status_aduan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <select class="custom-select" name="jenis" id="jenis">
                                <option value="">Semua Jenis Aduan</option>
                                <?php foreach ($jenis as $item) : ?>
                                    <option value="<?= $item->id_jenis ?>"><?= $item->jenis_aduan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select class="custom-select" name="tahun" id="tahun">
                                <?php foreach ($tahun as $t) : ?>
                                    <option value="<?= $t->tahun ?>"><?= $t->tahun ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <select class="custom-select" name="bulan" id="bulan">
                                <option value="">Semua Bulan Aduan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="12">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="w-full d-flex justify-content-end">
                    <button type="submit" class="btn btn-<?= userColor() ?> shadow" id="btnCetak">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>