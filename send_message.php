<?php
session_start();
include "funcs.php";

// データベースへの接続
$pdo = db_conn();

// ログイン情報からユーザー名を取得
$name = $_SESSION['name'];

// メッセージを送信
if(isset($_POST['message'])){
    $message = $_POST['message'];

    try {
        // メッセージをデータベースに保存
        $query = $pdo->prepare("INSERT INTO chatdb (name, message) VALUES (:name, :message)");
        $query->bindParam(':name', $name);
        $query->bindParam(':message', $message);
        $query->execute();
    } catch (PDOException $e) {
        // エラーメッセージを表示
        echo "データベースエラー: " . $e->getMessage();
    }
}

// 送信後に元のページにリダイレクト
header('Location: panda.php#CHAT');
?>
