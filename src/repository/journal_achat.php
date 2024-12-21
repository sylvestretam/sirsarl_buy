<?php

    require_once("src/model/journal_achat.php");

    class JournalAchatRepository
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
                    "SELECT * FROM ACH_journal_achat"
                );


                $statement->execute();
                
                $journal_achats = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $journal_achat = new JournalAchat();
                    $journal_achat->numero_pja = $row['numero_pja'];
                    $journal_achat->date_facturation = $row['date_facturation'];
                    $journal_achat->motif = $row['motif'];
                    $journal_achat->libelle = $row['libelle'];
                    $journal_achat->facture = $row['facture'];
                    $journal_achat->montant_total = $row['montant_total'];
                    $journal_achat->fournisseur = $row['fournisseur'];
                    
                    $journal_achats[] = $journal_achat;
                }
                
                return $journal_achats;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function getDAYAll($journal_achat)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ACH_journal_achat WHERE date_facturation = :date_facturation"
                );

                $statement->bindParam(':date_facturation',$journal_achat->date_facturation);
                
                $statement->execute();
                
                $journal_achats = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $journal_achat = new JournalAchat();
                    $journal_achat->numero_pja = $row['numero_pja'];
                    $journal_achat->date_facturation = $row['date_facturation'];
                    $journal_achat->motif = $row['motif'];
                    $journal_achat->libelle = $row['libelle'];
                    $journal_achat->facture = $row['facture'];
                    $journal_achat->montant_total = $row['montant_total'];
                    $journal_achat->fournisseur = $row['fournisseur'];
                    
                    $journal_achats[] = $journal_achat;
                }
                
                return $journal_achats;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($journal_achat)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_journal_achat(numero_pja,motif,libelle,facture,date_facturation,montant_total,fournisseur) 
                    VALUES(:numero_pja,:motif,:libelle,:facture,:date_facturation,:montant_total,:fournisseur)"
                );

                $statement->bindParam(':numero_pja',$journal_achat->numero_pja);
                $statement->bindParam(':motif',$journal_achat->motif);
                $statement->bindParam(':libelle',$journal_achat->libelle);
                $statement->bindParam(':facture',$journal_achat->facture);
                $statement->bindParam(':date_facturation',$journal_achat->date_facturation);
                $statement->bindParam(':montant_total',$journal_achat->montant_total);
                $statement->bindParam(':fournisseur',$journal_achat->fournisseur);

                $statement->execute();
                                
                return $journal_achat;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($journal_achat)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_journal_achat SET motif = :motif, libelle = :libelle, facture = :facture, date_facturation = :date_facturation, montant_total = :montant_total 
                    WHERE numero_pja = :numero_pja"
                );

                $statement->bindParam(':numero_pja',$journal_achat->numero_pja);
                $statement->bindParam(':motif',$journal_achat->motif);
                $statement->bindParam(':libelle',$journal_achat->libelle);
                $statement->bindParam(':facture',$journal_achat->facture);
                $statement->bindParam(':date_facturation',$journal_achat->date_facturation);
                $statement->bindParam(':montant_total',$journal_achat->montant_total);

                $statement->execute();
                                
                return $journal_achat;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($journal_achat)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_journal_achat WHERE numero_pja = :numero_pja"
                );

                $statement->bindParam(':numero_pja',$journal_achat->numero_pja);

                $statement->execute();
                                
                return $journal_achat;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function deleteAllItem($journal)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_journal_achat WHERE numero_pja = :numero_pja"
                );

                $statement->bindParam(':numero_pja',$journal->numero_pja);

                $statement->execute();
                                
                return $journal;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }