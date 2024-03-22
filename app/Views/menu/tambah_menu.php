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
                            <h3 class="card-title">Data Menu</h3>
                        </div>
                        <form action="<?= base_url('simpan_menu'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Nama Menu" name="name" value="<?= old('name'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.name') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Url</label>
                                    <input type="text" class="form-control <?php if (session('errors.url')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Url" name="url" value="<?= old('url'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.url') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Icon</label>
                                    <input type="text" class="form-control <?php if (session('errors.icon')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Icon" name="icon" value="<?= old('icon'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.icon') ?>
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