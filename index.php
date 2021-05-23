<?php
session_start();

$errore = "Add Elemento to TO-DO List";
$errore_colore = "";
if(isset($_POST['todo_text'], $_POST['todo_date'])) {
    // TODO validare todo_text5

    $pattern = '/^[A-Za-z0-9!\s\'!-]+$/';
    $result_todo = preg_match($pattern, $_POST['todo_text']);
    if ($result_todo) {
        $_SESSION['todo'][] = $_POST['todo_text'];
        $_SESSION['todo_date'][] = $_POST['todo_date'];
        $_SESSION['todo_complete'] = array_combine($_SESSION['todo'], $_SESSION['todo_date']);
        header("Location: /to-do-app/", true, 301);
        die();
    } else {
        $errore = "caratteri speciali ammessi: ! ' -";
        $errore_colore = "errore";
    }
}


/*
if(isset($_POST['todo_text'])){
  //TODO validare todo_text
    $_SESSION['todo'][] = $_POST['todo_text'];
    header("Location: /to-do-app/", true,301); 
    die();
    

}
*/

if(isset($_POST['check'])){
    if(isset($_SESSION['todo_complete'][$_POST['check']])){
        $controllo = $_POST['check'];
        $to_check = $_SESSION['todo_complete'][[$_POST['check']]];
        $_SESSION['completed'][] = $to_check;
        unset($_SESSION['todo_complete'][$_POST['check']]);
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
    <title>To-Do App</title>
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
    
            <div class="large-12 cell">
                <form action="" method="POST">
                    <div style="display: flex;">
                      <input type="text" name="todo_text"  class= "<?=$errore_colore?>" placeholder="<?=$errore?>">
                      <input type="date" name="todo_date" value="2021-05-21" min="2021-05-21" max="2040-12-31">
                    </div>
                    
                    <input type="submit" value="Add" class="success button" style="width: 100%;">
            <p>Non dimenticare niente! Ti aiuta To-Do App</p>
            <div class="grid-x grid-padding-x">
              <div class="large-12 medium-12 cell">
                <p class="title">Cose da fare:</p>
                <?php
                if(isset($_SESSION['todo_complete'])){
                ?>
                    <form action="" method="POST">
                    <?php
                    $contatore = "0";
                    foreach($_SESSION['todo_complete'] as $num => $todo) {
                      

                    ?>
                        <input onclick="setTimeout(()=>{ return submit()}, 300);"  type="checkbox" name="check" value="<?=$contatore?>"> <?=$num?>  <?=$todo?>
                        <br>
                    <?php
                    echo $contatore;
                    echo $controllo;
                      $contatore++; 

                      
                    }
                    ?>
                    </form>
                <?php
                }else{
                ?>
                  <p>Non ci sono cose da fare</p>
                <?php
                }
                ?>
              </div>
            </div>
            <hr>
            <div class="grid-x grid-padding-x">
              <div class="large-12 medium-12 medium-push-2 cell">
              <p class="title">Cose fatte:</p><br/>
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
    <div style="position: fixed; bottom:10px; margin-top:10px; margin-left:20px;">© <?=date("Y")?> - Powered by <a href="https://andreapavone.com/">Andrea Pavone</a></div> 
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
