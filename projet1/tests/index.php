<?php
require_once '../classes/Team.php';
require_once '../classes/TeamManager.php';
require_once '../classes/Player.php';



$t = new Team(
    'PSG',
    1970,
    'Ligue 1',
    'Parc des Princes',
    'Tomas Tuchel'
   );
   $t->setId(6);
// var_dump($t->save());// Permet de voir en détail.

 //echo $t->getStadium();

// echo $t->getCoach();

//Team::list();
$tm = new TeamManager();

//var_dump($tm->findAll());
//prendre un id existant!!!
//var_dump($tm->findById(5));

//$player = new Player('Dybala', 'Milieu',$t);
//var_dump($player->save());

$message= array(
  'message'=>'coucou', 
'test'=> true);//un tableau associatif
echo json_encode($message);//pour renvoyer un codage a un client



?>
