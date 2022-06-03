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
    <title>編集画面</title>
</head>

<body>

    <?php

    $id = $_GET['id'];

    // var_dump($id);
    // exit();

    //db接続
    include("../function.php");
    $pdo = connect_to_db();

    //idが一致するものを取り出す
    $sql = 'SELECT * FROM cbd_recommend_table WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }

    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>

    <div class="register-form">
        <p class="fs-2">プロダクト編集</p>

        <form action="product_update.php" method="POST">
            <fieldset>
                <div class="mb-3 row">
                    <label for="concentration" class="col-sm-2 col-form-label">concentration(%)</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="concentration" name="concentration" value="<?= $record['concentration'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="volume" class="col-sm-2 col-form-label">volume(mL)</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="volume" name="volume" value="<?= $record['volume'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="all_drop" class="col-sm-2 col-form-label">all_drop(drop)</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="all_drop" name="all_drop" value="<?= $record['all_drop'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="all_content" class="col-sm-2 col-form-label">all_content(mg)</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="all_content" name="all_content" value="<?= $record['all_content'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="one_drop_content" class="col-sm-2 col-form-label">all_content(mg)</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="one_drop_content" name="one_drop_content" value="<?= $record['one_drop_content'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="one_drop_price" class="col-sm-2 col-form-label">one_drop_price(yen)</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="one_drop_price" name="one_drop_price" value="<?= $record['one_drop_price'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="image_path" class="col-sm-2 col-form-label">img_path</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="image_path" name="image_path" value="<?= $record['image_path'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="product_link" class="col-sm-2 col-form-label">product_link</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_link" name="product_link" value="<?= $record['link'] ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image_file" class="form-label">image</label>
                    <input class="form-control" type="file" id="image_file" name="image_file">
                </div>

                <!-- hiddenの形式でidを隠して送信 -->
                <div>
                    <input type="hidden" name="id" value="<?= $record['id'] ?>">
                </div>

                <br>
                <button type="submit" class="btn btn-primary btnx-outline-lime" id="submit">submit</button>
            </fieldset>
        </form>
    </div>

    <style>
        .register-form {
            margin: 5% 20%;
        }
    </style>

</body>

</html>