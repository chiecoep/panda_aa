<?php
session_start();
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM login";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!doctype html>
<html class="no-js" lang="ja">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PANDAの説明要約を記載する">
  <!-- Page Title -->
  <title>ママの新しい働き方【PANDA】Parents AND Association</title>
  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

  <!-- Start Site Header -->
  <header class="site-header">
    <div class="container header-wrap">
      <div class="site-branding">
         <!-- <span class="site-title">
          <a href="index.php">PANDA</a>
        </span> -->
      </div>
      <nav class="primary-nav">
        <ul class="primary-nav-list">
          <li class="menu-item menu-item-has-children current-menu-ancestor current-menu-parent"><a href="#HOME" class="nav-link">HOME</a></li>
          <li class="menu-item"><a href="#CALENDAR" class="nav-link">SCHEDULE</a></li>
          <li class="menu-item"><a href="#DREPORT" class="nav-link">DAILY REPORT</a></li>
          <li class="menu-item"><a href="#CHAT" class="nav-link">CHAT</a></li>
          <?php if($_SESSION["kanri_flg"]=="2"){ ?>
            <li class="menu-item"><a href="#REGISTRATION" class="nav-link">USER REGISTRATION</a></li>
          <?php } ?>
          <li class="menu-item"><a href=logout.php class="nav-link">LOGOUT</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- End Site Header -->

  <div class="at-cotent">

    <!-- Start Featured Service -->
      <div id="HOME" class="height-b100 height-lg-b100"></div>
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="at-section-heading at-style1">
            <?php echo $_SESSION["name"]; ?>さん、こんにちは！
          </div>
      </div>
      </div>
      </div>
    <!-- End Featured Service -->

    <!-- Start Featured Service -->
    <div id="CALENDAR" class="height-b100 height-lg-b100"></div>
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="at-section-heading at-style1">
            <h2>SCHEDULE</h2>
            <div class="height-b40 height-lg-b30"></div>
              <?php include 'calendar02.php'; ?>
          </div>
      </div>
      </div>
    </div>
    <!-- End Featured Service -->

    <!-- Start Featured Service -->
    <div id="DREPORT" class="height-b150 height-lg-b100"></div>
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="at-section-heading at-style1">
            <h2>DAILY REPORT</h2>
            <div class="height-b40 height-lg-b30"></div>
              <?php include 'd_reports.php'; ?>
          </div>
      </div>
    </div>
    <!-- End Featured Service -->

    <!-- Start Featured Service -->
    <div id="CHAT" class="height-b150 height-lg-b100"></div>
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="at-section-heading at-style1">
            <h2>CHAT</h2>
            <div class="height-b40 height-lg-b30"></div>
              <?php include 'chat.php'; ?>
          </div>
      </div>
      </div>
    </div>
    <!-- End Featured Service -->

    <div class="height-b40 height-lg-b30"></div>

    <!-- Start Featured Service -->
    <?php if($_SESSION["kanri_flg"]=="2"){ ?>
    <section class="at-contact-wrap" id="REGISTRATION">
    <div class="height-b150 height-lg-b100"></div>
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="at-section-heading at-style1">
            <h2>USER REGISTRATION</h2>

            <div class="height-b40 height-lg-b30"></div>
              <?php include 'user.php'; ?>
          </div>
        </div>
      </div>
      </div>
    </div>
    </section>
    <?php } ?>
 
    <!-- End Featured Service -->

  <!-- End Contact Section -->
  </div>

  </div>
  <!-- .at-cotent -->





  <!-- Start Site Footer -->
  <footer class="at-site-footer">
    <div class="at-bg" data-src="assets/img/footer-bg.jpg">
      <div class="height-b100 height-lg-b70"></div>
      <div class="container">
        <div class="row">

          <div class="col-lg-1">
            <div class="at-footer-widget at-footer-link">
              <h2 class="at-footer-widget-title"></h2>
              <div class="height-b40 height-lg-b30"></div>
            </div>
          </div><!-- .col -->

          <div class="col-lg-2">
            <div class="at-footer-widget at-footer-time">
              <h2 class="at-footer-widget-title">Site Map -</h2>
              <div class="height-b40 height-lg-b30"></div>
              <ul>
                <li><a href="#HOME">Home</a></li>
                <li><a href="#CALENDAR">Schdule</a></li>
                <li><a href="#DREPORT">Daily Report</a></li>
                <li><a href="#CHAT">Chat</a></li>
                <?php if($_SESSION["kanri_flg"]=="2"){ ?>
                  <li><a href="#REGISTRATION">User Registration</a></li>
                <?php } ?>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </div>
          </div><!-- .col -->

          <div class="col-lg-5">
            <div class="at-footer-widget at-footer-info">
              <h2 class="at-footer-widget-title">Conatct Info -</h2>
              <div class="height-b40 height-lg-b30"></div>
              <ul>
                <li><strong>PANDA</strong></li>
                <li>Address : 東京都新宿区四谷4-18-66<br> 
                              アトリエ三つ葉2F </li>
                <li>Email : panda2404p@gmail.com</li>
              </ul>
              <div class="height-b30 height-lg-b30"></div>
              <!-- <div class="at-footer-social">
                <a href="#" class="at-btn at-style1"><i class="fa fa-facebook"></i></a>
                <a href="#" class="at-btn at-style1"><i class="fa fa-twitter"></i></a>
                <a href="#" class="at-btn at-style1"><i class="fa fa-instagram"></i></a>
                <a href="#" class="at-btn at-style1"><i class="fa fa-youtube-play"></i></a>
              </div> -->
            </div>
          </div><!-- .col -->

          <div class="col-lg-4">
            <div class="at-footer-widget">
              <!-- <h2 class="at-footer-widget-title">About -</h2> -->
              <div class="height-b40 height-lg-b30"></div>
              <!-- <div class="at-text-widget">
                On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue and equal blame belongs to those who fail in their duty through weakness of will. Get in touch we always try to make some boom.
              </div> -->
            </div>
          </div><!-- .col -->



        </div>
      </div>
      <div class="height-b100 height-lg-b70"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <hr>
            <div class="height-b40 height-lg-b20"></div>
            <div class="at-copyright">
              <div class="at-left-copyright">© PANDA - 2024</div>
            </div>
            <div class="height-b40 height-lg-b20"></div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Site Footer -->




<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>

  <!-- Scripts -->
  <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
  <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/smoothscroll.js"></script>
  <script src="assets/js/jQuery.easing.js"></script>
  <script src="assets/js/owl.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>
