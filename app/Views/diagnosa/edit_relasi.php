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
            <?php if ($pesan = session()->getFlashdata('errors')) : ?>
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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Relasi</h3>
                        </div>
                        <form action="<?= base_url('perbarui_relasi/' . $data['id']); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Kode Penyakit</label>
                                    <select name="pyk_id" class="form-control custom-select <?php if (session('errors.pyk_id')) : ?>is-invalid<?php endif  ?>">
                                        <option selected disabled>--Pilih--</option>
                                        <?php foreach ($kodePenyakit as $kodeP) : ?>
                                            <option value="<?= $kodeP['id']; ?>" <?= (old('pyk_id', $data['pyk_id']) == $kodeP['id']) ? 'selected' : ''; ?>><?= $kodeP['kode'] . ' - ' . $kodeP['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= session('errors.pyk_id') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Gejala</label>
                                    <select name="gjl_id" class="form-control custom-select <?php if (session('errors.gjl_id')) : ?>is-invalid<?php endif  ?>">
                                        <option selected disabled>--Pilih--</option>
                                        <?php foreach ($kodeGejala as $kodeG) : ?>
                                            <option value="<?= $kodeG['id']; ?>" <?= (old('gjl_id', $data['gjl_id']) == $kodeG['id']) ? 'selected' : ''; ?>><?= $kodeG['kode'] . ' - ' . $kodeG['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= session('errors.gjl_id') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Bobot</label>
                                    <select name="bobot_id" class="form-control custom-select <?php if (session('errors.bobot_id')) : ?>is-invalid<?php endif  ?>">
                                        <option selected disabled>--Pilih--</option>
                                        <?php foreach ($nilaiBobot as $bobot) : ?>
                                            <option value="<?= $bobot['id']; ?>" <?= (old('bobot_id', $data['bobot_id']) == $bobot['id']) ? 'selected' : ''; ?>><?= $bobot['nilai'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= session('errors.bobot_id') ?>
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