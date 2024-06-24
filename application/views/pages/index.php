<!-- Begin Page Content -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Data</button>
        </div>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?> alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($user as $user) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['password']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit" onclick="populateEditModal('<?php echo $user['id']; ?>', '<?php echo $user['username']; ?>', '<?php echo $user['role']; ?>')">Edit</button>
                                <a href="<?php echo site_url('auth/deleteUser/' . $user['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add User -->
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
                <!-- Form tambah data user -->
                <form id="addDataForm" method="post" action="<?php echo site_url('auth/addUser'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" id="role" name="role" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form edit data user -->
                <form id="editDataForm" method="post" action="<?php echo site_url('auth/editUser/'); ?>" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_username">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_password">Password</label>
                        <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="edit_password_confirm">Password Confirmation</label>
                        <input type="password" class="form-control" id="edit_password_confirm" name="password_confirm">
                    </div>
                    <div class="form-group">
                        <label for="edit_role">Role</label>
                        <input type="text" class="form-control" id="edit_role" name="role" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function populateEditModal(id, username, role) {
    document.querySelector('#editDataForm').action = "<?php echo site_url('auth/editUser/'); ?>" + id;
    document.querySelector('#edit_id').value = id;
    document.querySelector('#edit_username').value = username;
    document.querySelector('#edit_role').value = role;
}
</script>
