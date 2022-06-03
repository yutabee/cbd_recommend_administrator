<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/footer.css">
  <title>ContactForm</title>
</head>

<body>
  <?php
  session_start();
  // var_dump($_SESSION);
  // exit();
  $login = "";
  $contactList = "";
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
    $login = '<a href="../login/login.php">LOGIN</a>';
  } else {
    $login = '<a href="../login/logout.php">LOGOUT</a>';
    if ($_SESSION["is_admin"] == 1) {
      $contactList = ' <a href="contact_read.php">お問い合わせ内容一覧</a>';
    }
  }


  ?>

  <header>
    <h1>
      <a href="../input.php">CBD RECOMMEND</a>
    </h1>
    <nav class="pc-nav">
      <ul>
        <li><?= $login ?></li>
      </ul>
    </nav>
  </header>
  <main>

    <div class='contact-form'>
      <div><?= $contactList ?></div>
      <p class="fs-2">CONTACT</p>
      <form action='insert.php' method='POST'>
        <fieldset>
          <div class="mb-3">
            <label for="your_name" class="form-label">name</label>
            <input type="text" class="form-control" id="your_name" name="your_name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">mail address</label>
            <input type="email" class="form-control" id="email" name='email'>
          </div>
          <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input type="text" class="form-control" id="title" name='title'>
          </div>
          <div class="mb-3">
            <label for="contact" class="faorm-label">contact</label>
            <textarea class="form-control" id="contact" rows="3" name='contact'></textarea>
          </div>
          <button type="submit" class="btn btn-primary btnx-outline-lime">submit</button>
        </fieldset>
      </form>
    </div>
  </main>

  <style>
    .contact-form {
      margin: 10% 20%;
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