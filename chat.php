<?php

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
        #chatBox {
            height: 200px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column-reverse;
        }
        .message {
            max-width: 60%;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            text-align: left;
        }
        .user {
            align-self: flex-end;
            background-color: #DCF8C6;
        }
        .other {
            background-color: #FFFFFF;
        }
    </style>
</head>


<body>


<?php if($_SESSION["kanri_flg"]=="1" || $_SESSION["kanri_flg"]=="2"){ ?>


    <div id="chatBox">
        <?php
        // データベースからメッセージを取得して表示
        $query = $pdo->prepare("SELECT * FROM chatdb ORDER BY id DESC");
        $query->execute();

        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $class = ($fetch['name'] == 'User') ? 'user' : 'other';
            echo "<div class='message {$class}'>";
            echo "<strong>" . htmlspecialchars($fetch['name'], ENT_QUOTES, 'UTF-8') . "</strong>";
            echo "<p>" . htmlspecialchars($fetch['message'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p><small>{$fetch['date']}</small></p>";
            echo "</div>";
        }
        ?>
    </div>

    <form action="send_message.php" method="post">
        <?php echo $_SESSION["name"]; ?>さん
        <input type="text" name="message" placeholder="Type your message here" required />
        <input type="submit" value="Send" />
    </form>

    <script>
        var chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;

        function scrollToBottom() {
            setTimeout(function() {
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 100);
        }
    </script>
    
<?php } ?>

</body>
</html>




