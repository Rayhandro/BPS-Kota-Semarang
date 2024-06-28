<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="style.css">
    <link href="<?php echo base_url('assets/template/user/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .field-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .position-relative .form-control {
            padding-right: 2.5rem;
        }
    </style>
</head>

<body class="bg-gradient-primary" onload="getLocation();">

    <div class="container">


        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="col-lg-7 mx-auto">
                        <!-- card -->
                        <div class="py-5 px-2">
                            <?php if ($this->session->flashdata('message')) : ?>
                                <div class="alert alert-<?= $this->session->flashdata('message_type') ?> alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('message') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Form Izin Keluar/Masuk Kantor</h1>
                            </div>
                            <form class="myForm" method="post" enctype="multipart/form-data" action="<?php echo site_url('/activity/addActivity'); ?>">
                                <div class="form-group">
                                    <label class="label">Tipe Form :</label>
                                    <select id="tipe_form" name="tipe_form" class="form-control form-control-user" onchange="loadKegiatanOptions()">
                                        <option value="keluar">Keluar</option>
                                        <option value="pelaksanaan">Pelaksanaan</option>
                                        <option value="kembali">Kembali</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_user">Nama Pegawai</label>
                                    <input type="text" class="form-control" disabled id="id_user" name="nama" value="<?= $username; ?>" required>
                                    <input type="text" class="form-control" id="id_user" name="id_user" hidden value="<?= $user_id; ?>" required>
                                </div>
                                <div class="form-group" id="nama_kegiatan_group">
                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                    <input type="text" class="form-control" id="kegiatan_keluar" name="nama_kegiatan" required>
                                    <select class="form-control" id="kegiatan_pelaksanaan" disabled name="nama_kegiatan" required>
                                        <?php foreach ($pelaksanaan as $act) : ?>
                                            <option value="<?php echo $act['id_kegiatan'] ?>"><?= $act['nama_kegiatan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <select class="form-control" id="kegiatan_kembali" disabled name="nama_kegiatan" required>
                                        <?php foreach ($kembali as $act) : ?>
                                            <option value="<?php echo $act['id_kegiatan'] ?>"><?= $act['nama_kegiatan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="form-group" id="jam_keluar_group">
                                    <label for="waktu">Jam</label>
                                    <input type="time" class="form-control" id="waktu" name="jam">
                                </div>
                                <div class="form-group" id="latlong_group">
                                    <label for="latlong">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi">
                                </div>
                                <div class="form-group" id="foto_group">
                                    <label for="file">File</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            }
        }

        function showPosition(position) {
            // document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
            // document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
            let latitude = position.coords.latitude;
            let longitude = position.coords.longitude;
            let combined = latitude + "," + longitude;

            document.querySelector('.myForm input[name="lokasi"]').value = combined;
        }


        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("You Must Allow The Request For Geolocation To Fill Out The Form");
                    location.reload();
                    break;
            }
        }

        function toggleTimeInputs() {
            var tipeForm = document.getElementById("tipe_form").value;
            var latlongGroup = document.getElementById("latlong_group");
            var fotoGroup = document.getElementById("foto_group");
            var nama_kegiatan_group = document.getElementById("nama_kegiatan_group");

            latlongGroup.style.display = "none";
            fotoGroup.style.display = "none";

            if (tipeForm === "kembali") {
                latlongGroup.style.display = "none";
                fotoGroup.style.display = "none";
                document.getElementById("kegiatan_pelaksanaan").setAttribute("disabled", "disabled");
                document.getElementById("kegiatan_pelaksanaan").setAttribute("hidden", "hidden");
                document.getElementById("kegiatan_keluar").setAttribute("disabled", "disabled");
                document.getElementById("kegiatan_keluar").setAttribute("hidden", "hidden");
                document.getElementById("kegiatan_kembali").removeAttribute("disabled");
                document.getElementById("kegiatan_kembali").removeAttribute("hidden");
            } else if (tipeForm === "keluar") {
                latlongGroup.style.display = "none";
                fotoGroup.style.display = "none";
                document.getElementById("kegiatan_pelaksanaan").setAttribute("disabled", "disabled");
                document.getElementById("kegiatan_pelaksanaan").setAttribute("hidden", "hidden");
                document.getElementById("kegiatan_kembali").setAttribute("disabled", "disabled");
                document.getElementById("kegiatan_kembali").setAttribute("hidden", "hidden");
                document.getElementById("kegiatan_keluar").removeAttribute("disabled");
                document.getElementById("kegiatan_keluar").removeAttribute("hidden");

                // nama_kegiatan_group.innerHTML('<label for="nama_kegiatan">Nama Kegiatan</label><input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" required>');
            } else if (tipeForm === "pelaksanaan") {
                latlongGroup.style.display = "block";
                fotoGroup.style.display = "block";
                document.getElementById("kegiatan_kembali").setAttribute("disabled", "disabled");
                document.getElementById("kegiatan_kembali").setAttribute("hidden", "hidden");
                document.getElementById("kegiatan_keluar").setAttribute("disabled", "disabled");
                document.getElementById("kegiatan_keluar").setAttribute("hidden", "hidden");
                document.getElementById("file").setAttribute("required", "required");
                // document.getElementById("kegiatan_keluar").setAttribute("hidden", "hidden");
                document.getElementById("kegiatan_pelaksanaan").removeAttribute("disabled");
                document.getElementById("kegiatan_pelaksanaan").removeAttribute("hidden");
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleTimeInputs();
        });

        document.getElementById("tipe_form").addEventListener("change", function() {
            toggleTimeInputs();
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>