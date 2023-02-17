<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12 order-md-2 order-sm-2 order-xs-2 order-lg-1">
            <div class="card">
                <div class="card-header">
                    <h4>Statistik Bulanan</h4>
                    <div class="card-header-action">
                        <select name="tahun" id="tahun" class="custom-select">
                            <?php foreach ($tahun as $t) : ?>
                                <option value="<?= $t->tahun ?>"><?= $t->tahun ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="statistikBulanan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 order-md-1 order-sm-1 order-xs-1 order-lg-2">
            <div class="card card-statistic-2" data-toggle='tooltip' title="hari ini">
                <div class="card-icon bg-warning">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Aduan Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <?= count($aduan_terbaru) ?>
                    </div>
                </div>
            </div>

            <div class="card card-statistic-2">
                <div class="card-icon bg-success">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Aduan</h4>
                    </div>
                    <div class="card-body">
                        <?= count($aduan) ?>
                    </div>
                </div>
            </div>

            <div class="card card-statistic-2">
                <div class="card-icon bg-<?= userColor() ?>">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <?= count($pengguna) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12 order-md-2 order-sm-2 order-xs-2 order-lg-1"></div>
        <div class="col-lg-4 col-md-12 col-sm-12 order-md-1 order-sm-1 order-xs-1 order-lg-2"></div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('topLibrary'); ?>
<!-- CSS Libraies -->
<link rel="stylesheet" href="<?= base_url('assets/modules/select2/css/select2.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('bottomLibrary'); ?>
<script src="<?= base_url('assets/modules/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/chart.min.js') ?>"></script>

<script>
    // ready
    $(document).ready(function() {
        getYearly($('#tahun').val());

        const ctx = document.getElementById('statistikBulanan').getContext('2d');
        var yearlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    label: 'Aduan',
                    borderColor: '#6777ef',
                    backgroundColor: '#6777ef',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    hoverRadius: 10,
                    borderWidth: 3,
                    lineTension: 0,
                    radius: 5,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                ticks: {
                    beginAtZero: true,
                    stepSize: 1,
                }
            }
        });

        $('#tahun').on('change', function() {
            getYearly($(this).val());
        });

        function toMonthName(monthNumber) {
            const date = new Date();
            date.setMonth(monthNumber - 1);

            return date.toLocaleString('en-US', {
                month: 'short',
            });
        }

        async function getYearly(year) {
            const url = `<?= base_url('api/aduan/chart/year') ?>/${year}`
            const response = await fetch(url);
            const data = await response.json();

            yearlyChart.data.labels = [];
            yearlyChart.data.datasets[0].data = [];

            if (data.success) {
                data.data.map((item, index) => {
                    yearlyChart.data.labels.push(toMonthName(item.bulan));
                    yearlyChart.data.datasets[0].data.push(item.total);
                })
                yearlyChart.update();
            }
        }
    });
</script>
<?= $this->endSection(); ?>