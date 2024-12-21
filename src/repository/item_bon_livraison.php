<?php

    require_once("src/model/item_bon_livraison.php");

    class ItemBonLivraisonRepository
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
                    "SELECT * FROM ACH_item_bon_livraison"
                );


                $statement->execute();
                
                $item_bon_livraisons = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $item_bon_livraison = new ItemBonLivraison();
                    $item_bon_livraison->item_id = $row['item_id'];
                    $item_bon_livraison->designation = $row['designation'];
                    $item_bon_livraison->description = $row['description'];
                    $item_bon_livraison->quantite = $row['quantite'];
                    $item_bon_livraison->bon_livraison = $row['bon_livraison'];
                    
                    $item_bon_livraisons[] = $item_bon_livraison;
                }
                
                return $item_bon_livraisons;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($item_bon_livraison)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_item_bon_livraison(designation,description,quantite,bon_livraison) 
                    VALUES(:designation,:description,:quantite,:bon_livraison)"
                );

                $statement->bindParam(':designation',$item_bon_livraison->designation);
                $statement->bindParam(':description',$item_bon_livraison->description);
                $statement->bindParam(':quantite',$item_bon_livraison->quantite);
                $statement->bindParam(':bon_livraison',$item_bon_livraison->bon_livraison);

                $statement->execute();
                                
                return $item_bon_livraison;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($item_bon_livraison)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_item_bon_livraison SET designation = :designation, description = :description, quantite= :quantite, 
                    bon_livraison = :bon_livraison 
                    WHERE item_id = :item_id"
                );

                $statement->bindParam(':designation',$item_bon_livraison->designation);
                $statement->bindParam(':description',$item_bon_livraison->description);
                $statement->bindParam(':quantite',$item_bon_livraison->quantite);
                $statement->bindParam(':bon_livraison',$item_bon_livraison->bon_commande);
                $statement->bindParam(':item_id',$item_bon_livraison->item_id);

                $statement->execute();
                                
                return $item_bon_livraison;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($item_bon_livraison)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_bon_livraison WHERE item_id = :item_id"
                );

                $statement->bindParam(':item_id',$item_bon_livraison->item_id);

                $statement->execute();
                                
                return $item_bon_livraison;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }