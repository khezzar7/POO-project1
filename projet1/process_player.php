<?php
require_once 'classes/Player.php';
require_once 'classes/TeamManager.php';
//echo 'hello';
//$method = $_SERVER['REQUEST_METHOD'];
//echo json_encode(array('method'=>$method));//native php convertisseur comme en js
//Probleme le super Global POST est vide dans le cas d'une reqête
//ajax
//SOLUTION: file_get_contents("http://input").(renvoi une chaîne de cara = corps de la requête POST)
//recevoir les donées postées via Ajax(api fetch)
//https://codepen.io/dericksozo/post/fetch-api-json-php
 $request_body = file_get_contents("php://input");
// echo $request_body;
$playerObj = json_decode($request_body);//renvoi un objet (renvoi un tableau associatif si le deuxieme argument et par defaut true )

//pour récupérer l'id pour associer au joueur
$tm = new TeamManager();
$team = $tm->findById(intval($playerObj->team_id));

$player = new Player(
  $playerObj->name,
  $playerObj->position,
  $playerObj->league;
  $team
);

echo $player->save();//renvoi l'id du dernier joueur enregistrer


?>
