<?php
class Team {
    private $id;
    private $name;
    private $yearFoundation;
    private $league;
    private $stadium;
    private $coach;

    private $players=[];//valeur initial tableau vide

    private $pdo;//utile pour la communication avec la base de donnée

    function __construct($name, $yearFoundation, $league,$stadium,$coach){

    $this->name= $name;
    $this->yearFoundation=$yearFoundation;
    $this->league= $league;
    $this->stadium= $stadium;
    $this->coach= $coach;

    //injection de dépendance (DI)
    //instantiation d'une classe A dans le constructeur d'une classe B

    try{
        $this->pdo=new PDO('mysql:host=localhost;dbname=poo', 'root','');
    }
    catch(PDOException $e)
    {
        var_dump($e);
    }

    }

    //getters (accesseurs) c'est pour pouvoir lire

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }

    public function getYearFoundation(){
        return $this->yearFoundation;
    }

    public function getLeague(){
        return $this->league;
    }

    public function getStadium(){
        return $this->stadium;
    }

    public function getCoach(){
        return $this->coach;
    }
    public function getPlayers(){
        return $this->players;
    }


    //setters (mutateurs) Ecriture

    public function setId($id){
        $this->id=$id;//met à jour la propriété
        return $this->id;//retour falcultatif
    }

    public function setName($name){
        $this->name=$name;//met à jour la propriété
        return $this->name;//retour falcultatif
    }

    public function setYearFoundation($yearFoundation){
        $this->yearFoundation=$yearFoundation;
        return $this->yearFoundation;
    }

    public function setLeague($league){
        $this->league=$league;
        return $this->league;
    }

    public function setStadium($stadium){
        $this->stadium=$stadium;
        return $this->stadium;
    }

    public function setCoach($coach){
        $this->coach=$coach;
        return $this->coach;
    }

    public function addPlayer(Player $player){
      //push de l'objet dans le tableau
        $this->players[]=$player;
    }
    public function save(){
        //enregistrement en base de données

        $result= $this->pdo->prepare(
            'INSERT INTO team(name,yearFoundation,league,stadium,coach) VALUES(:name,:yearFoundation,:league,:stadium,:coach)');

        $result->bindParam(':name',$this->name);
        $result->bindParam(':yearFoundation',$this->yearFoundation);
        $result->bindParam(':league',$this->league);
        $result->bindParam(':stadium',$this->stadium);
        $result->bindParam(':coach',$this->coach);

        return $result->execute();//execute la requete sql est revoi true si réussie
    }

    public function update(){
      $query=$this->pdo->prepare('UPDATE team
        SET name = :name,
         yearFoundation = :yearFoundation,
         league = :league,
         stadium = :stadium,
         coach = :coach
         WHERE id = :id');

         return $query->execute([
           'name'=>$this->name,
           'yearFoundation'=>$this->yearFoundation,
           'league'=>$this->league,
           'stadium'=>$this->stadium,
           'coach'=>$this->coach,
           'id'=>$this->id
         ]);
    }
      public function delete(){
        $query=$this->pdo->prepare(' DELETE  FROM team WHERE id= :id');
        return $query->execute(['id'=>$this->id]);

      }
}

?>
