<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vanilla Todo App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <style>
    body {
      background: #EEE;
    }
  </style>
</head>
<body>
  <div class="rows">
    <div class="col-md-4 col-md-offset-6">
      <form method="POST">
        <h1> Login </h1>
        <label>Email Address</label>
        <input type="text" class="form-control" name="email" required>
        <label>Password</label>
        <input type="password" class="form-control" name="pass" required>
        <br>
        <button type="submit" name="btnLogin">Submit</button>

        <?php

          require_once 'functions.php';
          if( isset($_POST['btnLogin'])):
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $query = $pdo->prepare('SELECT * FROM users WHERE email = ? AND password=?');
            $query->execute([$email, $pass]);
            $rows = $query->rowCount();

            if( $rows > 0 ):
              header('location: pages/home.php');
            else: ?>
              <div class="alert alert-danger">
                <b> Invalid Information supplied</b>
              </div>
            <?php endif ?>
        <?php endif ?>
      </form>
    </div>
  </div>
</body>
</html>