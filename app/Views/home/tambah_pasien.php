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
                            <h3 class="card-title">Data Pasien</h3>
                        </div>
                        <form action="<?= base_url('simpan_pasien'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">No.RM</label>
                                    <input type="text" class="form-control <?php if (session('errors.no_rm')) : ?>is-invalid<?php endif ?>" id="" placeholder="" name="no_rm" value="<?= old('no_rm'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.no_rm') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control <?php if (session('errors.nama')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Nama Lengkap" name="nama" value="<?= old('nama'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.nama') ?>
                                    </div>
                                </div>
                                <div class="form-group form-check-inline">
                                    <label for="" class="form-check-label">Jenis Kelamin</label>
                                    <span>:</span>
                                    <input style="margin-left: 10px;" type="radio" class="form-check-input <?php if (session('errors.jk')) : ?>is-invalid<?php endif ?>" id="laki-laki" name="jk" value="Laki-Laki" <?= old('jk') == 'Laki-Laki' ? 'checked' : '' ?>>
                                    <label for="laki-laki" class="form-check-label">Laki-Laki</label>
                                    <input style="margin-left: 10px;" type="radio" class="form-check-input <?php if (session('errors.jk')) : ?>is-invalid<?php endif ?>" id="perempuan" name="jk" value="Perempuan" <?= old('jk') == 'Perempuan' ? 'checked' : '' ?>>
                                    <label for="perempuan" class="form-check-label">Perempuan</label>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control <?php if (session('errors.jk')) : ?>is-invalid<?php endif ?>">
                                    <div class="invalid-feedback" style="margin-top: -15px;">
                                        <?= session('errors.jk') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Umur</label>
                                    <input type="number" class="form-control <?php if (session('errors.umur')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Umur" name="umur" value="<?= old('umur'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.umur') ?>
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