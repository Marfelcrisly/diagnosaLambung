<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #6de6ff;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa-solid fa-user-gear"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="<?= base_url('profile'); ?>" class="dropdown-item">
                    <i class="fa-solid fa-address-card mr-2"></i></i> Data Pribadi
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('logout'); ?>" class="dropdown-item" onclick="return confirm('apakah anda yakin keluar?')">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>