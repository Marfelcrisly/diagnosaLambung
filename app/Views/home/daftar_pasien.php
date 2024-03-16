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
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="<?= base_url('tambah_pasien') ?>" class="btn btn-block btn-outline-primary" style="width: auto; max-width: 100px;"><span><i class="fas fa-plus"></i> Tambah</span></a>
                            </div>
                            <div class="card-body" style="margin-top: -30px;">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. RM</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Umur</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($data as $dt) : ?>
                                            <tr>
                                                <td><?= $dt['no_rm'] ?></td>
                                                <td><?= $dt['nama'] ?></td>
                                                <td><?= $dt['jk'] ?></td>
                                                <td><?= $dt['umur'] ?></td>
                                                <td style="text-align: center;">
                                                    <a type="button" href="<?= base_url('edit_pasien/'. $dt['id']) ?>" class="btn btn-block btn-outline-warning d-inline" style="width: auto; max-width: 100;"><span><i class="fas fa-edit"></i> Edit</span></a>
                                                    <form action="<?= base_url('hapus_pasien/' . $dt['id']); ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-block btn-outline-danger d-inline" onclick="return confirm('apakah anda yakin')" style="width: auto; max-width: 100;"><span><i class="fas fa-trash-alt"></i> Hapus</span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No. RM</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Umur</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </section>
</div>

<?= $this->endSection(); ?>