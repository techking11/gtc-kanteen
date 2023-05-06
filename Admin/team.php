<?php
session_start();
include './_action/header.php';
include './config/config.php';
if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
  echo "<script>window.location.href='login.php'</script>";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="text-info">Team Essential Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Team</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex">
              <a href="team_new.php" class="btn btn-success">New Member</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone No</th>
                  <th>Email</th>
                  <td></td>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $stmt = $database->prepare("SELECT * FROM tblteamdata ORDER BY id ASC");
                  $stmt->execute();
                  $result = $stmt->fetchAll();

                  if ($result) {
                    $i = 1;
                    foreach ($result as $value) {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td>+95<?php echo $value['phone_no']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="team_update.php?id= <?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="team_delete.php?id= <?php echo $value['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this member !'); ">Delete</a>
                          </div>
                        </td>
                      </tr>
                      <?php
                      $i++;
                    }
                  }
                  ?>
                </tbody>
                <?php
                $stmt = $database->prepare("SELECT count(*) as Total FROM tblteamdata");
                $stmt->execute();
                $res = $stmt->fetchAll();
                ?>
              </table>
              <p class="text-dark mt-3">Total : <?php print_r($res[0]['Total']); ?></p>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include './_action/footer.php'; ?>
