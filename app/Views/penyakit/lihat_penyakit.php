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
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid" style="width: 100%" src="<?= base_url('img/' . $data['img']); ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><strong><?= $data['nama']; ?></strong></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#deskripsi" data-toggle="tab">Deskripsi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#perawatan" data-toggle="tab">Perawatan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#gejala" data-toggle="tab">Gejala</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="gejala">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($gejala as $dt) : ?>
                                                <tr>
                                                    <td style="width: 2%;"><?= $i++ . '.'; ?></td>
                                                    <td><?= $dt['namaG']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="active tab-pane" id="deskripsi">
                                    <p style="text-align: justify; line-height: 2;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $data['deskripsi']; ?>
                                    </p>
                                </div>
                                <div class="tab-pane" id="perawatan">
                                    <p style="text-align: justify; line-height: 2;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $data['perawatan']; ?>
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