
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

<?php if($_SESSION["kanri_flg"]=="2"){ ?>

<form method="post" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
     <label>NAME：<input type="text" name="name"></label><br>
     <label> ID ： <input type="text" name="lid"></label><br>
     <label>PW：<input type="text" name="lpw"></label><br>
     <label>管理FLG：
      一般<input type="radio" name="kanri_flg" value="1">　
      管理者<input type="radio" name="kanri_flg" value="2">
    </label>
    <br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <input type="submit" value="SUBMIT" class="at-btn at-style2 w-45">
    </fieldset>
  </div>
</form>



  <div class="height-b150 height-lg-b300"></div>


<?php } ?>

</body>
</html>
