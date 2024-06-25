<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/user/'); ?>style.css">
</head>

<body>


    <div class="container margin">
        <div class="container mt-5">
            <h2>History Pengisian Form</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal Waktu</th>
                        <th>Nama Kegiatan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-06-25 10:00</td>
                        <td>Meeting Project A</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal1">Lihat Detail</button></td>
                    </tr>
                    <tr>
                        <td>2024-06-25 10:00</td>
                        <td>Meeting Project A</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal1">Lihat Detail</button></td>
                    </tr>
                    <!-- Repeat for more history entries -->
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailModal1" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel1">Detail Pengisian Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama Karyawan:</strong> John Doe</p>
                        <p><strong>Nama Kegiatan:</strong> Meeting Project A</p>
                        <p><strong>Tanggal:</strong> 2024-06-25</p>
                        <p><strong>Jam Keluar:</strong> 10:00</p>
                        <p><strong>Jam Kembali:</strong> 12:00</p>
                        <p><strong>Lokasi:</strong> Kantor Pusat</p>
                        <p><strong>Foto Bukti:</strong></p>
                        <img src="bukti.jpg" class="img-fluid" alt="Foto Bukti">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mb-0">
        <div class="container">
            <p>&copy; 2024 BPS Kota Semarang. All rights reserved.</p>
        </div>
    </footer>
    <!-- Footer -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>