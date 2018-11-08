<?php

require_once 'Team.php';
require_once 'Player.php';

class TeamManager{
    private $pdo = null;

    function __construct(){
        $this->connexion();//DI
    }


    private function connexion(){
        try{
            $this->pdo=new PDO('mysql:host=localhost;dbname=poo', 'root','');

        }catch(PDOException $e){

            var_dump($e);
        }

    }
    public function findAll(){
        //Vérification qu'on ait pas déjà connecter à la BD
        //devient inutile car il y a la DI
        //if($this->pdo == null){
         //   $this->connexion();
       // }

        $query = $this->pdo->prepare('SELECT * FROM team');

        $query->execute();

        $resultats = $query->fetchAll(PDO::FETCH_OBJ);

        $teams = [];

        foreach($resultats as $resultat) {

            $team = new Team(
                $resultat->name, $resultat->yearFoundation, $resultat->league,
                $resultat->stadium, $resultat->coach);

                $team->setId($resultat->id);//On ajoute l'id à l'objet de maniere
                //que cette info soit disponible dans l'application
             array_push($teams, $team);
        }
        return $teams;
    }
    public function findById($id)//$id est la propriété
    {

        $query= $this->pdo->prepare('SELECT * FROM team WHERE id = :id');

        //$query->bindParam(':id',$id);
        // façon de faire le bindParam
        //echo $id;
        $query->execute(array(':id'=>$id));
        //on va mnt déterminer comment recevoir les données (en tableau associatif, numérique ou objet);
        $resultat= $query->fetch(PDO::FETCH_OBJ);
        //fetch renvoi false quand aucun résultat n'est trouvé
        //var_dump($resultat);

        //condition si l'id recherché n'existe pas en BD
        //findById renvoi null
        if(!$resultat){
          return null;
        }

        $team= new Team($resultat->name, $resultat->yearFoundation, $resultat->league,
        $resultat->stadium, $resultat->coach);

        $team->setId(intval($resultat->id));

        return $team;

    }

    public function findByIdJoin($id){
      $query=$this->pdo->prepare('SELECT team.id AS teamId,
        team.name AS teamName,
        yearFoundation, league, stadium, coach, player.id AS playerId, player.name AS playerName, position, team_id FROM team
        LEFT JOIN player ON player.team_id = team.id WHERE team.id = :id');
        $query->execute([':id'=>intval($id)]);
        $rows = $query->fetchAll(PDO::FETCH_OBJ);


        //var_dump($rows); //pour voir si sa fonctionne dans team_detail.php
        // on recupère les données de l'équipe
        //afin de créer un objet Team et de lui fournir une
        //partie des données
        $team = new Team(
          $rows[0]->teamName,
          $rows[0]->yearFoundation,
          $rows[0]->league,
          $rows[0]->stadium,
          $rows[0]->coach

        );

        $team->setId($rows[0]->teamId);
      //  var_dump($team);
      //ajout des joueurs à l'objet Team
       foreach ($rows as $row) {
         //on ajoute le joueur dans le tableau que si la propriété Nom
         // n'est pas null
         if($row->playerName != null){
           $player= new Player($row->playerName,$row->position);
           $player->setId(intval($row->playerId));
           $team->addPlayer($player);
         }
       }
       return $team;
    }

    public function findByLeague($league){
      $query=$this->pdo->prepare('SELECT * FROM team WHERE league = :league');
      $query->execute([':league'=>$league]);
      $rows=$query->fetchAll(PDO::FETCH_OBJ);
      //var_dump($rows);
      $teams=[];
      foreach ($rows as $row) {
        $team = new Team(
          $row->name,
          $row->yearFoundation,
          $row->league,
          $row->stadium,
          $row->coach
        );
          $team->setId($row->id);
          $teams[]=$team;//push
      }//fin foreach
      return $teams;
      }


}//fin de la classe

?>
