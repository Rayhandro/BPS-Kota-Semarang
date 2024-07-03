<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Activity</h6>
            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Data</button> -->
        </div>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-<?= $this->session->flashdata('message_type') ?> alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('message') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td>no</td>
                        <td>Nama</td>
                        <td>Tipe Form</td>
                        <td>Kegiatan</td>
                        <td>Tanggal</td>
                        <td>Jam Keluar</td>
                        <td>Jam Pelaksanaan</td>
                        <td>Jam Kembali</td>
                        <td>Lokasi</td>
                        <td>File</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($activities as $activity) : ?>
                        <tr>
                            <!-- <?php
                                    if ($activity['tipe_form'] == 'keluar') {
                                    ?>

                                <td rowspan="<?= $activity['count']; ?>"><?php echo $no++; ?></td>
                                <?php
                                    }
                                ?> -->
                            <td><?php echo $no++; ?></td>
                            <!-- <td><?php echo $activity['id_kegiatan']; ?></td> -->
                            <td><?php echo $activity['username']['username']; ?></td>
                            <td><?php echo $activity['nama_kegiatan']['nama_kegiatan']; ?></td>
                            <td><?php echo $activity['tipe_form']; ?></td>
                            <td><?php echo $activity['tanggal']; ?></td>
                            <td><?php echo $activity['jam_keluar']; ?></td>
                            <td><?php echo $activity['jam_pelaksanaan']; ?></td>
                            <td><?php echo $activity['jam_kembali']; ?></td>
                            <td><?php echo $activity['latlong']; ?></td>
                            <td>
                                <?php if ($activity['foto']) : ?>
                                    <img src="<?php echo base_url('uploads/' . $activity['foto']); ?>" alt="Activity Photo" style="width:100px;height:auto;">
                                <?php endif; ?>
                            </td>


                            <td class="text-center">
                                <button class="btn btn-warning px-4" data-toggle="modal" data-target="#modal-edit<?= $activity['id_kegiatan']; ?>">Edit</button>
                                <a href="<?php echo site_url('activity/deleteActivity/' . $activity['id_kegiatan'] .'/' . $activity['id_keluar'] . '/' . $activity['id_pelaksanaan'] . '/' . $activity['id_kembali']); ?>" class="btn btn-danger px-3 mt-2" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</a>
                            </td>

                            <div class="modal fade" id="modal-latlong" tabindex="-1" role="dialog" aria-labelledby="modal-latlong" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDataModalLabel">Lokasi Pelaksanaan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <table> -->


                                            <p><strong>Lokasi:<iframe scrolling="no" style="width: 100%; height: 100%;" src="https://www.google.com/maps?q=<?php echo $activity["latlong"]; ?>&hl=es;z=14&output=embed"></iframe></p>

                                            <!-- </table> -->
                                            <!-- <iframe scrolling="no" style="width: 100%; height: 100%;" src="https://www.google.com/maps?q=<?php echo $activity["latlong"]; ?>&hl=es;z=14&output=embed"></iframe> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modal-edit<?= $activity['id_kegiatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDataModalLabel">Edit Aktivitas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editDataForm" method="post" action="<?php echo site_url('activity/editActivity/' . $activity['id_keluar'] . '/' . $activity['id_pelaksanaan'] . '/' . $activity['id_kembali']); ?>" enctype="multipart/form-data">

                                                <input type="hidden" id="edit_id" name="id">
                                                <input type="hidden" id="edit_id_kegiatan" name="id_kegiatan">
                                                <div class="form-group">
                                                    <label for="edit_nama_kegiatan">Nama Kegiatan</label>
                                                    <input type="text" class="form-control" id="edit_nama_kegiatan" value="<?= $activity['nama_kegiatan']['nama_kegiatan']; ?>" name="nama_kegiatan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_jam_kembali">Jam</label>
                                                    <input type="time" class="form-control" id="edit_jam_keluar" name="jam_keluar" value="<?= $activity['jam_keluar']; ?>">
                                                    <input type="time" class="form-control" id="id_keluar" hidden name="id_keluar" value="<?= $activity['id_keluar']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_jam_kembali">Jam</label>
                                                    <input type="time" class="form-control" id="edit_jam_pelaksanaan" name="jam_pelaksanaan" value="<?= $activity['jam_pelaksanaan']; ?>">
                                                    <input type="time" class="form-control" id="id_pelaksanaan" hidden name="id_pelaksanaan" value="<?= $activity['id_pelaksanaan']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_jam_kembali">Jam Kembali</label>
                                                    <input type="time" class="form-control" id="edit_jam_kembali" name="jam_kembali" value="<?= $activity['jam_kembali']; ?>">
                                                    <input type="time" class="form-control" id="id_kembali" hidden name="id_kembali" value="<?= $activity['id_kembali']; ?>">
                                                </div>
                                                <!-- <div class="form-group" id="latlong_group">
                                                <label for="edit_lokasi">Lokasi</label>
                                                <input type="text" class="form-control" id="edit_lokasi" name="latlong" required>
                                            </div> -->
                                                <!-- <div class="form-group" id="foto_group">
                                                <label for="edit_file">File</label>
                                                <input type="file" class="form-control" id="edit_file" name="file">
                                            </div> -->
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form content -->
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
                        <select class="form-control" name="id_user" required>
                            <?php foreach ($user as $user) : ?>
                                <option value="<?php echo $user['id'] ?>"><?= $user['nama_pegawai']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="text" class="form-control" disabled id="id_user" name="nama" value="<?= $username; ?>" required>
                        <input type="text" class="form-control" id="id_user" name="id_user" hidden value="<?= $user_id; ?>" required> -->
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
            </div>
        </div>
    </div>
</div>



<script>
    function populateEditModal(id_keluar, id_pelaksanaan, id_kembali) {
        document.querySelector('#editDataForm').action = "<?php echo site_url('activity/editActivity/'); ?>" + id_keluar + "/" + id_pelaksanaan + "/" + id_kembali;
    }

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