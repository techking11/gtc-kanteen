<?php
include './__action/nav.php';
include './Admin/config/config.php';
if(empty($_SESSION['username'])) {
  echo "<script>window.location.href='index.php'</script>";
}
?>

<!-- book section -->
<section class="book_section layout_padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <?php
        if (isset($_POST['contact'])) {
          $email = $_POST['email'];
          $comment = $_POST['comment'];
          date_default_timezone_set("Asia/Yangon");
          $contactTime = date("h:i:s a");
          $sql = "INSERT INTO tbltempcontact (email, comment, contact_time) VALUES (?, ?, ?)";

          if ($stmt = $database->prepare($sql)) {
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $comment);
            $stmt->bindParam(3, $contactTime);
          }
          if ($stmt->execute() == true) {
            echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong>Success!</strong> Successful your contact infomation !
            </div>
            ";

          }
        }
        ?>
        <div class="heading_container mb-0">
          <h2>
            Contact To Us
          </h2>
        </div>
        <div class="form_container contact_link_box">
          <a href="https://goo.gl/maps/KNDpkisg7vsR941r7" target="_blank">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span>
              Location
            </span>
          </a>
          <a href="tel:09893569226">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <span>
              Call +95 09-893569226
            </span>
          </a>
          <a href="https://mail.google.com/mail/u/0/" target="_blank">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>
              techking1132000@gmail.com
            </span>
          </a>
          <form action="" method="post" class="mt-3">
            <div>
              <input type="email" class="form-control" placeholder="Your Email" name="email" autocomplete="off" required>
            </div>
            <div>
              <input type="text" class="form-control" placeholder="Enter Comment" name="comment" autocomplete="off" required>
            </div>
            <div class="btn_box">
              <button class="mt-0" name="contact">Send Us</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="map_container ">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3116.1026748904906!2d93.52203731434463!3d19.41927618689186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ba0f99c7ba0717%3A0x59a40bf8f53e5672!2sGTC%20-%20KanTinn%20Shop!5e1!3m2!1sen!2smm!4v1671503494153!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" ></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end book section -->
<?php include './__action/footer.php'; ?>
