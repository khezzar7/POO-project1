  <?php
  require_once '../classes/TeamManager.php';
  $tm = new TeamManager();

  $id = intval($_GET['id']);//permet de convertir la valeur en entier num de la chaîne
  //version1
  //$team = $tm-> findById($id);
  //version 2
  $team=$tm->findByIdJoin($id);
  //var_dump($team);
$teamSameLeague =
 $tm ->findByLeague($team->getLeague());
  ?>
<!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include 'css.inc.php' ?>
  </head>
  <body>
      <?php include 'menu.inc.php'?>
    <h1>Equipe:<?php echo $team->getName();?></h1>
    <h2>Coach:</h2>
    <p><?php echo $team->getCoach();?></p>
    <h3>League:<?php echo $team->getLeague();?></h3>


    <h3>Enregistrement d'un joueur </h3>
    <form id="playerForm" method="post">
      <input id="team_id" type="hidden" name="" value="<?php  echo $team->getId();?>">
      <input id="name" type="text" placeholder="Nom">
      <select id="position" >
        <option>Gardien</option>
        <option>Défenseur</option>
        <option>Milieu</option>
        <option>Attaquant</option>
      </select>
      <input id="submit"type="submit" value="Enregistrer">
    </form>
    <!--Affichage des joueurs-->
    <?php if(sizeof($team->getPlayers()) > 0):?>
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <table id="playersTable"class="table table-striped table-bordered">
              <tr>
                <thead class="bg-primary">
                  <th>Nom:</th>
                  <th>Position:</th>
                  <th>Actions</th>
                </thead>
              </tr>
              <tbody>

                <?php foreach ($team->getPlayers() as $player):?>
                  <tr>
                    <td><?php echo $player->getName();?></td>
                    <td><?php  echo $player->getPosition();?></td>
                    <td>
                      <button data-id="<?php echo $player->getId();?>" class="btnEdit btn btn-warning btn-sm">Editer</button>
                      <button data-id="<?php echo $player->getId();?>" class="btnDelete btn btn-danger btn-sm">Supprimer</button>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
            <?php endif; ?>

          </div>
          <div class="col-md-3">
            <h4>Equipe du même championnat</h4>
            <ul>



                
                  <?php foreach ($teamSameLeague as $t) {
                  if($t->getId() != $team->getId()){
                    echo '<li><a href="team_detail.php?id='.$t->getId().'">'.$t->getName().'</a></li>';
                  }
                  }?>




            </ul>
          </div>
        </div>

      </div>

    <script src="js/app.js"></script>
  </body>
</html>
