<?php
include './__action/nav.php';
include './Admin/config/config.php';
if(empty($_SESSION['username'])) {
  echo "<script>window.location.href='index.php'</script>";
}
?>
<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1>ARee KanTeen Menu</h1>
            <p class="text-justify mb-5 text-dark">
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour, or randomised words which don't look even slightly believable. Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, pariatur. Aliquid quam esse aut tempora consequuntur labore dolorem ut suscipit molestias nesciunt! Officiis ducimus temporibus nobis facilis sequi, nam explicabo!
            </p>
        </div>
        <?php
        if (!empty($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
        }else {
          $pageno = 1;
        }
          $numOfres = 10;
          $offset = ($pageno - 1) * $numOfres;

          $date = date("Y-m-d");
          if (empty($_POST['search'])) {
            $stmt = $database->prepare("SELECT * FROM tblareekanteen ORDER BY id DESC");
            $stmt->execute();
            $rawResult = $stmt->fetchAll();
            $total_pages = ceil(count($rawResult) / $numOfres);

            $stmt = $database->prepare("SELECT * FROM tblareekanteen ORDER BY id DESC LIMIT $offset, $numOfres");
            $stmt->execute();
            $result = $stmt->fetchAll();
          }else {
            $searchkey = $_POST['search'];
            $stmt = $database->prepare("SELECT * FROM tblareekanteen WHERE menu_name LIKE '%$searchkey%' ORDER BY id DESC");
            $stmt->execute();
            $rawResult = $stmt->fetchAll();
            $total_pages = ceil(count($rawResult) / $numOfres);

            $stmt = $database->prepare("SELECT * FROM tblareekanteen WHERE menu_name LIKE '%$searchkey%' ORDER BY id DESC LIMIT $offset, $numOfres");
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
        ?>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="tab-content">
              <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 mb-3">
                  <form class="form" action="" method="post">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search..." name="search">
                      <div class="input-group-append">
                        <button class="btn btn-secondary" type="button"><i class="fa fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
                <div class="row">
                  <?php
                  if($result) {
                    foreach ($result as $value) {
                  ?>
                  <div class="col-lg-6 mt-3">
                      <div class="d-flex align-items-center">
                          <div class="mx-2">
                            <small class="text-danger"><?php echo $value['menu_date']; ?></small>
                            <img class="flex-shrink-0 img-fluid rounded" src="./Admin/images/<?php echo $value['menu_img']; ?>" alt="" style="width: 135px;">
                          </div>
                          <div class="w-100 d-flex flex-column text-start ps-4">
                              <h5 class="d-flex justify-content-between border-bottom pb-1">
                                  <span><?php echo $value['menu_name']; ?> <small style="background-color: black; padding: 2px; border-radius: 5px; color: red; <?php if($value['menu_date'] == $date){echo 'display:inline;';}else {echo 'display:none;';} ?>">new</small></span>
                                  <span class="text-warning"><?php echo $value['menu_price']; ?> MMK</span>
                              </h5>
                              <small class="text-justify"><?php echo substr($value['menu_content'], 0, 250); ?><a href="aree_menu.php?id=<?php echo $value['id']; ?>"> Read More ...</a> </small>
                          </div>
                      </div>
                  </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <nav aria-label="...">
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
                    </nav>
                  </div>
            </div>
        </div>
    </div>
</div>
<!-- Menu End -->

<?php include './__action/footer.php'; ?>
