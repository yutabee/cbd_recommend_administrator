<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>ユーザー編集</title>
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
    $sql = 'SELECT * FROM users_table WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }

    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // var_dump($record['id']);
    // echo '<pre>';
    // exit();



    ?>

    <div class='register-form'>
        <p class="fs-2">ユーザー編集</p>
        <form action="users_update.php" method="POST">
            <fieldset>
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $record['username'] ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $record['email'] ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?= $record['password'] ?>">
                </div>
                <div class="mb-3">
                    <label for="is_admin" class="form-label">is_admin</label>
                    <input type="text" class="form-control" id="is_admin" name="is_admin" value="<?= $record['is_admin'] ?>">
                </div>

                <!-- hiddenの形式でidを隠して送信 -->
                <div>
                    <input type="hidden" name="id" value="<?= $record['id'] ?>">
                    <input type="hidden" name="is_deleted" value="<?= $record['is_deleted'] ?>">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btnx-outline-lime">登録</button>
                </div>
            </fieldset>
        </form>
    </div>

    <style>
        .register-form {
            margin: 5% 25%;
        }

        .btnx-outline-lime {
            color: #827717;
            background: var(--bs-white);
            border: 2px solid #C5E1A5;
        }

        .btnx-outline-lime:hover {
            background-color: #C5E1A5;
        }
    </style>
</body>

</html>