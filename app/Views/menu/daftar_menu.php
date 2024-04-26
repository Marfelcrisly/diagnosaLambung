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
                        <form action="" method="post">
                            <div class="card-header" style="display: flex; align-items: center;">
                                <div class="select-group" style="margin-left: 2px;">
                                    <select id="controllerSelect" class="form-control form-control-sm input-outline-info" name="page">
                                        <option value="10" <?= (old('page', $page) == '10') ? 'selected disabled' : ''; ?>>10</option>
                                        <option value="25" <?= (old('page', $page) == '25') ? 'selected disabled' : ''; ?>>25</option>
                                        <option value="50" <?= (old('page', $page) == '50') ? 'selected disabled' : ''; ?>>50</option>
                                        <option value="100" <?= (old('page', $page) == '100') ? 'selected disabled' : ''; ?>>100</option>
                                    </select>
                                </div>
                                <a href="<?= base_url('tambah_menu') ?>" class="btn btn-outline-primary btn-sm d-inline mr-2 ml-2" style="width: auto; max-width: 50px;"><span><i class="fas fa-plus"></i> </span></a>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Keyword pencarian.." name="keyword" value="<?= old('keyword', $keyword); ?>">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Url</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 + ($page * ($currentPage - 1)); ?>
                                    <?php foreach ($data as $dt) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $dt['name'] ?></td>
                                            <td><?= $dt['url'] ?></td>
                                            <td><?= $dt['icon'] ?></td>
                                            <td>
                                                <form id="form<?= $dt['id']; ?>" action="<?= base_url('aksi_simpan_status/' . $dt['id']); ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="status" class="form-check-input active-switch" id="statusSwitch<?= $dt['id']; ?>" data-id="<?= $dt['id']; ?>" <?= ($dt['status'] == '1') ? 'checked' : ''; ?> <?= ($dt['name'] === 'Manajemen Menu' || $dt['name'] === 'Dashboard') ? 'disabled' : ''; ?>>
                                                        <label class="form-check-label" for="statusSwitch<?= $dt['id']; ?>"></label>
                                                    </div>
                                                </form>
                                            </td>
                                            <td style="text-align: center;">
                                                <a type="button" href="<?= base_url('edit_menu/' . $dt['id']); ?>" class="btn btn-block btn-outline-warning btn-sm d-inline" style="width: auto; max-width: 100;"><span><i class="fas fa-edit"></i> </span></a>
                                                <?php if ($dt['name'] !== 'Manajemen Menu') : ?>
                                                    <form action="<?= base_url('hapus_menu/' . $dt['id']); ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-block btn-outline-danger btn-sm d-inline ml-2" onclick="return confirm('apakah anda yakin')" style="width: auto; max-width: 100;"><span><i class="fas fa-trash-alt"></i> </span></button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="text-center d-flex justify-content-center mt-2">
                                <?= $pager->links('menu', 'paginations') ?>
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
            const formId = `form${this.getAttribute('data-id')}`;
            const form = document.getElementById(formId);
            this.value = this.checked ? '1' : '0';
            if (form) {
                form.submit();
            }
        });
    });
</script>

<?= $this->endSection(); ?>