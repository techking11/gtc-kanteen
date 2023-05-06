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
          <h1 class="text-info">Edit Team Member</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Team</li>
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
            <div class="card-header">
              <a href="team.php" class="btn btn-secondary">&leftarrow; Back</a>
            </div>

            <?php
            if ($_POST) {
              $id = $_POST['id'];
              $name = $_POST['name'];
              $phoneno = $_POST['phoneno'];
              $email = $_POST['email'];

              $sql = "UPDATE tblteamdata SET name='$name', phone_no='$phoneno', email='$email' WHERE id ='$id'";
              $stmt = $database->prepare($sql);
              $stmt->execute();
              echo "<script>window.location.href='team.php'</script>";
            }
            $sql = "SELECT * FROM tblteamdata WHERE id =".$_GET['id'];
            $stmt = $database->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" class="form" method="post">
                <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
                <div class="form-group">
                  <span>Name :</span>
                  <input type="text" class="form-control" placeholder="John Naing" name="name" value="<?php echo $row[0]['name']; ?>">
                </div>
                <div class="form-group">
                  <span>Phone No :</span>
                  <input type="number" class="form-control" placeholder="9894568228" name="phoneno" value="<?php echo $row[0]['phone_no']; ?>">
                </div>
                <div class="form-group">
                  <span>Email :</span>
                  <input type="email" class="form-control" placeholder="someone@gmail.com" name="email" value="<?php echo $row[0]['email']; ?>">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="update_data" value="Edit data">
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
