<?php
require_once '../classes/TeamManager.php';
$id = intval($_GET['id']);
$tm = new TeamManager();
$team = $tm->findById($id);
if($team->delete()){
  header('location:index.php');
}else {
  echo'<div class=bg-danger">Erreur dans la suppresion</div>';
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include 'css.inc.php' ?>
  </head>
  <?php include 'menu.inc.php'?>
  <body>
    <h1>Suppression:<?php echo $team->getName();?></h1>


        <form action="" method="post">
        <div>
            <input type="text" name="name" placeholder="Nom de l'équipe" value="<?php echo $team->getName(); ?>">
        </div><br>
        <div>
            <input type="text" name="yearFoundation" placeholder="Année de création" value="<?php echo $team->getYearFoundation(); ?>">
        </div><br>
        <div>
            <input type="text" name="league" placeholder="Championnat" value="<?php echo $team->getLeague(); ?>">
        </div><br>
        <div>
            <input type="text" name="stadium" placeholder="Stade" value="<?php echo $team->getStadium(); ?>">
        </div><br>
            <div>
            <input type="text" name="coach" placeholder="Entraineur" value="<?php echo $team->getCoach(); ?>">
        </div><br>
        <div>
            <input type="submit" name="submit" value="supression">
        </div>

        </form>
  </body>
</html>
