<?php

    require_once("src/model/compte.php");

    class CompteRepository
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
                    "SELECT * FROM ENT_compte"
                );


                $statement->execute();
                
                $comptes = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $compte = new Compte();
                    $compte->numero = $row['numero'];
                    $compte->designation = $row['designation'];
                    $compte->classe = $row['classe'];
                    
                    $comptes[] = $compte;
                }
                
                return $comptes;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($compte)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ENT_compte(numero,designation) 
                    VALUES(:numero,:designation)"
                );

                $statement->bindParam(':numero',$compte->numero);
                $statement->bindParam(':designation',$compte->designation);

                $statement->execute();
                                
                return $compte;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($compte)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ENT_compte SET designation = :designation 
                    WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$compte->numero);
                $statement->bindParam(':designation',$compte->designation);

                $statement->execute();
                                
                return $compte;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($compte)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ENT_compte WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$compte->numero);

                $statement->execute();
                                
                return $compte;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }