<?php
session_start();
if(isset($_POST['todo_text'])){
    $_SESSION['todo'][] = $_POST['todo_text'];
    header("Location: /to-do-app/", true,301); 
    die();
}
if(isset($_POST['check'])){
    if(isset($_SESSION['todo'][$_POST['check']])){
        $to_check = $_SESSION['todo'][$_POST['check']];
        $_SESSION['completed'][] = $to_check;
        unset($_SESSION['todo'][$_POST['check']]);
    }
    header("Location: /to-do-app/", true,301);
    die();
}
if(isset($_POST['reset'])){
    session_destroy();
    $_SESSION = array();
    header("Location: /to-do-app/", true, 301);
    die();
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App - My First PHP App!</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <h1>To-Do App</h1>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <div class="callout">
            <h3>My First PHP App</h3>
            <p>Simple and Fast <code>PHP</code> To-Do App in just 100 Lines of Code 😆!</p>
            <div class="large-12 cell">
                <form action="" method="POST">
                    <input type="text" name="todo_text" placeholder="Add Elemento to TO-DO List">
                    <input type="submit" value="Add" class="success button" style="width: 100%;">
                </form>
            </div>
            <hr>
            <div class="grid-x grid-padding-x">
              <div class="large-12 medium-12 cell">
                <p><a href="#">To-Do:</a></p>
                <?php
                if(isset($_SESSION['todo'])){
                ?>
                    <form action="" method="POST">
                    <?php
                    foreach ($_SESSION['todo'] as $num => $todo) {
                    ?>
                        <input onclick="setTimeout(()=>{ return submit()}, 300);"  type="checkbox" name="check" value="<?=$num?>"> <?=$todo?>
                        <br>
                    <?php
                    }
                    ?>
                    </form>
                <?php
                }else{
                ?>
                  <p>No Element on To-Do List.</p>
                <?php
                }
                ?>
              </div>
            </div>
            <hr>
            <div class="grid-x grid-padding-x">
              <div class="large-12 medium-12 medium-push-2 cell">
                <a href="#">Done:</a><br />
                <?php
                if(isset($_SESSION['completed'])){
                ?> 
                  <ul> 
                    <?php
                    foreach ($_SESSION['completed'] as $num => $todo) { ?>
                      <li><?=$todo?></li>
                    <?php
                    }
                    ?>
                  </ul>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="reset" value="1">
                    <input type="submit" value="Reset" class="alert button" style="width: 100%;">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="position: fixed; bottom:0">© <?=date("Y")?> - Powered by <a href="https://andreapavone.com/">Andrea Pavone</a></div> 
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
