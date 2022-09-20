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
            <li class="<?= makeActiveSidebar('aduan') ?>"><a class="nav-link" href="<?= base_url('admin/aduan') ?>"><i class="fas fa-info"></i> <span>Daftar Aduan</span></a></li>
            
            <li class="menu-header">Pengguna</li>
            <li class="<?= makeActiveSidebar('user') ?>"><a class="nav-link" href="<?= base_url('admin/user') ?>"><i class="fas fa-users"></i> <span>User</span></a></li>    
            
            <li class="menu-header">Setting</li>
            <li class="<?= makeActiveSidebar('settings') ?>"><a class="nav-link" href="<?= base_url('admin/settings') ?>"><i class="fas fa-cogs"></i> <span>Site Setting</span></a></li>    
        </ul>

        <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->
    </aside>
</div>