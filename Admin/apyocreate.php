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
          <h1 class="text-info">APyo KanTeen Create Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">APyo KanTeen</li>
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
              <a href="apyokanteen.php" class="btn btn-secondary">&leftarrow; Back</a>
            </div>
            <?php
            if (isset($_POST['send_data'])) {
              $files = 'images/'.($_FILES['menu_image']['name']);
              $menu_image = $_FILES['menu_image']['name'];
              move_uploaded_file($_FILES['menu_image']['tmp_name'], $files);

              $menu_name = $_POST['menu_name'];
              $menu_content = $_POST['menu_content'];
              $menu_price = $_POST['menu_price'];
              $sql = "INSERT INTO tblapyokanteen (menu_name, menu_img, menu_content, menu_price) VALUES (?, ?, ?, ?)";

              if ($stmt = $database->prepare($sql)) {
                $stmt->bindParam(1, $menu_name);
                $stmt->bindParam(2, $menu_image);
                $stmt->bindParam(3, $menu_content);
                $stmt->bindParam(4, $menu_price);
              }
              $stmt->execute();
              echo "<script>window.location.href='apyokanteen.php'</script>";
            }
            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="apyocreate.php" class="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <span>Menu Name :</span>
                  <input type="text" class="form-control" placeholder="Enter menu name " name="menu_name"  autocomplete="off">
                </div>
                <div class="form-group">
                  <span>Menu Image :</span>
                  <input type="file" class="form-control" name="menu_image">
                </div>
                <div class="form-group">
                  <span>Menu Content :</span>
                  <textarea name="menu_content" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <span>Menu Price :</span>
                  <input type="text" class="form-control" placeholder="Enter menu price" name="menu_price"  autocomplete="off">
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
