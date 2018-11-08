<?php
// traite la requte ajax de mise à jour du joueur
require_once '../classes/PlayerManager.php';
$request_body = file_get_contents('php://input');
$playerObj = json_decode($request_body);

$pm= new PlayerManager();
$player = $pm->findById(
  intval($playerObj->id)
);

//mise a jour de l'objet player
$player->setName($playerObj->name);
$player->setPosition($playerObj->position);

echo $player->update();
?>
