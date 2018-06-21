<?php require_once '../functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Todo Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style>
    body {
      background: #EEE;
    }
    .todo__no__space{
      padding-left: 0px;
      padding-right: 0px;
    }
  </style>
  <?php  $user = 'abiodun@hotels.ng';?>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

</nav>

  <div class="col-md-5 col-md-offset-3" style="background: #FFF;padding: 10px">
      <h2>Todo List</h2>
    <form method="POST">
           <input type="text" class="form-control" required>
        <p></p>
        <button name="btnadd" class="btn btn-primary btn-lg"> Submit </button>

        <?php
          if(isset($_POST['btnadd'])):
              $title = $_POST['title'];
              $query = $pdo->prepare('SELECT * FROM todos WHERE title =? AND user_id=?');
              $query->execute([$title, $user]);
              if( $query->rowCount() > 0 ):
          ?>
                <div class="alert alert-info">Todo Already exist</div>
          <?php
              else:
                $save = $pdo->prepare('INSERT INTO todos(user_id,title, completed) VALUES(?, ?, ?)');
                $save->execute([$user, $title, '0']);
          ?>
          <div class="alert alert-success">Todo Added Successfully ! <a href="add.php" class="pull-right">close</a></div>
          <?php
              endif;
            endif
        ?>
    </form>
  </div>
</body>
</html>