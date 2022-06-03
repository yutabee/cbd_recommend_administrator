<?php
//db読み込み
require './function.php';
$pdo = connect_to_db();

$sql = 'SELECT * FROM cbd_recommend_table';
$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($result);
// echo '<pre>';
// exit();
