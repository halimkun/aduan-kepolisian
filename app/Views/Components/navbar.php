<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li><a href="#" class="nav-link nav-link-lg nav-link-user">
                <img alt="image" src="<?= base_url('/assets/img/avatar/avatar-1.png') ?>" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block" style="text-transform: capitalize;">Selamat datang, <b><?= user()->username ?></b></div>
            </a>
        </li>
    </ul>
</nav>