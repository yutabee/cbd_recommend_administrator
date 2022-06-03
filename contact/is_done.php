<?php
// DB接続
include('../function.php');
$pdo = connect_to_db();

// var_dump($pdo);
// exit();

$id = $_GET['id'];
$is_done = $_GET['is_done'];

// var_dump($id);
// exit();

$sql = "";
if ($is_done == 0) {
    $sql = "UPDATE cbd_contact_table SET is_done = !$is_done WHERE id=:id";
} elseif ($is_done == 1) {
    $sql = "UPDATE cbd_contact_table SET is_done = !$is_done WHERE id=:id";
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:contact_read.php");
exit();
