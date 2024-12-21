<?php

    require_once("src/model/item_facture.php");

    class ItemFactureRepository
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
                    "SELECT * FROM ACH_item_facture"
                );


                $statement->execute();
                
                $item_factures = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $item_facture = new ItemFacture();
                    $item_facture->item_id = $row['item_id'];
                    $item_facture->designation = $row['designation'];
                    $item_facture->quantite = $row['quantite'];
                    $item_facture->prix_unitaire = $row['prix_unitaire'];
                    $item_facture->facture = $row['facture'];
                    
                    $item_factures[] = $item_facture;
                }
                
                return $item_factures;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($item_facture)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_item_facture(designation,quantite,prix_unitaire,facture) 
                    VALUES(:designation,:quantite,:prix_unitaire,:facture)"
                );

                $statement->bindParam(':designation',$item_facture->designation);
                $statement->bindParam(':quantite',$item_facture->quantite);
                $statement->bindParam(':prix_unitaire',$item_facture->prix_unitaire);
                $statement->bindParam(':facture',$item_facture->facture);

                $statement->execute();
                                
                return $item_facture;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($item_facture)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_item_facture SET designation = :designation, quantite= :quantite, facture = :facture 
                    WHERE item_id = :item_id"
                );

                $statement->bindParam(':designation',$item_facture->designation);
                $statement->bindParam(':quantite',$item_facture->quantite);
                $statement->bindParam(':facture',$item_facture->facture);
                $statement->bindParam(':item_id',$item_facture->item_id);

                $statement->execute();
                                
                return $item_facture;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($item_facture)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_facture WHERE item_id = :item_id"
                );

                $statement->bindParam(':item_id',$item_facture->item_id);

                $statement->execute();
                                
                return $item_facture;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }