<?php
require_once(dirname(__FILE__).'/../utils/db.php');
require_once(dirname(__FILE__).'/../utils/config.php');

class Appointment
{
    private $id;
    private $dateHour;
    private $idPatients;
    private $db;

        public function __construct($id ="", $dateHour ="", $idPatients ="")
        {
            $this->id = $id;
            $this->dateHour = $dateHour;
            $this->idPatients = $idPatients;
            $this->db = Database::db_connect();
        }
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // CREATE RDV
    public function CreateRdv()
    {
        
        $sql = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)';
        
        // ajouter stmt ou sth a la place de req
        $sth = $this->db->prepare($sql);

        $sth->bindValue(':dateHour', $this->dateHour,PDO::PARAM_STR);
        $sth->bindValue(':idPatients', $this->idPatients,PDO::PARAM_INT);
        try {
            return $sth->execute();
        } catch (PDOException $ex) {
            return false;
        }
    }

//  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++       
    // READ ALL RDV
    public static function ReadAllRdv()
    {
        $sql = "SELECT `appointments`.`id`
                , `appointments`.`dateHour`,`patients`.`lastname`,`patients`.`firstname`,`patients`.`phone`,`patients`.`mail`
                FROM `appointments` INNER JOIN `patients`
                ON `appointments`.`idPatients` = `patients`.`id`";
                
        $db = Database::db_connect();
        $sth = $db->prepare($sql);

        try {
            if($sth->execute()) {
                // on return les données récupérées
                return $sth->fetchAll();
            }
        } catch (PDOException $ex) {
            return $ex;
        }
    }


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // READ ONE RDV
    public static function ReadOneRdv($id)
    {
        $sql = "SELECT `appointments`.`id`
                , `appointments`.`dateHour`,`patients`.`lastname`,`patients`.`firstname`,`patients`.`phone`,`patients`.`mail`,`patients`.`birthdate`
                FROM `appointments` LEFT JOIN `patients`
                ON `appointments`.`idPatients` = `patients`.`id`
                WHERE `appointments`.`id`=:id";

        $db = Database::db_connect();

        $sth = $db->prepare($sql);

        $sth->bindValue(':id',$id, PDO::PARAM_INT);

        try {
            if($sth->execute()) {
                // on return les données récupérées
                return $sth->fetch();
            }
        } catch (PDOException $ex) {
            return $ex;
        }
    }


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
    // UPDATE RDV
    public function updateRDV()
    {
        $sql = "UPDATE  `appointments` 
            SET `id`=:id, `dateHour`=:dateHour
            WHERE `id`=:id;";
        
        // ajouter stmt ou sth a la place de req
        $sth = $this->pdo->prepare($sql);

        $sth->bindValue(':id', $this->id,PDO::PARAM_INT);
        $sth->bindValue(':dateHour', $this->dateHour,PDO::PARAM_STR);
        try {
            $sth->execute();
            return 4;

        } catch (PDOException $ex) {
            return false;
        }
    }




}