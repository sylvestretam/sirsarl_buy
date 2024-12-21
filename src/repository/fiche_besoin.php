<?php

    require_once("src/model/fiche_besoin.php");

    class FicheBesoinRepository
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
                    "SELECT * FROM ACH_fiche_besoin WHERE statut_departement = 'VALIDER' AND statut_md = 'VALIDER'"
                );


                $statement->execute();
                
                $fiches = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fiche = new FicheBesoin();
                    $fiche->fiche_id = $row['fiche_id'];
                    $fiche->date_fiche = $row['date_fiche'];
                    $fiche->nature = $row['nature'];
                    $fiche->description = $row['description'];
                    $fiche->emmetteur = $row['emmetteur'];
                    $fiche->departement = $row['departement'];
                    $fiche->adresse_fichier = $row['adresse_fichier'];
                    $fiche->statut_departement = $row['statut_departement'];
                    $fiche->statut_md = $row['statut_md'];
                    $fiche->uuid = $row['uuid'];
                    
                    $fiches[] = $fiche;
                }
                
                return $fiches;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function getBesoinEmployee($matricule)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ACH_fiche_besoin WHERE emmetteur = :matricule"
                );

                $statement->bindParam(':matricule',$matricule);
                
                $statement->execute();
                
                $fiches = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fiche = new FicheBesoin();
                    $fiche->fiche_id = $row['fiche_id'];
                    $fiche->date_fiche = $row['date_fiche'];
                    $fiche->nature = $row['nature'];
                    $fiche->description = $row['description'];
                    $fiche->emmetteur = $row['emmetteur'];
                    $fiche->departement = $row['departement'];
                    $fiche->adresse_fichier = $row['adresse_fichier'];
                    $fiche->statut_departement = $row['statut_departement'];
                    $fiche->statut_md = $row['statut_md'];
                    $fiche->uuid = $row['uuid'];
                    
                    $fiches[] = $fiche;
                }
                
                return $fiches;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }
        
        public function getTODAYAll()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ACH_fiche_besoin WHERE date_fiche = :today"
                );

                $today = date("Y-m-d");
                $statement->bindParam(':today',$today);

                $statement->execute();
                
                $fiches = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fiche = new FicheBesoin();
                    $fiche->fiche_id = $row['fiche_id'];
                    
                    $fiches[] = $fiche;
                }
                
                return $fiches;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function getBesoinAValiderDEP($matricule)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ACH_fiche_besoin WHERE departement IN ( SELECT departement FROM ACH_valideur_besoin WHERE employee = :matricule )"
                );

                $statement->bindParam(':matricule',$matricule);
                
                $statement->execute();
                
                $fiches = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fiche = new FicheBesoin();
                    $fiche->fiche_id = $row['fiche_id'];
                    $fiche->date_fiche = $row['date_fiche'];
                    $fiche->nature = $row['nature'];
                    $fiche->description = $row['description'];
                    $fiche->emmetteur = $row['emmetteur'];
                    $fiche->departement = $row['departement'];
                    $fiche->adresse_fichier = $row['adresse_fichier'];
                    $fiche->statut_departement = $row['statut_departement'];
                    $fiche->statut_md = $row['statut_md'];
                    $fiche->uuid = $row['uuid'];
                    
                    $fiches[] = $fiche;
                }
                
                return $fiches;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function getBesoinAValiderMD($matricule)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ACH_fiche_besoin WHERE statut_departement = 'VALIDER'"
                );
                
                $statement->execute();
                
                $fiches = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fiche = new FicheBesoin();
                    $fiche->fiche_id = $row['fiche_id'];
                    $fiche->date_fiche = $row['date_fiche'];
                    $fiche->nature = $row['nature'];
                    $fiche->description = $row['description'];
                    $fiche->emmetteur = $row['emmetteur'];
                    $fiche->departement = $row['departement'];
                    $fiche->adresse_fichier = $row['adresse_fichier'];
                    $fiche->statut_departement = $row['statut_departement'];
                    $fiche->statut_md = $row['statut_md'];
                    $fiche->uuid = $row['uuid'];
                    
                    $fiches[] = $fiche;
                }
                
                return $fiches;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($fiche)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_fiche_besoin(fiche_id,date_fiche,nature,description,emmetteur,departement,adresse_fichier) 
                    VALUES(:fiche_id,:date_fiche,:nature,:description,:emmetteur,:departement,:adresse_fichier)"
                );

                $statement->bindParam(':fiche_id',$fiche->fiche_id);
                $statement->bindParam(':date_fiche',$fiche->date_fiche);
                $statement->bindParam(':nature',$fiche->nature);
                $statement->bindParam(':description',$fiche->description);
                $statement->bindParam(':emmetteur',$fiche->emmetteur);
                $statement->bindParam(':departement',$fiche->departement);
                $statement->bindParam(':adresse_fichier',$fiche->adresse_fichier);

                $statement->execute();
                                
                return $fiche;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($fiche)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_fiche_besoin SET date_fiche = :date_fiche, nature = :nature, 
                    description = :description, departement = :departement   
                    WHERE fiche_id = :fiche_id"
                );

                $statement->bindParam(':fiche_id',$fiche->fiche_id);
                $statement->bindParam(':date_fiche',$fiche->date_fiche);
                $statement->bindParam(':nature',$fiche->nature);
                $statement->bindParam(':description',$fiche->description);
                $statement->bindParam(':departement',$fiche->departement);

                $statement->execute();
                                
                return $fiche;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateStatutDEP($fiche)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_fiche_besoin SET statut_departement = :statut, statut_departement_by = :statut_by WHERE fiche_id = :fiche_id"
                );

                $statement->bindParam(':fiche_id',$fiche->fiche_id);
                $statement->bindParam(':statut',$fiche->statut_departement);
                $statement->bindParam(':statut_by',$fiche->statut_departement_by);

                $statement->execute();
                                
                return $fiche;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateStatutMD($fiche)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_fiche_besoin SET statut_md = :statut, statut_departement_by = :statut_by WHERE fiche_id = :fiche_id"
                );

                $statement->bindParam(':fiche_id',$fiche->fiche_id);
                $statement->bindParam(':statut',$fiche->statut_md);
                $statement->bindParam(':statut_by',$fiche->statut_md_by);

                $statement->execute();
                                
                return $fiche;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($fiche)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_fiche_besoin WHERE fiche_id = :fiche_id"
                );

                $statement->bindParam(':fiche_id',$fiche->fiche_id);

                $statement->execute();
                                
                return $fiche;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }