<?php
include './__action/nav.php';
include './Admin/config/config.php';
if(empty($_SESSION['username'])) {
  echo "<script>window.location.href='index.php'</script>";
}
?>
<!-- about section -->

<section class="about_section layout_padding" style="background: #fff; color: #000;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="img-boxs">
          <img src="images/about.jpg" alt="" class="img-fluid">
        </div>
      </div>
      <div class="col-md-12 mt-3">
        <div class="detail-box">
          <div class="heading_container">
            <h2 class="text-dark">
              3GIT-KPU Group2
            </h2>
          </div>
          <p class="text-justify text-dark">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour, or randomised words which don't look even slightly believable. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consequuntur doloribus eaque ex fugiat, iure laborum molestias, numquam officiis possimus provident sequi soluta tempore? Aliquam ea facere nihil placeat unde.
          </p>
          <table class="table table-hover mt-4">
            <thead>
            <tr>
              <th>No</th>
              <th>Junior Web Developer Team</th>
              <th>Phone No</th>
              <th>Email</th>
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
                  </tr>
                  <?php
                  $i++;
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

  <?php include './__action/footer.php'; ?>
