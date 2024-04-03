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
            <?php if ($pesan = session()->getFlashdata('pesan')) : ?>
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
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Gejala</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead style="background: red; color: white">
                                            <tr>
                                                <th style="text-align: center; width: 5%;">No.</th>
                                                <th>Kode</th>
                                                <th>Gejala</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($gejala as $dt) : ?>
                                                <tr>
                                                    <td style="text-align: center;"><?= $i++ ?></td>
                                                    <td><?= $dt['kode'] ?></td>
                                                    <td><?= $dt['nama'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Diagnosa Penyakit / Similarity</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 style="color: blueviolet;"><?= $data['nama'] . '/' . number_format($data['persenan'], 2) . '%'; ?></h1>
                                </div>
                                <div class="col-md-6">
                                    <img class="profile-user-img img-fluid" style="width: 100%" src="<?= base_url('img/' . $data['img']); ?>" alt="User profile picture">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Detail Penyakit</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="text-align: justify; line-height: 2;">
                                        <?= $data['deskripsi']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Saran Pengobatan</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="text-align: justify; line-height: 2;">
                                        <?= $data['perawatan']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>