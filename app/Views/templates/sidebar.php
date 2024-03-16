<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= user()->username ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= base_url('daftar_users')?> " class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Management Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('daftar_pasien')?> " class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Management Pasien
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>