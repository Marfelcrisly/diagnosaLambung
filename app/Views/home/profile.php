<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="content-wrapper">
    <div class="content-header ml-4">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
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
    <section class="content ml-4">
        <div class="col-11 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
            <div class="card bg-secondary d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    <?= $data['name']; ?>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b><?= $data['username']; ?></b></h2>
                            <p class="text-sm text-light"><b>Role: </b> <span class="badge badge-<?= ($data['role'] === 'Admin') ? 'info' : 'warning'; ?>"><?= $data['role']; ?></span></p>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small text-light"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?= $data['email']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>

                    <form action="<?= base_url('perbarui_profile/' . $data['id']); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalLongTitle">Form Edit Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="" placeholder="" name="username" value="<?= $data['username']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter email Lengkap" name="email" value="<?= old('email', $data['email']); ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.email') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama Lengkap</label>
                                                <input type="text" class="form-control <?php if (session('errors.nama')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Nama Lengkap" name="nama" value="<?= old('nama', $data['name']); ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Password" name="password" value="<?= old('password'); ?>" autocomplete="off">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.password') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Repeat Password</label>
                                                <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="" placeholder="Enter Repeat Password" name="pass_confirm" value="<?= old('pass_confirm'); ?>" autocomplete="off">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.pass_confirm') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>

<?= $this->endSection(); ?>