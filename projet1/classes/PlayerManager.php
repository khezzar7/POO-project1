<?php

require_once 'TeamManager.php';
require_once 'Team.php';

require_once 'Player.php';

  class PlayerManager{

    private $id;
    private $name;
    private $position;

    private $pdo=null;

    function __construct(){
      $this->connexion();
    }
    private function connexion(){
        try{
            $this->pdo=new PDO('mysql:host=localhost;dbname=poo', 'root','');

        }catch(PDOException $e){

            var_dump($e);
        }

    }

    public function findAll(){

      $query=$this->pdo->prepare('SELECT * FROM player');

      $query->execute();


      $rows=$query->fetchAll(PDO::FETCH_OBJ);
      $tm = new TeamManager();
      $players=[];

      foreach ($rows as $row) {

        $team = $tm->findById($row->team_id);

        $player = new Player($row->name,$row->position,$row->league,$team);
        $player->setId($row->id);
        array_push($players,$player);//$players[] = $player;
      }
      return $players;
    }

    public function findById($id){
      $query=$this->pdo->prepare('SELECT * FROM player WHERE id= :id');
      $query->execute([':id'=>$id]);
      $row = $query->Fetch(PDO::FETCH_OBJ);
      //si il trouve pas l'id
      if(!$row) return null;

      $player = new Player($row->name, $row->position);
      $player->setId($row->id);
      return $player;

    }

    public function deleteById($id){
      $query=$this->pdo->prepare(
        'DELETE FROM player where id= :id');
        return $query->execute([':id'=>$id]);
        //pas besoin de fair un fetch
    }
  }
 ?>
