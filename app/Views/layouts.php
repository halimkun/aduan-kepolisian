<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Stisla</title>

    <!-- Top Script -->
    <?= $this->include('Components/top_script'); ?>
</head>

<body>
    <?= $this->include('Components/settings') ;?>
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