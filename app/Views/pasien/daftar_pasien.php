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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: auto; max-width: 10px; text-align: center;">No.</th>
                                        <th>No. RM</th>
                                        <th>Username</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th style="width: auto; max-width: 10px; text-align: center;">Umur</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($data as $dt) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $i++ . '.'; ?></td>
                                            <td><?= $dt['no_rm']; ?></td>
                                            <td><?= $dt['username'] ?></td>
                                            <td><?= $dt['name']; ?></td>
                                            <td><?= $dt['jk']; ?></td>
                                            <td style="text-align: center;"><?= $dt['umur']; ?></td>
                                            <td style="text-align: center;">
                                                <a type="button" href="<?= base_url('edit_pasien/' . $dt['id']) ?>" class="btn btn-block btn-outline-warning btn-sm d-inline" style="width: auto; max-width: 100;"><span><i class="fas fa-edit"></i> </span></a>
                                                <form action="<?= base_url('hapus_pasien/' . $dt['id']); ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-block btn-outline-danger btn-sm d-inline ml-2" onclick="return confirm('apakah anda yakin')" style="width: auto; max-width: 100;"><span><i class="fas fa-trash-alt"></i> </span></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<?= $this->endSection(); ?>