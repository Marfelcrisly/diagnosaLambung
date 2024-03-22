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
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Penyakit</h3>
                        </div>
                        <form action="<?= base_url('simpan_penyakit'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" class="form-control <?php if (session('errors.kode')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Kode Gejala" name="kode" value="<?= old('kode'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.kode') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control <?php if (session('errors.nama')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Nama Gejala" name="nama" value="<?= old('nama'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.nama') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control <?php if (session('errors.deskripsi')) : ?>is-invalid<?php endif ?>" id="deskripsi" placeholder="Masukkan Deskripsi" name="deskripsi"><?= old('deskripsi'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= session('errors.deskripsi') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="perawatan">Perawatan</label>
                                    <textarea class="form-control <?php if (session('errors.perawatan')) : ?>is-invalid<?php endif ?>" id="perawatan" placeholder="Masukkan Perawatan" name="perawatan"><?= old('perawatan'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= session('errors.perawatan') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>