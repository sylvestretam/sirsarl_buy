<?php

    require_once("src/model/item_journal.php");

    class ItemJournalRepository
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
                    "SELECT * FROM ACH_item_journal_achat"
                );


                $statement->execute();
                
                $item_journals = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $item_journal = new ItemJournal();
                    $item_journal->numero_pja = $row['numero_pja'];
                    $item_journal->compte = $row['compte'];
                    $item_journal->type_operation = $row['type_operation'];
                    $item_journal->montant = $row['montant'];
                    
                    $item_journals[] = $item_journal;
                }
                
                return $item_journals;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($item_journal)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_item_journal_achat(numero_pja,compte,type_operation,montant) 
                    VALUES(:numero_pja,:compte,:type_operation,:montant)"
                );

                $statement->bindParam(':numero_pja',$item_journal->numero_pja);
                $statement->bindParam(':compte',$item_journal->compte);
                $statement->bindParam(':type_operation',$item_journal->type_operation);
                $statement->bindParam(':montant',$item_journal->montant);

                $statement->execute();
                                
                return $item_journal;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($item_journal)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_item_journal SET compte = :compte, type_operation = :type_operation, montant= :montant 
                    WHERE numero_pja = :numero_pja"
                );

                $statement->bindParam(':numero_pja',$item_journal->numero_pja);
                $statement->bindParam(':compte',$item_journal->compte);
                $statement->bindParam(':type_operation',$item_journal->type_operation);
                $statement->bindParam(':montant',$item_journal->montant);

                $statement->execute();
                                
                return $item_journal;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function deleteAllItem($journal)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_journal WHERE numero_pja = :numero_pja"
                );

                $statement->bindParam(':numero_pja',$journal->numero_pja);

                $statement->execute();
                                
                return $journal;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($item_journal)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_journal WHERE numero_pja = :numero_pja AND compte = :compte"
                );

                $statement->bindParam(':numero_pja',$item_journal->numero_pja);
                $statement->bindParam(':compte',$item_journal->compte);

                $statement->execute();
                                
                return $item_journal;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }