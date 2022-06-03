<?php
// DB接続
include('../function.php');
$pdo = connect_to_db();

$sql = 'SELECT * FROM cbd_contact_table ORDER BY created_at DESC';
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

$is_done = "";
$is_deleted = "";
$output = "";
foreach ($result as $record) {
  if ($record['is_done'] === 0) {
    $is_done =  "<a class='btn btn-primary' href='is_done.php?id={$record["id"]} & is_done={$record["is_done"]}' >対応する</a>";
  } elseif ($record['is_done'] === 1) {
    $is_done = "<a class='btn btn-secondary' href='is_done.php?id={$record["id"]} & is_done={$record["is_done"]}'>対応済み</a>";
  }

  $output .= "
      <tr>
        <td>{$record['your_name']}</td>
        <td>{$record['email']}</td>
        <td>{$record['title']}</td>
        <td>{$record['contact']}</td>
        <td>{$record['created_at']}</td>
        <td>{$is_done}</td>
        <td><a class='btn btn-secondary' href='is_deleted.php?id={$record["id"]}'>削除</></td>
      </tr>
      ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>contact</title>
</head>

<body>
  <a href="contact_input.php">お問い合わせ入力フォーム</a>
  <br>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">titile</th>
        <th scope="col">contact</th>
        <th cope="col">datetime</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody><?= $output ?></tbody>
  </table>

</body>

</html>