<div class="main-sidebar">
    <?php
    $roleLogin = user()->getRoles();

    // if in array admin or petugas then url is admin
    if (in_array('admin', $roleLogin) || in_array('petugas', $roleLogin)) {
        $url = 'admin';
    } else {
        $url = 'warga';
    }
    ?>
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('/admin') ?>">POLSEK BOJONG</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PB</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?= makeActiveSidebar('home') ?>">
                <a class="nav-link" href="<?= base_url($url . '/home') ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>

            <li class="menu-header">Data</li>
            <li class="<?= makeActiveSidebar3('aduan') ?>">
                <a class="nav-link" href="<?= base_url($url . '/aduan') ?>"><i class="fa fa-info"></i><span>Daftar Aduan</span></a>
            </li>

            <?php if (in_array('petugas', $roleLogin) || in_array('pengguna', $roleLogin) && isset($tambah_aduan) && $tambah_aduan) : ?>
                <li class="<?= makeActiveSidebar3('add') ?>">
                    <a class="nav-link" href="<?= base_url($url . '/aduan/add') ?>"><i class="fa fa-plus"></i><span>Tambah Aduan</span></a>
                </li>
            <?php endif ?>

            <?php if (in_array('admin', $roleLogin) || in_array('petugas', $roleLogin)) : ?>
                <li class="<?= makeActiveSidebar3('status-jenis') ?>">
                    <a class="nav-link" href="<?= base_url($url . '/status-jenis') ?>"><i class="fas fa-tag"></i><span>Status & Jenis</span></a>
                </li>
            <?php endif ?>

            <?php if (in_array('admin', $roleLogin) || in_array('petugas', $roleLogin)) : ?>
                <li class="menu-header">laporan</li>
                <li class="<?= makeActiveSidebar3('laporan') ?>">
                    <a class="nav-link" href="<?= base_url($url . '/laporan') ?>"><i class="fa fa-scroll"></i><span>Laporan</span></a>
                </li>
            <?php endif ?>

            <?php if (isset($informasi) && $informasi) : ?>
                <li class="menu-header">Informasi</li>
                <li class="<?= makeActiveSidebar3('informasi') ?>">
                    <a class="nav-link" href="<?= base_url($url . '/informasi') ?>"><i class="fa fa-list"></i><span>Daftar Informasi</span></a>
                </li>
                <?php if (in_array('admin', user()->getRoles()) || in_array('petugas', user()->getRoles())) : ?>
                    <li class="<?= makeActiveSidebar3('informasi/add') ?>">
                        <a class="nav-link" href="<?= base_url($url . '/informasi/add') ?>"><i class="fa fa-plus"></i><span>Tambah Informasi</span></a>
                    </li>
                <?php endif ?>
            <?php endif ?>

            <li class="menu-header">Pengguna</li>
            <?php if (in_array('admin', $roleLogin) || in_array('petugas', $roleLogin)) : ?>
                <li class="<?= makeActiveSidebar('user') ?>">
                    <a class="nav-link" href="<?= base_url($url . '/user') ?>"><i class="fas fa-users"></i> <span>User</span></a>
                </li>
            <?php endif ?>
            <li class="<?= makeActiveSidebar('profile') ?>">
                <a class="nav-link" href="<?= base_url($url . '/profile') ?>"><i class="fas fa-user-edit"></i> <span>Profile</span></a>
            </li>
        </ul>

        <div class="mt-5 mb-4 p-3 hide-sidebar-mini">
            <a href="/logout" class="btn btn-danger shadow btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
        </div>
    </aside>
</div>