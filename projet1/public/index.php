<?php
    //coter SERVER
    require_once '../classes/TeamManager.php';
    $tm = new TeamManager();
    $teams= $tm->findAll();//renvoi un tableau d'objets Team
    //var_dump($teams);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POO projet-1</title>
    <?php include 'css.inc.php' ?>
</head>
<body>
    <?php include 'menu.inc.php'?>
    <h1>POO projet-1</h1>
    <h2>Enregistrement d'une equipe</h2>
    <form action="../process_team.php" method="post">
    <div>
        <input type="text" name="name" placeholder="Nom de l'équipe">
    </div><br>
    <div>
        <input type="text" name="yearFoundation" placeholder="Année de création">
    </div><br>
    <div>
        <input type="text" name="league" placeholder="Championnat">
    </div><br>
    <div>
        <input type="text" name="stadium" placeholder="Stade">
    </div><br>
        <div>
        <input type="text" name="coach" placeholder="Entraineur">
    </div><br>
    <div>
        <input type="submit" name="submit" value="Enregistrer">
    </div>

    </form>
    <!-- Afficher tableau des équipes -->
    <table class="table table-striped table-bordered">
    <thead class="bg-primary">
    <tr>
    <th>Nom</th>
    <th>Année de fondation</th>
    <th>Championnat</th>
    <th>Stade</th>
    <th>Entraineur</th>
    <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    //DOM dynamique
    $html="";
    foreach($teams as $team)
    {
       $html .= '<tr>';
       $html.= '<td><a href="team_detail.php?id='.$team->getId().'">'.$team->getName().'</a></td>';
       $html.= '<td>'.$team->getYearFoundation().'</td>';
       $html.= '<td>'.$team->getLeague().'</td>';
       $html.= '<td>'.$team->getStadium().'</td>';
       $html.= '<td>'.$team->getCoach().'</td>';
       $html.=  '<td>';
       $html.=  '<a class="btn btn-warning btn-sm"href="team_update.php?id='.$team->getId().'">Editer</a>';

       $html.=  '<a class="btn btn-danger btn-sm"href="team_delete.php?id='.$team->getId().'">Supprimer</a>';
       $html.=  '</td>';
       $html .= '</tr>';

    }
    //Sortie de boucle on fait afficher les données par:
    echo $html;

    ?>

    </tbody>
    </table>

        <footer>
          <?php include 'menu.inc.php'?>
        </footer>

</body>
</html>
