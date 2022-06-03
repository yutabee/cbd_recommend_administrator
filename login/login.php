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
  <title>ログイン</title>
</head>

<body>
  <?php
  session_start();
  // var_dump($_SESSION);
  // exit();
  $login = "";
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
    $login = '<a href="login.php">LOGIN</a>';
  } else {
    $login = '<a href="logout.php">LOGOUT</a>';
  }
  ?>

  <header>
    <h1>
      <a href="../input.php">CBD RECOMMEND</a>
    </h1>
    <nav class="pc-nav">
      <ul>
        <li><a href="../contact/contact_input.php">CONTACT</a></li>
        <li><?= $login ?></li>
      </ul>
    </nav>
  </header>
  <div class='login-form'>
    <p class="fs-2">ログイン</p>
    <form action="login_act.php" method="POST">
      <fieldset>
        <div class="mb-3">
          <label for="username" class="form-label">名前</label>
          <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">パスワード</label>
          <input type="text" class="form-control" id="password" name="password">
        </div>
        <div>
          <button type="submit" class="btn btn-primary btnx-outline-lime">ログイン</button>
        </div>
        <a href="login_register.php">新規登録はこちら</a>
      </fieldset>
    </form>
  </div>

  <style>
    .login-form {
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