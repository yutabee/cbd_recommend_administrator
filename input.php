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
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>input</title>
</head>

<body>
    <?php

    require './cbd_db_read.php';
    require './recommend_dose_read.php';

    session_start();
    // var_dump($_SESSION);
    // exit();
    $login = "";
    $product_management = "";
    if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
        $login = '<a href="./login/login.php">LOGIN</a>';
    } else {
        $login = '<a href="./login/logout.php">LOGOUT</a>';
        $contact_link = '<a href="./contact/contact_input.php">CONTACT</a>';
        if ($_SESSION["is_admin"] == 1) {
            $product_management = '<a href="Edit.php">EDIT</a>';
        }
    }

    ?>

    <header>
        <h1>
            <a href="/">CBD RECOMMEND</a>
        </h1>
        <nav class="pc-nav">
            <ul>
                <!-- <li><a href="#">ABOUT</a></li>
                <li><a href="#">SERVICE</a></li>
                <li><a href="#">COMPANY</a></li> -->
                <li><?= $contact_link ?></li>
                <li><?= $product_management ?></li>
                <li><?= $login ?></li>
            </ul>
        </nav>
    </header>
    <div class="main-visual">
        <h2>CBD CHANGE THE WORLD</h2>
    </div>

    <main>
        <div class="cbd_Que_form">
            <p class="fs-2">Question</p>
            <p>下記のフォームを入力すればあなたにあった開始用量がわかります。</p>
            <form action="./cbd_mg_create.php" method="POST">
                <div class="mb-3">
                    <label for="age" class="form-label">年齢</label>
                    <select class="form-select" id="age" name="age">
                        <option>未選択</option>
                        <option value="20">２０代</option>
                        <option value="30">３０代</option>
                        <option value="40">４０代</option>
                        <option value="50">５０代</option>
                        <option value="60">６０代</option>
                        <option value="70">７０代</option>
                        <option value="70">８０代</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">性別</label>
                    <select class="form-select" id="gender" name="gender">
                        <option>未選択</option>
                        <option value="man">男性</option>
                        <option value="woman">女性</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="symptom" class="form-label">症状 (※頭痛、不眠、湿疹など)</label>
                    <select class="form-select" id="symptom" name="symptom">
                        <option>未選択</option>
                        <option value="have">あり</option>
                        <option value="not_have">なし</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">体重</label>
                    <select class="form-select" id="weight" name="weight">
                        <option>未選択</option>
                        <option value="30">30~39kg</option>
                        <option value="40">40~49kg</option>
                        <option value="50">50~59kg</option>
                        <option value="60">60~69kg</option>
                        <option value="70">70~79kg</option>
                        <option value="80">80~89kg</option>
                        <option value="90">90~99kg</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btnx-outline-lime" id="submit">submit</button>
            </form>
        </div>

        <p class="fs-2 text" id="recommend_text">あなたの最適な開始用量は1日<?= $line ?>mgです!!</p>

        <div class="recommend_products">
            <p class="fs-2 text">おすすめの規格はこちら</p>
            <p class="fs-3">1日に2〜3滴,舌下から摂取してください。</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CBD濃度(%)</th>
                        <th scope="col">サイズ(ml)</th>
                        <th scope="col">CBD全量(mg)</th>
                        <th scope="col">1本あたりの使用回数(滴数)</th>
                        <th scope="col">1滴あたりの<br>CBD含有量(mg)</th>
                        <th scope="col">1mgあたりの<br>金額(円)</th>
                    </tr>
                </thead>
                <tbody id="recommend_products"></tbody>
            </table>
        </div>
        <div class="all_products">
            <p class="fs-2 text">その他の全規格</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CBD濃度(%)</th>
                        <th scope="col">サイズ(ml)</th>
                        <th scope="col">CBD全量(mg)</th>
                        <th scope="col">1本あたりの使用回数(滴数)</th>
                        <th scope="col">1滴あたりの<br>CBD含有量(mg)</th>
                        <th scope="col">1mgあたりの<br>金額(円)</th>
                    </tr>
                </thead>
                <!-- ここに製品一覧をデータベースからinput -->
                <tbody id="outputArea"></tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy;Yuuuuuuuuuuuuta tmr</p>
    </footer>


    <script>
        const Objs = <?= json_encode($result) ?>; //全商品データ
        const personalDoseJson = <?= json_encode($line) ?>; //個別の一回投与量
        console.log(personalDoseJson);
        console.log(Objs);
        let outText = '';
        for (Obj of Objs) {
            outText +=
                `
            <tr>
                <td>${Obj.concentration}</td>
                <td>${Obj.volume}</td>
                <td>${Obj.all_content}</td>
                <td>${Obj.all_drop}</td>
                <td>${Obj.one_drop_content}</td>
                <td>${Obj.one_drop_price}</td>
            </tr>
                `
        };
        const outputArea = document.getElementById('outputArea');
        outputArea.innerHTML = outText;

        const personalProducts = Objs.filter(x => {
            return personalDoseJson / x.one_drop_content <= 3 && 2 <= personalDoseJson / x.one_drop_content;
        });

        //パーソナルな商品エリア
        console.log(personalProducts);
        let recommendOutText = '';
        for (personalProduct of personalProducts) {
            recommendOutText +=
                `
            <tr>
                <td>${personalProduct.concentration}</td>
                <td>${personalProduct.volume}</td>
                <td>${personalProduct.all_content}</td>
                <td>${personalProduct.all_drop}</td>
                <td>${personalProduct.one_drop_content}</td>
                <td>${personalProduct.one_drop_price}</td>
            </tr>
                `
        };
        const recommend_products = document.getElementById('recommend_products');
        recommend_products.innerHTML = recommendOutText;
    </script>

    <style>
        .all_products {
            margin: 5% 5%;
        }

        .recommend_products {
            margin: 5% 5%;
        }

        .cbd_Que_form {
            margin: 5% 25%;
        }

        .text {
            text-align: center;
            border: 1px solid black;
            padding: 1rem;
        }

        .btnx-outline-lime {
            color: #827717;
            background: var(--bs-white);
            border: 2px solid #C5E1A5;
        }

        .btnx-outline-lime:hover {
            background-color: #C5E1A5;
        }

        img {
            max-width: 60px;
        }
    </style>
</body>

</html>