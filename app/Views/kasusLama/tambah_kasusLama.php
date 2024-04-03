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
                            <h3 class="card-title">Data Kasus Lama</h3>
                        </div>
                        <form action="<?= base_url('simpan_kasusLama'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="">Penyakit</label>
                                        <select name="penyakit_id" class="form-control custom-select <?php if (session('errors.penyakit_id')) : ?>is-invalid<?php endif  ?>">
                                            <option selected disabled>--Pilih--</option>
                                            <?php foreach ($penyakit as $pyk) : ?>
                                                <option value="<?= $pyk['id']; ?>" <?= (old('penyakit_id') == $pyk['id']) ? 'selected' : ''; ?>><?= $pyk['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= session('errors.penyakit_id') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Gejala</th>
                                                <th style="text-align: center;">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="checkAll" class="form-check-input" name="checkAll" <?= (old('checkAll')) ? 'checked' : ''; ?>>
                                                        <label for="checkAll" class="form-check-label">Pilih</label>
                                                    </div>
                                                </th>

                                                <th style="text-align: center;">Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($namaGejala as $gejala) : ?>
                                                <tr>
                                                    <td><?= $gejala['nama']; ?></td>
                                                    <td style="text-align: center;">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="diagnosa[]" id="diagnosa<?= $gejala['id']; ?>" class="form-check-input <?php if (session('errors.diagnosa')) : ?>is-invalid<?php endif  ?>" value="<?= $gejala['id']; ?>" <?= is_array(old('diagnosa')) && in_array($gejala['id'], old('diagnosa')) ? 'checked' : ''; ?>>
                                                            <br>
                                                            <div class="invalid-feedback">
                                                                <?= session('errors.diagnosa') ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group row justify-content-md-center">
                                                            <div class="col-md-8">
                                                                <select name="bobot[]" class="form-control custom-select <?php if (session('errors.bobot')) : ?>is-invalid<?php endif; ?>">
                                                                    <option selected disabled>Pilih</option>
                                                                    <?php foreach ($bobot as $b) : ?>
                                                                        <option value="<?= $b['id']; ?>"><?= $b['nilai']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.bobot') ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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