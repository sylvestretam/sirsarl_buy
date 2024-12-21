<?php

    require_once("src/model/facture.php");

    class FactureRepository
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
                    "SELECT * FROM ACH_facture"
                );


                $statement->execute();
                
                $factures = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $facture = new Facture();
                    $facture->numero = $row['numero'];
                    $facture->date_facturation = $row['date_facturation'];
                    $facture->libelle = $row['libelle'];
                    $facture->debours = $row['debours'];
                    $facture->commission = $row['commission'];
                    $facture->total = $row['total'];
                    $facture->statut = $row['statut'];
                    $facture->adresse_fichier = $row['adresse_fichier'];
                    $facture->bon_livraison = $row['bon_livraison'];
                    $facture->bon_commande = $row['bon_commande'];
                    $facture->fournisseur = $row['fournisseur'];
                    
                    $factures[] = $facture;
                }
                
                return $factures;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function getALLNOTINJOURNAL()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ACH_facture WHERE numero NOT IN ( SELECT facture FROM ACH_journal_achat)"
                );


                $statement->execute();
                
                $factures = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $facture = new Facture();
                    $facture->numero = $row['numero'];
                    $facture->date_facturation = $row['date_facturation'];
                    $facture->libelle = $row['libelle'];
                    $facture->debours = $row['debours'];
                    $facture->commission = $row['commission'];
                    $facture->total = $row['total'];
                    $facture->statut = $row['statut'];
                    $facture->adresse_fichier = $row['adresse_fichier'];
                    $facture->bon_livraison = $row['bon_livraison'];
                    $facture->bon_commande = $row['bon_commande'];
                    $facture->fournisseur = $row['fournisseur'];
                    
                    $factures[] = $facture;
                }
                
                return $factures;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($facture)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_facture(numero,date_facturation,libelle,debours,commission,total,statut,adresse_fichier,bon_livraison,bon_commande,fournisseur) 
                    VALUES(:numero,:date_facturation,:libelle,:debours,:commission,:total,:statut,:adresse_fichier,:bon_livraison,:bon_commande,:fournisseur)"
                );

                $statement->bindParam(':numero',$facture->numero);
                $statement->bindParam(':date_facturation',$facture->date_facturation);
                $statement->bindParam(':libelle',$facture->libelle);
                $statement->bindParam(':debours',$facture->debours);
                $statement->bindParam(':commission',$facture->debours);
                $statement->bindParam(':total',$facture->total);
                $statement->bindParam(':statut',$facture->statut);
                $statement->bindParam(':adresse_fichier',$facture->adresse_fichier);
                $statement->bindParam(':bon_livraison',$facture->bon_livraison);
                $statement->bindParam(':bon_commande',$facture->bon_commande);
                $statement->bindParam(':fournisseur',$facture->fournisseur);

                $statement->execute();
                                
                return $facture;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($facture)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_facture SET date_facturation = :date_facturation, libelle = :libelle, debours = :debours, 
                    commission = :commission,statut = :statut,adresse_fichier = :adresse_fichier, bon_livraison = :bon_livraison 
                    WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$facture->numero);
                $statement->bindParam(':date_facturation',$facture->date_facturation);
                $statement->bindParam(':libelle',$facture->libelle);
                $statement->bindParam(':debours',$facture->debours);
                $statement->bindParam(':statut',$facture->statut);
                $statement->bindParam(':statut',$facture->statut);
                $statement->bindParam(':adresse_fichier',$facture->adresse_fichier);
                $statement->bindParam(':bon_livraison',$facture->bon_livraison);

                $statement->execute();
                                
                return $facture;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($facture)
        {
            try{

                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_facture WHERE facture = :numero"
                );

                $statement->bindParam(':numero',$facture->numero);

                $statement->execute();
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_facture WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$facture->numero);

                $statement->execute();
                                
                return $facture;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }