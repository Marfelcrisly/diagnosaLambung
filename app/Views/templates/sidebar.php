<aside class="main-sidebar  elevation-4" style="background-color: #6de6ff;">
    <div class="sidebar">
        <!-- <hr style="background-color: white;">    -->
        <div class="user-panel mt-2 pb-0 mb-0 d-flex">
            <div class="info col-md-12" style="text-align: center;">
                <a href="#" class="nav-link">
                    <h3><?= user()->username ?></h3>
                </a>
            </div>
        </div>
        <nav class="mt-0">
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