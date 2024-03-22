<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <?= $this->include('templates/navbar'); ?>

        <?= $this->include('templates/sidebar'); ?>

        <?= $this->renderSection('page-content'); ?>

        <?= $this->include('templates/footer'); ?>


    </div>

    <script src="<?= base_url(); ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="<?= base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>plugins/chart.js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>plugins/sparklines/sparkline.js"></script>
    <script src="<?= base_url(); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url(); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="<?= base_url(); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="<?= base_url(); ?>plugins/moment/moment.min.js"></script>
    <script src="<?= base_url(); ?>plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url(); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?= base_url(); ?>plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?= base_url(); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?= base_url(); ?>dist/js/adminlte.js"></script>
    <script src="<?= base_url(); ?>dist/js/demo.js"></script>
    <script src="<?= base_url(); ?>dist/js/pages/dashboard.js"></script>
</body>

</html>