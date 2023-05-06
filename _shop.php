<?php
include './__action/nav.php';
if(empty($_SESSION['username'])) {
  echo "<script>window.location.href='index.php'</script>";
}
 ?>

<!-- food section -->
<section class="food_section layout_padding" id="all_shop">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        GTC KanTeens
      </h2>
      <p class="text-justify text-dark">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae placeat, sapiente nobis inventore eum tenetur error. Inventore minima sapiente voluptate nemo repellat. Optio facilis fugiat voluptas autem ducimus. Perferendis, provident? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque quisquam mollitia quibusdam reiciendis ducimus, saepe neque velit soluta quasi vero assumenda ullam cumque.
      </p>
    </div>

    <div class="filters-content">
      <div class="row grid">
        <div class="col-sm-6 col-lg-4 all pizza">
          <div class="box">
            <div>
              <a href="drawing.php" class="text-light">
                <div class="img-box">
                  <img src="images/drawing.jpg" alt="" class="rounded">
              </div>
              <div class="detail-box">
                <h5>
                  Drawing KanTeen
                </h5>
              </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 all burger">
          <div class="box">
            <div>
              <a href="apyo.php" class="text-light">
                <div class="img-box">
                  <img src="images/apyo.jpg" alt="" class="rounded">
              </div>
              <div class="detail-box">
                <h5>
                  APyo KanTeen
                </h5>
              </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 all pizza">
          <div class="box">
            <div>
              <a href="network.php" class="text-light">
                <div class="img-box">
                  <img src="images/network.jpg" alt="" class="rounded">
              </div>
              <div class="detail-box">
                <h5>
                  Network KanTeen
                </h5>
              </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 all pasta">
          <div class="box">
            <div>
              <a href="aree.php" class="text-light">
                <div class="img-box">
                  <img src="images/aree.jpg" alt="" class="rounded">
                </div>
                <div class="detail-box">
                  <h5>
                    ARee KanTeen
                  </h5>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 all fries">
          <div class="box">
            <div>
              <a href="bubble.php" class="text-light">
                <div class="img-box">
                  <img src="images/apyo.jpg" alt="" class="rounded">
                </div>
                <div class="detail-box">
                  <h5>
                    Bubble KanTeen
                  </h5>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 all pizza">
          <div class="box">
            <div>
              <a href="me.php" class="text-light">
                <div class="img-box">
                  <img src="images/me.jpg" alt="" class="rounded">
                </div>
                <div class="detail-box">
                  <h5>
                    ME KanTeen Shop
                  </h5>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end food section -->

<?php include './__action/footer.php'; ?>
