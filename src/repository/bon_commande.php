<?php

    require_once("src/model/bon_commande.php");

    class BonCommandeRepository
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
                    "SELECT * FROM ACH_bon_commande"
                );


                $statement->execute();
                
                $bon_commandes = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $bon_commande = new BonCommande();
                    $bon_commande->numero = $row['numero'];
                    $bon_commande->date_emmission = $row['date_emmission'];
                    $bon_commande->date_transmit = $row['date_transmit'];
                    $bon_commande->date_abort = $row['date_abort'];
                    $bon_commande->emmetteur = $row['emmetteur'];
                    $bon_commande->debours = $row['debours'];
                    $bon_commande->commission = $row['commission'];
                    $bon_commande->statut = $row['statut'];
                    $bon_commande->besoin = $row['besoin'];
                    $bon_commande->fournisseur = $row['fournisseur'];
                    $bon_commande->adresse_fichier = $row['adresse_fichier'];
                    
                    $bon_commandes[] = $bon_commande;
                }
                
                return $bon_commandes;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function getTODAYAll()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ACH_bon_commande WHERE date_emmission = :today"
                );

                $today = date("Y-m-d");
                $statement->bindParam(':today',$today);

                $statement->execute();
                
                $bon_commandes = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $bon_commande = new BonCommande();
                    $bon_commande->numero = $row['numero'];
                    
                    $bon_commandes[] = $bon_commande;
                }
                
                return $bon_commandes;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($bon_commande)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_bon_commande(numero,date_emmission,emmetteur,statut,besoin,fournisseur,adresse_fichier,debours,commission) 
                    VALUES(:numero,:date_emmission,:emmetteur,:statut,:besoin,:fournisseur,:adresse_fichier,:debours,:commission)"
                );

                $statement->bindParam(':numero',$bon_commande->numero);
                $statement->bindParam(':date_emmission',$bon_commande->date_emmission);
                $statement->bindParam(':emmetteur',$bon_commande->emmetteur);
                $statement->bindParam(':statut',$bon_commande->statut);
                $statement->bindParam(':besoin',$bon_commande->besoin);
                $statement->bindParam(':fournisseur',$bon_commande->fournisseur);
                $statement->bindParam(':adresse_fichier',$bon_commande->adresse_fichier);
                $statement->bindParam(':debours',$bon_commande->debours);
                $statement->bindParam(':commission',$bon_commande->commission);

                $statement->execute();
                                
                return $bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($bon_commande)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_bon_commande SET date_emmission = :date_emmission,
                    WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$bon_commande->numero);
                $statement->bindParam(':date_emmission',$bon_commande->date_emmission);

                $statement->execute();
                                
                return $bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateStatutTransmit($bon_commande)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_bon_commande SET statut = :statut, date_transmit = :date_transmit  
                    WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$bon_commande->numero);
                $statement->bindParam(':statut',$bon_commande->statut);
                $statement->bindParam(':date_transmit',$bon_commande->date_transmit);

                $statement->execute();
                                
                return $bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateStatutAbort($bon_commande)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_bon_commande SET statut = :statut, date_abort = :date_abort  
                    WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$bon_commande->numero);
                $statement->bindParam(':statut',$bon_commande->statut);
                $statement->bindParam(':date_abort',$bon_commande->date_abort);

                $statement->execute();
                                
                return $bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($bon_commande)
        {
            try{

                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_bon_commande WHERE bon_commande = :numero"
                );

                $statement->bindParam(':numero',$bon_commande->numero);

                $statement->execute();

                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_bon_commande WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$bon_commande->numero);

                $statement->execute();
                                
                return $bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }