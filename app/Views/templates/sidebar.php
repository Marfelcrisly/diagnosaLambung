<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <hr style="background-color: white;">
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

                <?php
                $modelAksesMenu = new \App\Models\ModelAksesMenu();
                $userRole = new \App\Models\ModelUsers();

                $role = $userRole->getUsersRole()->where('users.id', user()->id)->first()['role'];
                $query = $modelAksesMenu->getAksesMenu()->where('auth_groups.name', $role)->orderBy('namaMenu', 'asc')->findAll();
                ?>

                <?php foreach ($query as $data) : ?>
                    <?php if ($data['status'] == 1) : ?>
                        <li class="nav-item">
                            <a href="<?= base_url($data['url']) ?> " class="nav-link <?= ($data['namaMenu'] === $title) ? 'active' : ''; ?>">
                                <i class="nav-icon <?= $data['icon']; ?>"></i>
                                <p>
                                    <?= $data['namaMenu']; ?>
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>

            </ul>
        </nav>
    </div>
</aside>