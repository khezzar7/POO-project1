<?php
// traite la requte ajax de le suppression d'un joueur
require_once '../classes/PlayerManager.php';
$id= intval($_GET['id']);
$pm= new PlayerManager();

echo $pm->deleteById($id);
?>
