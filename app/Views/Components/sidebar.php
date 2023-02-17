<div class="main-sidebar">
    <?php $role = user()->getRoles(); ?>
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('/admin') ?>">Aduan Kepolision</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?= makeActiveSidebar('home') ?>"><a class="nav-link" href="<?= base_url('admin/home') ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Data</li>
            <li class="<?= makeActiveSidebar3('aduan') ?>"><a class="nav-link" href="<?= base_url('admin/aduan') ?>"><i class="fa fa-info"></i><span>Daftar Aduan</span></a></li>
            <?php if (end($role) == 'petugas' && isset($tambah_aduan) && $tambah_aduan) : ?>
                <li class="<?= makeActiveSidebar3('add') ?>"><a class="nav-link" href="<?= base_url('admin/aduan/add') ?>"><i class="fa fa-plus"></i><span>Tambah Aduan</span></a></li>
            <?php endif ?>
            <li class="menu-header">Pengguna</li>
            <li class="<?= makeActiveSidebar('user') ?>"><a class="nav-link" href="<?= base_url('admin/user') ?>"><i class="fas fa-users"></i> <span>User</span></a></li>
            <li class="<?= makeActiveSidebar('profile') ?>"><a class="nav-link" href="<?= base_url('admin/profile') ?>"><i class="fas fa-user-edit"></i> <span>Profile</span></a></li>
        </ul>

        <!-- <div class="mt-5 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-<?= userColor() ?> btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->
    </aside>
</div>