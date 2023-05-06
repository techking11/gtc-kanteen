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
          <h1 class="text-info">Bubble KanTeen Update Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Bubble KanTeen</li>
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
              <a href="bubblekanteen.php" class="btn btn-secondary">&leftarrow; Back</a>
            </div>

            <?php
            if ($_POST) {
              $id = $_POST['id'];
              $menu_name = $_POST['menu_name'];
              $menu_content = $_POST['menu_content'];
              $menu_price = $_POST['menu_price'];
              $menu_series = $_POST['menu_series'];

              if ($_FILES) {
                $files = 'images/'.($_FILES['menu_image']['name']);
                $menu_image = $_FILES['menu_image']['name'];
                move_uploaded_file($_FILES['menu_image']['tmp_name'], $files);

                $sql = "UPDATE tblbubblekanteen SET menu_name='$menu_name',menu_series='$menu_series', menu_img='$menu_image', menu_content='$menu_content', menu_price='$menu_price' WHERE id ='$id'";
                $stmt = $database->prepare($sql);
                $stmt->execute();
              }else {
                $sql = "UPDATE tblbubblekanteen SET menu_name='$menu_name', menu_series='$menu_series', menu_content='$menu_content', menu_price='$menu_price' WHERE id ='$id'";
                $stmt = $database->prepare($sql);
                $stmt->execute();
              }
              echo "<script>window.location.href='bubblekanteen.php'</script>";
            }
            $sql = "SELECT * FROM tblbubblekanteen WHERE id =".$_GET['id'];
            $stmt = $database->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            ?>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" class="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
                <div class="form-group">
                  <span>Menu Name :</span>
                  <input type="text" class="form-control" placeholder="Enter menu name " name="menu_name" value="<?php echo $row[0]['menu_name']; ?>"  autocomplete="off">
                </div>
                <div class="form-group">
                  <span>Menu Series :</span>
                  <input type="text" class="form-control" placeholder="Enter menu series " name="menu_series" value="<?php echo $row[0]['menu_series']; ?>"  autocomplete="off">
                </div>
                <div class="form-group">
                  <span>Menu Image :</span><br>
                  <img src="images/<?php echo $row[0]['menu_img']; ?>" alt="" width="150" height="auto" accept="image/*">
                  <input type="file" class="form-control" name="menu_image" accept="image/*">
                </div>
                <div class="form-group">
                  <span>Menu Content :</span>
                  <textarea name="menu_content" id="" cols="30" rows="5" class="form-control"><?php echo $row[0]['menu_content']; ?></textarea>
                </div>
                <div class="form-group">
                  <span>Menu Price :</span>
                  <input type="text" class="form-control" placeholder="Enter menu price" name="menu_price" value="<?php echo $row[0]['menu_price']; ?>"  autocomplete="off">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="update_data" value="Update data">
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
