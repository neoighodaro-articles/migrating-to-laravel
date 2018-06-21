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
    <div class="pull-left">
      <h2>Todo List</h2>
    </div>
    <div class="pull-right">
      <a href="?rel=add" class="btn btn-info">Add New</a>
    </div>
    <div class="clearfix"></div>
    <?php


      if( isset($_GET['rel']) and $_GET['rel'] == 'add'):

      else:
    ?>
        <input type="text" class="form-control">
    <?php
      /**
       * delete
       */

      if( isset($_GET['rel']) and $_GET['id'] !='') {
        $query = $pdo->prepare('DELETE FROM todos WHERE id=?');
        $query->execute([$_GET['id']]);
      }
      $user = 'abiodun@hotels.ng';
      $query = $pdo->prepare('SELECT * FROM todos WHERE user_id=?');
      $query->execute([$user]);

      if( $query->rowCount() > 0 ):
    ?>
    <ul class="list-group">

     <?php while($fetch = $query->fetch()): ?>
      <li class="list-group-item">
        <div class="col-md-9 todo__no__space">
          <?php if( isset($_GET['rel']) and $_GET['rel'] == 'edit'): ?>
            <form method="POST">
              <input type="text" name="title" class="form-control" value="<?=$fetch['title']?>">
              <p></p>
              <button name="btnupdate" class="btn btn-primary btn-sm" type="submit">submit</button>
              <?php if(isset($_POST['btnupdate'])):
                $title = $_POST['title'];
                $sql = $pdo->prepare('UPDATE todos SET title = ? WHERE user_id=? AND id=?');
                $sql->execute([$title, $user, $fetch['id']]);
                header('location: home.php');
              endif ?>
            </form>
          <?php else: ?>
            <a href="?rel=more">
              <?php echo $fetch['title'] ?>
            </a>
          <?php endif ?>
        </div>
        <div class="col-md-3">
          <a href="?rel=edit">edit</a> &nbsp;
          <a href="?rel=delete&id=<?=$fetch['id']?>">delete</a> &nbsp;
          <a href="?rel=done">done</a>
        </div>
        <div class="clearfix"></div>
      </li>
      <?php endwhile ?>
    </ul>
    <?php else: ?>
        <p>No Todos Available </p>
   <?php endif ?>
    <?php endif; ?>
  </div>
</body>
</html>