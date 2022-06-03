<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>商品規格リスト</title>
</head>

<body>
    <?php

    include('../function.php');
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
    // echo '</pre>';

    $output = "";
    foreach ($result as $record) {
        $output .= "
            <tr>
                <td>{$record['concentration']}</td>
                <td>{$record['volume']}</td>
                <td>{$record['all_content']}</td>
                <td>{$record['all_drop']}</td>
                <td>{$record['one_drop_content']}</td>
                <td>{$record['one_drop_price']}</td>
                <td>{$record['image_path']}</td>
                <td>{$record['link']}</td>
                <td><a class='btn btn-secondary' href='product_edit.php?id={$record["id"]}'>edit</a></td>
                <td><a class='btn btn-secondary' href='product_delete.php?id={$record["id"]}'>delete</a></td>
            </tr>   
  ";
    }

    ?>


    <div class="all_products">
        <p class="fs-2 text">規格データ</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">CBD濃度(%)</th>
                    <th scope="col">サイズ(ml)</th>
                    <th scope="col">CBD全量(mg)</th>
                    <th scope="col">1本あたりの<br>使用回数(滴数)</th>
                    <th scope="col">1滴あたりの<br>CBD含有量(mg)</th>
                    <th scope="col">1mgあたりの<br>金額(円)</th>
                    <th scope="col">画像のパス</th>
                    <th scope="col">商品リンク(URL)</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <!-- ここに製品一覧をデータベースからinput -->
            <tbody id="outputArea"><?= $output ?></tbody>
        </table>
    </div>



</body>

</html>