<?php
require_once '../classes/PlayerManager.php';

$pm = new PlayerManager();
$players = $pm->findAll();
//var_dump($players);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include 'css.inc.php';?>
  </head>
  <body>
    <?php include 'menu.inc.php'?>
    <div class="container">
      <div class="row">
        <h1>Listes des joueurs: (<?php echo sizeof($players);?> joueur(s))</h1>
        <div class="col-6">
          <table class="table table-striped table-bordred ">
            <tr>
              <thead>
                <th>Nom:</th>
                <th>Position:</th>
                <th>Team:</th>

              </thead>
            </tr>
            <tbody>

              <?php foreach ($players as $player):?>
                <tr>
                <td><?php echo $player->getName();?></td>
                <td><?php echo $player->getPosition();?></td>
                <td>
                  <?php if($player->getTeam()===null){
                  echo'Sans équipe';
                }else {
                  echo $player->getTeam()->getName();
                }?></td>
              </tr>
              <?php endforeach ?>

            </tbody>
          </table>
        </div>
      </div>

    </div>


    <?php include 'menu.inc.php'?>
  </body>
</html>
