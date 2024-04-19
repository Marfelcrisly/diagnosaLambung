<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></h1>
                </div>
            </div>
            <?php if ($pesan = session()->getFlashdata('pesan')) : ?>
                <script type="text/javascript">
                    var pesan = <?= is_array($pesan) ? json_encode($pesan) : (is_null($pesan) ? '""' : "'" . addslashes($pesan) . "'") ?>;
                    alert(pesan);
                </script>
            <?php endif; ?>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <?php foreach ($menu as $m) : ?>
                                            <th><?= $m['name']; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($roles as $role) : ?>
                                        <tr>
                                            <td><?= $role['name']; ?></td>
                                            <?php foreach ($menu as $m) : ?>
                                                <td style="text-align: center;">
                                                    <form id="form<?= $role['id'] ?><?= $m['id'] ?>" action="<?= base_url('aksi_simpan_status'); ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <div class="form-check">
                                                            <?php
                                                            $checked = '';
                                                            foreach ($statusMenus[$role['name']] as $statusMenu) {
                                                                if ($statusMenu['menu_name'] == $m['name']) {
                                                                    $checked = 'checked';
                                                                    break;
                                                                }

                                                                if (in_groups('admin') && $m['name'] == 'Data Akses Menu') {
                                                                    $checked = 'disabled';
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                            <input type="hidden" name="roleId" value="<?= $role['id'] ?>">
                                                            <input type="hidden" name="menuId" value="<?= $m['id'] ?>">
                                                            <input type="checkbox" name="status" class="form-check-input active-switch" <?= $checked; ?>>
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </form>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table> -->
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <?php foreach ($roles as $role) : ?>
                                            <th style="text-align: center;"><?= $role['description']; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <td><?= $m['name']; ?></td>
                                            <?php foreach ($roles as $role) : ?>
                                                <td style="text-align: center;">
                                                    <form id="form<?= $role['id'] ?><?= $m['id'] ?>" action="<?= base_url('aksi_simpan_status'); ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <div class="form-check">
                                                            <?php
                                                            $checked = '';
                                                            foreach ($statusMenus[$role['name']] as $statusMenu) {
                                                                if ($statusMenu['menu_name'] == $m['name']) {
                                                                    $checked = 'checked';
                                                                    break;
                                                                }

                                                                if (in_groups('admin') && $m['name'] == 'Data Akses Menu') {
                                                                    $checked = 'disabled';
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                            <input type="hidden" name="roleId" value="<?= $role['id'] ?>">
                                                            <input type="hidden" name="menuId" value="<?= $m['id'] ?>">
                                                            <input type="checkbox" name="status" class="form-check-input active-switch" <?= $checked; ?>>
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </form>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.querySelectorAll('.active-switch').forEach(activeSwitch => {
        activeSwitch.addEventListener('change', function() {
            const formId = 'form' + this.closest('form').querySelector('[name="roleId"]').value + this.closest('form').querySelector('[name="menuId"]').value;
            const form = document.getElementById(formId);
            this.value = this.checked ? '1' : '0';
            if (form) {
                form.submit();
            }
        });
    });
</script>

<?= $this->endSection(); ?>