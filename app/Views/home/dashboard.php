<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <?php if (in_groups('admin')) : ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $bgColors = ['info', 'success', 'warning', 'danger', 'primary', 'secondary', 'light', 'purple', 'teal', 'indigo', 'pink', 'cyan', 'yellow', 'orange'];
                    $colorIndex = 0;
                    ?>
                    <?php foreach ($menu as $m) : ?>
                        <?php if ($m['name'] != 'Dashboard') : ?>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-<?= $bgColors[$colorIndex]; ?>">
                                    <div class="inner">
                                        <h3><?= $jumlahData[$m['name']]; ?></h3>
                                        <p><?= $m['name']; ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion <?= $m['icon']; ?>"></i>
                                    </div>
                                    <a href="<?= base_url($m['url']); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <?php
                            $colorIndex = ($colorIndex + 1) % count($bgColors);
                            ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (in_groups('pasien')) : ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Diagnosa</h3>
                            </div>
                            <form action="<?= base_url('simpan_diagnosa'); ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="card-body col-md-8">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="">Nama Pasien</label>
                                            <input type="text" class="form-control" name="" value="<?= user()->name; ?>" readonly>
                                            <input type="hidden" class="form-control" name="pasien_id" value="<?= user()->id; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
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
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>