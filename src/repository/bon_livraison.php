<?php

    require_once("src/model/bon_livraison.php");

    class BonLivraisonRepository
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
                    "SELECT * FROM ACH_bon_livraison"
                );


                $statement->execute();
                
                $bon_livraisons = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $bon_livraison = new BonLivraison();
                    $bon_livraison->numero = $row['numero'];
                    $bon_livraison->date_livraison = $row['date_livraison'];
                    $bon_livraison->date_emmission = $row['date_emmission'];
                    $bon_livraison->bon_commande = $row['bon_commande'];
                    $bon_livraison->adresse_fichier = $row['adresse_fichier'];
                    $bon_livraison->statut_execution = $row['statut_execution'];
                    $bon_livraison->statut_commande = $row['statut_commande'];
                    $bon_livraison->emmetteur = $row['emmetteur'];
                    $bon_livraison->type = $row['type'];
                    
                    $bon_livraisons[] = $bon_livraison;
                }
                
                return $bon_livraisons;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($bon_livraison)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_bon_livraison(numero,date_livraison,date_emmission,bon_commande,adresse_fichier,statut_execution,statut_commande,emmetteur,type) 
                    VALUES(:numero,:date_livraison,:date_emmission,:bon_commande,:adresse_fichier,:statut_execution,:statut_commande,:emmetteur,:type)"
                );

                $statement->bindParam(':numero',$bon_livraison->numero);
                $statement->bindParam(':date_livraison',$bon_livraison->date_livraison);
                $statement->bindParam(':date_emmission',$bon_livraison->date_emmission);
                $statement->bindParam(':bon_commande',$bon_livraison->bon_commande);
                $statement->bindParam(':adresse_fichier',$bon_livraison->adresse_fichier);
                $statement->bindParam(':statut_execution',$bon_livraison->statut_execution);
                $statement->bindParam(':statut_commande',$bon_livraison->statut_commande);
                $statement->bindParam(':type',$bon_livraison->type);
                $statement->bindParam(':emmetteur',$bon_livraison->emmetteur);

                $statement->execute();
                                
                return $bon_livraison;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($bon_livraison)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_bon_livraison SET date_livraison = :date_livraison,bon_commande = :bon_commande, 
                    adresse_fichier = :adresse_fichier, statut = :statut 
                    WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$bon_livraison->numero);
                $statement->bindParam(':date_livraison',$bon_livraison->date_livraison);
                $statement->bindParam(':bon_commande',$bon_livraison->bon_commande);
                $statement->bindParam(':adresse_fichier',$bon_livraison->adresse_fichier);
                $statement->bindParam(':statut',$bon_livraison->statut);

                $statement->execute();
                                
                return $bon_livraison;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateStatutExecution($bon_livraison)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_bon_livraison SET statut_execution = :statut 
                    WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$bon_livraison->numero);
                $statement->bindParam(':statut',$bon_livraison->statut_execution);

                $statement->execute();
                                
                return $bon_livraison;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($bon_livraison)
        {
            try{
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_bon_livraison WHERE bon_livraison = :numero"
                );
                
                $statement->bindParam(':numero',$bon_livraison->numero);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_bon_livraison WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$bon_livraison->numero);

                $statement->execute();
                                
                return $bon_livraison;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }