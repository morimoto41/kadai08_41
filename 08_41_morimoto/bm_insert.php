<?php
//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$cmt = $_POST["cmt"];

//2. DB接続します
include "funcs.php";
$pdo = db_con();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(name,url,cmt,indate)VALUES(:name,:url,:cmt,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); 
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':cmt', $cmt, PDO::PARAM_STR); 
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: bm_index.php");
    exit;
}
