
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">   
        <h6 class="m-0 font-weight-bold text-primary">DataTables Activity</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Data</button>
            </div> 
        </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('message')): ?>
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
                                <td>id</td>
                                <td>id_user</td>
                                <td>Kegiatan</td>
                                <td>Tanggal</td>
                                <td>Waktu</td>
                                <td>Jam Kembali</td>    
                                <td>Lokasi</td>
                                <td>File</td>
                                <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($activity as $activity) : ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $activity['id'] ?></td>
                                        <td><?php echo $activity['id_user'] ?></td>
                                        <td><?php echo $activity['nama_kegiatan'] ?></td>
                                        <td><?php echo $activity['tanggal'] ?></td>
                                        <td><?php echo $activity['waktu'] ?></td>
                                        <td><?php echo $activity['jam_kembali'] ?></td>
                                        <td><?php echo $activity['latlong'] ?></td>
                                        <td>
                                            <img src="<?= base_url('../../uploads/' . $activity['foto']) ?>" alt="" width="200" height="200">
                                            <img src="<?= base_url('../../uploads/kegiatan_Hendra_20240624_100904.jpg') ?>" alt="" width="200" height="200">
                                            <?php echo $activity['foto'] ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit" onclick="populateEditModal('<?php echo $activity['id'] ?>', '<?php echo $activity['nama_kegiatan'] ?>', '<?php echo $activity['jam_kembali'] ?>', '<?php echo $activity['latlong'] ?>', '<?php echo $activity['foto'] ?>')">Edit</button>
                                            <a href="<?php echo site_url('activity/deleteActivity/' . $activity['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</a>
                                        </td>
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
                <form id="addDataForm" method="post" action="<?php echo site_url('/activity/addActivity'); ?>" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" required>
                    </div> -->
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <input type="time" class="form-control" id="waktu" name="waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_kembali">Jam Kembali</label>
                        <input type="time" class="form-control" id="jam_kembali" name="jam_kembali" required>
                    </div>
                    <div class="form-group">
                        <label for="latlong">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit Aktivitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editDataForm" method="post" action="<?php echo site_url('activity/editActivity/'); ?>" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="edit_nama_kegiatan" name="nama_kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_jam_kembali">Jam Kembali</label>
                        <input type="time" class="form-control" id="edit_jam_kembali" name="jam_kembali" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_lokasi">Lokasi</label>
                        <input type="text" class="form-control" id="edit_lokasi" name="latlong" required> <!-- Ensure the name is 'latlong' -->
                    </div>
                    <div class="form-group">
                        <label for="edit_file">File</label>
                        <input type="file" class="form-control" id="edit_file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function populateEditModal(id, nama_kegiatan, jam_kembali, lokasi, foto) {
    document.querySelector('#editDataForm').action = "<?php echo site_url('activity/editActivity/'); ?>" + id;
    document.querySelector('#edit_id').value = id;
    document.querySelector('#edit_nama_kegiatan').value = nama_kegiatan;
    document.querySelector('#edit_jam_kembali').value = jam_kembali;
    document.querySelector('#edit_lokasi').value = lokasi; // Ensure the field ID matches
    // handle file input if needed
}
</script>

