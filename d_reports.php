<?php

date_default_timezone_set('Asia/Tokyo');

// ユーザー名取得
$user_name = $_SESSION['name'];

// 表示する日付を取得
$date = isset($_GET['date']) ? new DateTime($_GET['date']) : new DateTime();

// 日報登録
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item1 = $user_name;
    $item2 = $_POST['item2'];
    // $item3 = $_POST['item3']; 

        // 既存の日報を検索
        $stmt = $pdo->prepare('SELECT * FROM daily_reports WHERE name = ? AND DATE(created_at) = CURDATE()');
        $stmt->execute([$item1]);
        $report = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($report) {
            // 日報が存在する場合は更新
            $stmt = $pdo->prepare('UPDATE daily_reports SET t_check = ?, created_at = ? WHERE cid = ?');
            $stmt->execute([$item2, date('Y-m-d H:i:s'), $report['cid']]);
        } else {
            // 日報が存在しない場合は新規登録
            $stmt = $pdo->prepare('INSERT INTO daily_reports (name, t_check, created_at) VALUES (?, ?, ?)');
            $stmt->execute([$item1, $item2, date('Y-m-d H:i:s')]);
        }
    }

// 日報取得
$stmt = $pdo->prepare("SELECT * FROM daily_reports WHERE DATE(created_at) = ?");
$stmt->execute([$date->format('Y-m-d')]);
$daily_reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ユーザー名リスト
$user_names = ['AAA', 'BBB', 'CCC', 'DDD'];

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

  <style>
    .stylish-table {
      width: 70%;
      margin: 0 auto;
      /* border-collapse: collapse; */
      text-align:center;
    }
    .stylish-table td, .stylish-table th {
      border: none;
      padding: 10px;
      width: 10%;
      word-wrap: break-word;
    }
  </style>

</head>

<body>

<?php if($_SESSION["kanri_flg"]=="1" || $_SESSION["kanri_flg"]=="2"){ ?>

    <div class="height-b15 height-lg-b45"></div>
    <!-- <h3>Registration</h3> -->
    <!-- <div class="height-b15 height-lg-b45"></div> -->
    <form action="#DREPORT" method="post">
        <!-- <label for="item2">SELECT：</label> -->
        <select id="item2" name="item2">
            <option value="〇：出勤可能">〇：出勤可能</option>
            <option value="△：未定">△：未定</option>
            <option value="✕：欠勤">✕：欠勤</option>
        </select>
        <!-- <label for="item3">MEMO：</label>
        <textarea id="item3" name="item3"></textarea> -->
        <!-- <div class="height-b25 height-lg-b45"></div> -->
        <!-- <div class="col-lg-6 offset-lg-3"> -->
              <button type="submit" id="submit" name="submit" target="#DREPORT">SUBMIT</button>
            <!-- </div> -->
    </form>

    <div class="height-b65 height-lg-b45"></div>

    <!-- <h3>List</h3>
    <div class="height-b15 height-lg-b45"></div> -->

    <a href="?date=<?php echo (clone $date)->modify('-1 day')->format('Y-m-d'); ?>#DREPORT">◀</a>
    <?php echo $date->format('Y年m月d日'); ?>
    <a href="?date=<?php echo (clone $date)->modify('+1 day')->format('Y-m-d'); ?>#DREPORT">▶</a>


    <br><br>

<div class="container">
  <div id="at-alert"></div>
  <div class="row">
    <!-- <div class="col-md-6"> -->
      <!-- <div class="at-form-field"> -->
        <table class="stylish-table">
            <tr>
                <th>NAME</th>
                <th>出社</th>
                <!-- <th>MEMO</th> -->
                <th>登録・修正時間</th>
            </tr>
            <?php foreach ($user_names as $name): ?>
                <?php $report = array_values(array_filter($daily_reports, function ($report) use ($name) { return $report['name'] === $name; }))[0] ?? null; ?>
                <tr>
                    <td><?php echo htmlspecialchars($name); ?></td>
                    <td><?php echo htmlspecialchars($report['t_check'] ?? ''); ?></td>
                    <!-- <td><?php echo htmlspecialchars($report['text'] ?? ''); ?></td> -->
                    <td><?php echo htmlspecialchars($report['created_at'] ?? ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
      <!-- </div>
    </div> -->
  </div>
</div>


<?php } ?>

</body>
</html>