<?php


$id = $_POST['id'];
$concentration = $_POST['concentration'];
$volume = $_POST['volume'];
$all_drop = $_POST['all_drop'];
$all_content = $_POST['all_content'];
$one_drop_content = $_POST['one_drop_content'];
$one_drop_price = $_POST['one_drop_price'];
$image_path = $_POST['image_path'];
$product_link = $_POST['product_link'];
$image_file = $_POST['image_file'];

// var_dump($id);
// exit();

$params = [
    'id' => $_POST['id'],
    'concentration' => $_POST['concentration'],
    'volume' => $_POST['volume'],
    'all_drop' => $_POST['all_drop'],
    'all_content' => $_POST['all_content'],
    'one_drop_content' => $_POST['one_drop_content'],
    'one_drop_price' => $_POST['one_drop_price'],
    'image_path' => $_POST['image_path'],
    'link' => $_POST['product_link'],
    // 'image_file' => $_POST['image_file']
];


// DB接続
include('../function.php');
$pdo = connect_to_db();

$sql = "UPDATE cbd_recommend_table SET 
             id=:id, 
             concentration=:concentration,
             volume=:volume , 
             all_drop=:all_drop ,
             all_content=:all_content , 
             one_drop_content=:one_drop_content ,
             one_drop_price=:one_drop_price ,
             image_path=:image_path ,
             link=:link
             WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':concentration', $concentration, PDO::PARAM_STR);
$stmt->bindValue(':volume', $volume, PDO::PARAM_STR);
$stmt->bindValue(':all_drop', $all_drop, PDO::PARAM_STR);
$stmt->bindValue(':all_content', $all_content, PDO::PARAM_STR);
$stmt->bindValue(':one_drop_content', $one_drop_content, PDO::PARAM_STR);
$stmt->bindValue(':one_drop_price', $one_drop_price, PDO::PARAM_STR);
$stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);
$stmt->bindValue(':link', $product_link, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:products_read.php");
exit();
