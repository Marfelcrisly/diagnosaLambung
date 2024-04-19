<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
    <!-- <script src="<?= base_url(); ?>dist/js/demo.js"></script> -->
    <script src="<?= base_url(); ?>dist/js/pages/dashboard.js"></script>

    <script>
        function previewImg() {
            const image = document.querySelector('#img');
            const label = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('#img-preview');

            label.textContent = image.files[0].name;

            const fileImage = new FileReader();
            fileImage.readAsDataURL(image.files[0]);

            fileImage.onload = function(e) {
                imgPreview.src = e.target.result;
                // imgPreview.style.display = 'block';
            }
        }
    </script>

    <script>
        document.getElementById('checkAll').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('input[id^="diagnosa"]');
            checkboxes.forEach(function(checkbox, index) {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>

    <script>
        document.getElementById('controllerSelect').addEventListener('change', function() {
            const selectedValue = this.value;
            let baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            let searchParams = new URLSearchParams(window.location.search);
            searchParams.set('page', selectedValue);
            let newQueryString = searchParams.toString();

            window.location.href = baseUrl + '?' + newQueryString;
        });
    </script>

</body>

</html>