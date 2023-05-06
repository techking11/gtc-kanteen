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
          <h1 class="text-info">ME KanTeen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">ME KanTeen</li>
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
              <a href="mecreate.php" class="btn btn-success">New Menu</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover mb-3">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Food</th>
                  <th>Image</th>
                  <th>Content</th>
                  <th>Price</th>
                  <th>DateTime</th>
                  <th>Rating</th>
                  <th>Order</th>
                  <td></td>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                  }else {
                    $pageno = 1;
                  }
                    $numOfres = 10;
                    $offset = ($pageno - 1) * $numOfres;
                  if (empty($_POST['search'])) {
                    $stmt = $database->prepare("SELECT * FROM tblmekanteen ORDER BY id DESC");
                    $stmt->execute();
                    $rawResult = $stmt->fetchAll();
                    $total_pages = ceil(count($rawResult) / $numOfres);

                    $stmt = $database->prepare("SELECT * FROM tblmekanteen ORDER BY id DESC LIMIT $offset, $numOfres");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                  }else {
                    $searchkey = $_POST['search'];
                    $stmt = $database->prepare("SELECT * FROM tblmekanteen WHERE menu_name LIKE '%$searchkey%' ORDER BY id DESC");
                    $stmt->execute();
                    $rawResult = $stmt->fetchAll();
                    $total_pages = ceil(count($rawResult) / $numOfres);

                    $stmt = $database->prepare("SELECT * FROM tblmekanteen WHERE menu_name LIKE '%$searchkey%' ORDER BY id DESC LIMIT $offset, $numOfres");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                  }

                  if ($result) {
                    $i = 1;
                    foreach ($result as $value) {
                      $content = substr($value['menu_content'], 0, 20);
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['menu_name']; ?></td>
                        <td><?php echo $value['menu_img']; ?></td>
                        <td><?php echo $content; ?></td>
                        <td><?php echo $value['menu_price']; ?></td>
                        <td><?php echo $value['menu_date']; ?></td>
                        <td><?php echo $value['menu_rating']; ?></td>
                        <td><?php echo $value['menu_order']; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="meview.php?id= <?php echo $value['id']; ?>" class="btn btn-secondary">View</a>
                            <a href="meupdate.php?id= <?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="medelete.php?id= <?php echo $value['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this item !'); ">Delete</a>
                          </div>
                        </td>
                      </tr>
                      <?php
                      $i++;
                    }
                  }
                  ?>
                </tbody>
              </table>
              <?php
              $stmt = $database->prepare("SELECT count(*) as Total FROM tblmekanteen");
              $stmt->execute();
              $res = $stmt->fetchAll();
              ?>
              <span class="text-dark">Total : <?php print_r($res[0]['Total']); ?></span>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <ul class="pagination mt-0 mb-0">
                <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                <li class="page-item <?php if($pageno <= 1) {echo 'disabled';} ?>">
                  <a class="page-link" href="<?php if($pageno <= 1) {echo '#';}else {echo "?pageno=".($pageno-1);} ?>">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                <li class="page-item <?php if ($pageno >= $total_pages) {echo 'disabled';} ?>">
                  <a class="page-link" href="<?php if ($pageno >= $total_pages) {echo '#';}else{echo "?pageno=".($pageno+1);} ?>">Next</a>
                </li>
                <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
              </ul>
            </div>
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
