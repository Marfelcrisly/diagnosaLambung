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
                <div class="col-5">
                    <div class="card">
                        <div class="card-header" style="display: flex; align-items: center;">
                            <div class="select-group" style="margin-left: 2px;">
                                <select id="controllerSelect" class="form-control form-control-sm input-outline-info" name="page">
                                    <option value="10" <?= (old('page', $page) == '10') ? 'selected disabled' : ''; ?>>10</option>
                                    <option value="25" <?= (old('page', $page) == '25') ? 'selected disabled' : ''; ?>>25</option>
                                    <option value="50" <?= (old('page', $page) == '50') ? 'selected disabled' : ''; ?>>50</option>
                                    <option value="100" <?= (old('page', $page) == '100') ? 'selected disabled' : ''; ?>>100</option>
                                </select>
                            </div>
                            <a href="<?= base_url('tambah_relasi') ?>" class="btn btn-outline-primary btn-sm ml-2" style="width: auto; max-width: 100px;"><span><i class="fas fa-plus"></i> Tambah</span></a>
                            <a href="<?= base_url('hapus_semua_relasi') ?>" class="btn btn-outline-danger btn-sm ml-2" style="width: auto; max-width: 100px;" onclick="return confirm('apakah anda yakin menghapus semua data?')"><span><i class="fas fa-trash"></i> Hapus</span></a>
                        </div>

                        <div class="card-body">
                            <style>
                                .center {
                                    text-align: center;
                                }
                            </style>
                            <table id="example2" class="table table-bordered table-hover center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Penyakit</th>
                                        <th>Kode Gejala</th>
                                        <th>Bobot</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 + ($page * ($currentPage - 1)); ?>
                                    <?php foreach ($data as $dt) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $dt['kodeP'] ?></td>
                                            <td><?= $dt['kodeG'] ?></td>
                                            <td><?= $dt['nilai'] ?></td>
                                            <td style="text-align: center;">
                                                <a type="button" href="<?= base_url('edit_relasi/' . $dt['id']); ?>" class="btn btn-block btn-outline-warning btn-sm d-inline" style="width: auto; max-width: 100;"><span><i class="fas fa-edit"></i> </span></a>
                                                <form action="<?= base_url('hapus_relasi/' . $dt['id']); ?>" method="post" class="d-inline">
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
                                <?= $pager->links('relasi_gp', 'paginations') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

</div>

<script>
    document.getElementById('controllerSelect').addEventListener('change', function() {
        const selectedValue = this.value;
        let baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);
        searchParams.set('page', selectedValue);
        let newQueryString = searchParams.toString();

        window.location.href = baseUrl + '?' + newQueryString;
    });
</script>

<?= $this->endSection(); ?>