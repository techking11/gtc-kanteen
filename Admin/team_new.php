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
          <h1 class="text-info">Create New Team Member</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Team</li>
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
            if (isset($_POST['send_data'])) {
              $name = $_POST['name'];
              $phoneno = $_POST['phoneno'];
              $email = $_POST['email'];
              $sql = "INSERT INTO tblteamdata (name, phone_no, email) VALUES (?, ?, ?)";

              if ($stmt = $database->prepare($sql)) {
                $stmt->bindParam(1, $name);
                $stmt->bindParam(2, $phoneno);
                $stmt->bindParam(3, $email);
              }
              $stmt->execute();
              echo "<script>window.location.href='team.php'</script>";
            }
            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="team_new.php" class="form" method="post">
                <div class="form-group">
                  <span>Name :</span>
                  <input type="text" class="form-control" placeholder="John Naing" name="name"  autocomplete="off">
                </div>
                <div class="form-group">
                  <span>Phone No:</span>
                  <input type="number" class="form-control" placeholder="9678460117" name="phoneno">
                </div>
                <div class="form-group">
                  <span>Email :</span>
                  <input type="email" class="form-control" placeholder="someone@gmail.com" name="email" autocomplete="off">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="send_data">Send data</button>
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
