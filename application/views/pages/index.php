                <!-- Begin Page Content -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
                 </div>
                <div class="card-body">
                    <div class="table-responsive">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <td>no</td>
                        <td>id</td>
                        <td>username</td>
                        <td>password</td>
                        <td>role</td>    
                        </tr>
                    </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($user as $user) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $user['id'] ?></td>
                            <td><?php echo $user['username'] ?></td>
                            <td><?php echo $user['password'] ?></td>
                            <td><?php echo $user['role'] ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
