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
                            <h3 class="card-title">Data Diagnosa</h3>
                        </div>
                        <form action="<?= base_url('simpan_diagnosa'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="">Nama Pasien</label>
                                        <select name="pasien_id" class="form-control custom-select <?php if (session('errors.pasien_id')) : ?>is-invalid<?php endif  ?>">
                                            <option selected disabled>--Pilih--</option>
                                            <?php foreach ($namaPasien as $nama) : ?>
                                                <option value="<?= $nama['id']; ?>" <?= (old('pasien_id') == $nama['id']) ? 'selected' : ''; ?>><?= $nama['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= session('errors.pasien_id') ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Tanggal</label>
                                        <input type="text" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Pertanyaan ?</th>
                                                <th>Kode Gejala</th>
                                                <th style="text-align: center;">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="checkAll" class="form-check-input">
                                                        <label for="checkAll" class="form-check-label">Jawab</label>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($namaGejala as $gejala) : ?>
                                                <tr>
                                                    <td><?= $gejala['nama']; ?></td>
                                                    <td><?= $gejala['kode']; ?></td>
                                                    <td style="text-align: center;">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="diagnosa[]" class="form-check-input <?php if (session('errors.diagnosa')) : ?>is-invalid<?php endif  ?>" value="<?= $gejala['id']; ?>">
                                                            <br>
                                                            <div class="invalid-feedback">
                                                                <?= session('errors.diagnosa') ?>
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