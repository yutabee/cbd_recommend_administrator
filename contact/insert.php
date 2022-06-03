<?php

include '../function.php';

//フォームの入力値のチェック
if (
  !isset($_POST['your_name']) || $_POST['your_name'] == '' ||
  !isset($_POST['email']) || $_POST['email'] == '' ||
  !isset($_POST['title']) || $_POST['title'] == '' ||
  !isset($_POST['contact']) || $_POST['contact'] == ''
) {
  exit('paramError');
}

$pdo = connect_to_db();

// var_dump($pdo);
// exit();

$params = [
  'id' => null,
  'your_name' => $_POST['your_name'],
  'email' => $_POST['email'],
  'title' => $_POST['title'],
  'contact' => $_POST['contact'],
  'created_at' => null
];

// var_dump($params);
// exit();

// SQL作成&実行
$sql = "INSERT INTO cbd_contact_table (id, your_name, email, title, contact, created_at ) 
VALUES (NULL,:your_name,:email,:title,:contact,now())";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':your_name', $params['your_name'], PDO::PARAM_STR);
$stmt->bindValue(':email', $params['email'], PDO::PARAM_STR);
$stmt->bindValue(':title', $params['title'], PDO::PARAM_STR);
$stmt->bindValue(':contact', $params['contact'], PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:contact_input.php');
exit();
