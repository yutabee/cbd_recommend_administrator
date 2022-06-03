<?php

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$is_admin = $_POST['is_admin'];

// echo '<pre>';
// var_dump($id);
// echo '<pre>';
// exit();

// $params = [
//     'id' => $_POST['id'],
//     'username' => $_POST['username'],
//     'email' => $_POST['email'],
//     'password' => $_POST['password'],
//     'is_admin' => $_POST['is_admin'],
//     'is_deleted' => $_POST['is_deleted'],
// ];

// DB接続
include('../function.php');
$pdo = connect_to_db();

$sql = "UPDATE users_table SET 
             username=:username ,
             email=:email , 
             password=:password ,
             is_admin=:is_admin 
             WHERE id=:id";

//多分ここのSQL分がまずいのでエラー出てる！！！！！！！！！！！！！！！！！！！！！！！！！！！！
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_STR);


try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:users.php");
exit();
