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
                <div class="col-12">
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
                                <div class="input-group input-group-sm ml-2">
                                    <input type="text" class="form-control" placeholder="Keyword pencarian.." name="keyword" value="<?= old('keyword'); ?>">
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
                                        <th style="text-align: center;">No.</th>
                                        <th>No. RM</th>
                                        <th>Username</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th style="text-align: center;">Umur</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 + ($page * ($currentPage - 1)); ?>
                                    <?php foreach ($data as $dt) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $i++ . '.'; ?></td>
                                            <td><?= $dt['no_rm']; ?></td>
                                            <td><?= $dt['username'] ?></td>
                                            <td><?= $dt['name']; ?></td>
                                            <td><?= $dt['jk']; ?></td>
                                            <td style="text-align: center;"><?= $dt['umur']; ?></td>
                                            <td style="text-align: center;">
                                                <a type="button" href="<?= base_url('edit_pasien/' . $dt['id']) ?>" class="btn btn-block btn-outline-warning btn-sm d-inline" style="width: auto; max-width: 100;"><span><i class="fas fa-edit"></i> </span></a>
                                                <form action="<?= base_url('hapus_pasien/' . $dt['id']); ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-block btn-outline-danger btn-sm d-inline ml-2" onclick="return confirm('apakah anda yakin')" style="width: auto; max-width: 100;"><span><i class="fas fa-trash-alt"></i> </span></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="text-center d-flex justify-content-center mt-2">
                                <?= $pager->links('pasien', 'paginations') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<?= $this->endSection(); ?>