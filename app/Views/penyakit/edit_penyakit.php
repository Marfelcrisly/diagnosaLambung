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
                        <form action="<?= base_url('perbarui_penyakit/' . $data['id']); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="gambarLama" value="<?= $data['img']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" class="form-control <?php if (session('errors.kode')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Kode Gejala" name="kode" value="<?= old('kode', $data['kode']); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.kode') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control <?php if (session('errors.nama')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Nama Gejala" name="nama" value="<?= old('nama', $data['nama']); ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.nama') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control <?php if (session('errors.deskripsi')) : ?>is-invalid<?php endif ?>" id="deskripsi" placeholder="Masukkan Deskripsi" name="deskripsi"><?= old('deskripsi', $data['deskripsi']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= session('errors.deskripsi') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="perawatan">Perawatan</label>
                                    <textarea class="form-control <?php if (session('errors.perawatan')) : ?>is-invalid<?php endif ?>" id="perawatan" placeholder="Masukkan Perawatan" name="perawatan"><?= old('perawatan', $data['perawatan']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= session('errors.perawatan') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="img">Gambar</label><br>
                                    <img id="img-preview" src="<?= base_url('img/' . (old('img') ? old('img') : $data['img'])); ?>" alt="Preview Gambar" class="profile-user-img img-fluid mb-2" style="width: auto; max-width: 100px;">
                                    <div class="custom-file">
                                        <input type="file" id="img" name="img" class="custom-file-input <?php if (session('errors.img')) : ?>is-invalid<?php endif ?>" onchange="previewImg()">
                                        <label class="custom-file-label" for="img"><?= old('img') ? old('img') : $data['img']; ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.img'); ?>
                                        </div>
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