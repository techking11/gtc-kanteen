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
          <h1 class="text-info">New Menu Orders</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="order.php">Home</a></li>
            <li class="breadcrumb-item active">Orders</li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover mb-3">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Menu Name</th>
                  <th>KanTeen</th>
                  <th>Order Count</th>
                  <th>Order User</th>
                  <th>Phone No</th>
                  <th>Address</th>
                  <th>Order Date</th>
                  <th>Order Time</th>
                  <th></th>
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
                    $stmt = $database->prepare("SELECT * FROM tbltemporder ORDER BY id DESC");
                    $stmt->execute();
                    $rawResult = $stmt->fetchAll();
                    $total_pages = ceil(count($rawResult) / $numOfres);

                    $stmt = $database->prepare("SELECT * FROM tbltemporder ORDER BY id DESC LIMIT $offset, $numOfres");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                  }else {
                    $searchkey = $_POST['search'];
                    $stmt = $database->prepare("SELECT * FROM tbltemporder WHERE menu_name LIKE '%$searchkey%' ORDER BY id DESC");
                    $stmt->execute();
                    $rawResult = $stmt->fetchAll();
                    $total_pages = ceil(count($rawResult) / $numOfres);

                    $stmt = $database->prepare("SELECT * FROM tbltemporder WHERE menu_name LIKE '%$searchkey%' ORDER BY id DESC LIMIT $offset, $numOfres");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                  }

                  if ($result) {
                    $i = 1;
                    foreach ($result as $value) {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['menu_name']; ?></td>
                        <td><?php echo $value['kanteen']; ?></td>
                        <td><?php echo $value['order_no']; ?></td>
                        <td><?php echo $value['order_user']; ?></td>
                        <td><?php echo $value['phone_no']; ?></td>
                        <td><?php echo $value['address']; ?></td>
                        <td><?php echo $value['order_date']; ?></td>
                        <td><?php echo $value['order_time']; ?></td>
                        <td>
                          <a href="moveorder.php?id= <?php echo $value['id']; ?>" class="btn btn-success">Approved</a>
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
              $stmt = $database->prepare("SELECT count(*) as Total FROM tbltemporder");
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
