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
                $modelMenu = new \App\Models\ModelMenu();
                $query = $modelMenu->getMenu()->findAll();
                ?>

                <?php foreach ($query as $data) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($data['url']) ?> " class="nav-link <?= ($data['name'] === $title) ? 'active' : ''; ?>">
                            <i class="nav-icon <?= $data['icon']; ?>"></i>
                            <p>
                                <?= $data['name']; ?>
                            </p>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </nav>
    </div>
</aside>