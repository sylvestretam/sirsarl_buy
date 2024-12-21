<?php

    require_once("src/model/exercice.php");

    class ExerciceRepository
    {
        private $dbconnect;

        public function __construct($dbconnect)
        {
            $this->dbconnect = $dbconnect;
        }

        public function getAll()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ENT_exercice"
                );


                $statement->execute();
                
                $exercices = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $exercice = new Exercice();
                    $exercice->exercice_id = $row['exercice_id'];
                    $exercice->date_debut = $row['date_debut'];
                    $exercice->date_fin = $row['date_fin'];

                    $exercices[] = $exercice;
                }
                
                return $exercices;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ENT_exercice(exercice_id,date_debut,date_fin) 
                    VALUES(:exercice_id,:date_debut,:date_fin)"
                );

                $statement->bindParam(':exercice_id',$exercice->exercice_id);
                $statement->bindParam(':date_debut',$exercice->date_debut);
                $statement->bindParam(':date_fin',$exercice->date_fin);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ENT_exercice 
                        SET date_debut = :date_debut,date_fin = :date_fin
                        WHERE exercice_id = :exercice_id"
                );

                $statement->bindParam(':exercice_id',$exercice->exercice_id);
                $statement->bindParam(':date_debut',$exercice->date_debut);
                $statement->bindParam(':date_fin',$exercice->date_fin);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ENT_exercice WHERE exercice_id = :exercice_id"
                );

                $statement->bindParam(':code',$exercice->code);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }