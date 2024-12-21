<?php

    require_once("src/model/item_bon_commande.php");

    class ItemBonCommandeRepository
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
                    "SELECT * FROM ACH_item_bon_commande"
                );


                $statement->execute();
                
                $item_bon_commandes = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $item_bon_commande = new ItemBonCommande();
                    $item_bon_commande->item_id = $row['item_id'];
                    $item_bon_commande->designation = $row['designation'];
                    $item_bon_commande->description = $row['description'];
                    $item_bon_commande->quantite = $row['quantite'];
                    $item_bon_commande->prix_unitaire = $row['prix_unitaire'];
                    $item_bon_commande->bon_commande = $row['bon_commande'];
                    
                    $item_bon_commandes[] = $item_bon_commande;
                }
                
                return $item_bon_commandes;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($item_bon_commande)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_item_bon_commande(designation,description,quantite,prix_unitaire,bon_commande) 
                    VALUES(:designation,:description,:quantite,:prix_unitaire,:bon_commande)"
                );

                $statement->bindParam(':designation',$item_bon_commande->designation);
                $statement->bindParam(':description',$item_bon_commande->description);
                $statement->bindParam(':quantite',$item_bon_commande->quantite);
                $statement->bindParam(':prix_unitaire',$item_bon_commande->prix_unitaire);
                $statement->bindParam(':bon_commande',$item_bon_commande->bon_commande);

                $statement->execute();
                                
                return $item_bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($item_bon_commande)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_item_bon_commande SET designation = :designation, description = :description, quantite= :quantite, 
                    prix_unitaire = :prix_unitaire, bon_commande = :bon_commande 
                    WHERE item_id = :item_id"
                );

                $statement->bindParam(':designation',$item_bon_commande->designation);
                $statement->bindParam(':description',$item_bon_commande->description);
                $statement->bindParam(':quantite',$item_bon_commande->quantite);
                $statement->bindParam(':prix_unitaire',$item_bon_commande->prix_unitaire);
                $statement->bindParam(':bon_commande',$item_bon_commande->bon_commande);
                $statement->bindParam(':item_id',$item_bon_commande->item_id);

                $statement->execute();
                                
                return $item_bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($item_bon_commande)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_item_bon_commande WHERE item_id = :item_id"
                );

                $statement->bindParam(':item_id',$item_bon_commande->item_id);

                $statement->execute();
                                
                return $item_bon_commande;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }