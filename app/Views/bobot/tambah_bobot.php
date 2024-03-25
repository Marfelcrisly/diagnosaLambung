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
                            <h3 class="card-title">Data Bobot</h3>
                        </div>
                        <form action="<?= base_url('simpan_bobot'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Parameter</label>
                                    <input type="text" class="form-control <?php if (session('errors.parameter')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Nama Menu" name="parameter" value="<?= old('parameter'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.parameter') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nilai</label>
                                    <input type="number" class="form-control <?php if (session('errors.nilai')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Nilai" name="nilai" value="<?= old('nilai'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.nilai') ?>
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