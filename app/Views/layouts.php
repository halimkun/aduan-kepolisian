<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= isset($title) ? $title : 'Sistem Pelaporan' ?></title>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/fav/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/fav/favicon.ico') ?>" type="image/x-icon">

    <style>
        .error {
            color: red !important;
        }

        input.error {
            border: 1px solid red !important;
        }

        /* input has error class active or focus */
        input.error:focus {
            border: 1px solid red !important;
        }

        input.error:focus {
            border: 1px solid red !important;
        }
    </style>

    <!-- Top Script -->
    <?= $this->include('Components/top_script'); ?>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/fav/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/fav/favicon.ico') ?>" type="image/x-icon">

    <!-- PWA Start -->
    <meta name="theme-color" content="#6366F1" />
    <meta name="Description" content="mempermudah penggunaan untuk membuat laporan kepolisian" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="apple-mobile-web-app-title" content="Laporan Kepolisian" />

    <meta name="msapplication-TileImage" content="/assets/fav/android-chrome-512x512.png" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />

    <link rel="apple-touch-icon" href="/assets/fav/apple-touch-icon.png" />

    <!-- manifest -->
    <link rel="manifest" href="/manifest.json" />
    <!-- PWA End -->

    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/css/ol.css" type="text/css">
    <script>
        if (navigator.serviceWorker) {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                console.log('ServiceWorker registration successful with scope:', registration.scope);
            }).catch(function(error) {
                console.log('ServiceWorker registration failed:', errror);
            });
        }
    </script>

</head>

<body class="theme-<?= userColor() ?>" style="overflow: normal !important;">
    <?= $this->include('Components/settings'); ?>
    <div id="app">
        <div class="main-wrapper">
            <!-- Navbar -->
            <?= $this->include('Components/navbar'); ?>

            <!-- Sidebar -->
            <?= $this->include('Components/sidebar'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content'); ?>
            </div>
            <!-- Footer -->
            <?= $this->include('Components/footer') ?>
        </div>
    </div>

    <!-- Bottom Script -->
    <?= $this->include('Components/bottom_script') ?>
</body>

</html>
