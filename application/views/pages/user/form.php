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
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Form Izin Keluar/Masuk Kantor</h1>
                            </div>
                            <form class="myForm">
                                <div class="form-group">
                                    <label class="label">Nama Karyawan :</label>
                                    <input type="text" class="form-control form-control-user" placeholder="Masukkan nama karyawan" required>
                                </div>

                                <div class="form-group">
                                    <label class="label">Kegiatan :</label>
                                    <input type="text" class="form-control form-control-user" placeholder="Masukkan nama kegiatan" required>
                                </div>

                                <div class="form-group">
                                    <label class="label">Tanggal :</label>
                                    <input type="date" class="form-control form-control-user" placeholder="Masukkan tanggal" required>
                                </div>

                                <div class="form-group">
                                    <label class="label">Jam Keluar :</label>
                                    <input type="time" class="form-control form-control-user" placeholder="Masukkan jam keluar" required>
                                </div>

                                <div class="form-group">
                                    <label class="label">Jam Kembali :</label>
                                    <input type="time" class="form-control form-control-user" placeholder="Masukkan jam kembali" required>
                                </div>

                                <div class="form-group">
                                    <label class="label">Lokasi :</label>
                                    <input type="text" name="latitude" value="" class="form-control form-control-user">
                                </div>

                                <div class="form-group">
                                    <label class="label">Foto :</label>
                                    <input type="file" class="form-control-image">
                                </div>
                                <hr>
                                <button type="submit" name="submit" href="index.html" class="btn btn-primary btn-user btn-block">
                                    Submit
                                </button>
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

            document.querySelector('.myForm input[name="latitude"]').value = combined;
        }


        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("You Must Allow The Request For Geolocation To Fill Out The Form");
                    location.reload();
                    break;
            }
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Toggle Password Visibility -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
            // Toggle the type attribute using
            // getAttribure() method
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the eye and bi-eye icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>