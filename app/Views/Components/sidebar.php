<div class="main-sidebar">
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
            <li class="dropdown <?= makeActiveSidebar2('aduan', 'add') ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-info"></i> <span>Aduan</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= makeActiveSidebar3('aduan') ?>"><a class="nav-link" href="<?= base_url('admin/aduan') ?>">Daftar Aduan</a></li>
                    <li class="<?= makeActiveSidebar3('add') ?>"><a class="nav-link" href="<?= base_url('admin/aduan/add') ?>">Tambah Aduan</a></li>
                </ul>
            </li>
            <li class="<?= makeActiveSidebar('user') ?>"><a class="nav-link" href="<?= base_url('admin/user') ?>"><i class="fas fa-users"></i> <span>User</span></a></li>
        </ul>

        <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->
    </aside>
</div>