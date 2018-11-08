<?php
  require_once '../classes/TeamManager.php';
  $id = intval($_GET['id']);
  $tm = new TeamManager();
  $team = $tm->findById($id);
  //verif
//  var_dump($team);
if(isset($_POST['submit'])){
  //mise a jour de l'équipes
  //l'utilisateur a cliqué sur le submit->une requete post à été envoyée au server
  $team->setName($_POST['name']);
  $team->setYearFoundation($_POST['yearFoundation']);
  $team->setLeague($_POST['league']);
  $team->setStadium($_POST['stadium']);
  $team->setCoach($_POST['coach']);

  if($team->update()){
    //succès redirection
    header('location:index.php');
  }else {
    echo '<div class="bg-danger">La mise a jour a échoué!!</div>';
  }
  //var_dump($team);

  //echo 'MAJ';
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include 'css.inc.php' ;?>
  </head>
  <body>
    <?php include 'menu.inc.php' ;?>
    <h2>Modification de: <?php echo $team->getName(); ?></h2>
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
        <input type="submit" name="submit" value="Mettre a jour">
    </div>

    </form>

  </body>
</html>
