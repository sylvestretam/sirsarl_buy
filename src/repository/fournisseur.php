<?php

    require_once("src/model/fournisseur.php");

    class FournisseurRepository
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
                    "SELECT * FROM ENT_fournisseur"
                );


                $statement->execute();
                
                $fournisseurs = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fournisseur = new Fournisseur();
                    $fournisseur->code = $row['code'];
                    $fournisseur->denomination = $row['denomination'];
                    $fournisseur->date_creation = $row['date_creation'];
                    $fournisseur->niu = $row['niu'];
                    $fournisseur->rccm = $row['rccm'];
                    $fournisseur->regime_impot = $row['regime_impot'];
                    $fournisseur->profil = $row['profil'];
                    $fournisseur->email = $row['email'];
                    $fournisseur->specialite = $row['specialite'];
                    $fournisseur->adresse = $row['adresse'];
                    $fournisseur->contact = $row['contact'];
                    $fournisseur->statut = $row['statut'];
                    $fournisseur->besoin_selection = $row['besoin_selection'];

                    $fournisseurs[] = $fournisseur;
                }
                
                return $fournisseurs;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function getFournisseur($code)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM ENT_fournisseur WHERE code = :code"
                );

                $statement->bindParam(':code',$code);

                $statement->execute();
                

                if($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fournisseur = new Fournisseur();
                    $fournisseur->code = $row['code'];
                    $fournisseur->denomination = $row['denomination'];
                    $fournisseur->date_creation = $row['date_creation'];
                    $fournisseur->niu = $row['niu'];
                    $fournisseur->rccm = $row['rccm'];
                    $fournisseur->regime_impot = $row['regime_impot'];
                    $fournisseur->profil = $row['profil'];
                    $fournisseur->email = $row['email'];
                    $fournisseur->specialite = $row['specialite'];
                    $fournisseur->adresse = $row['adresse'];
                    $fournisseur->contact = $row['contact'];
                    $fournisseur->statut = $row['statut'];
                    $fournisseur->besoin_selection = $row['besoin_selection'];

                    return $fournisseur;
                }
                
                return new Fournisseur();

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($fournisseur)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ENT_fournisseur(code,denomination,niu,rccm,regime_impot,profil,email,specialite,adresse,contact,statut,besoin_selection) 
                    VALUES(:code,:denomination,:niu,:rccm,:regime_impot,:profil,:email,:specialite,:adresse,:contact,:statut,:besoin_selection)"
                );

                $statement->bindParam(':code',$fournisseur->code);
                $statement->bindParam(':denomination',$fournisseur->denomination);
                $statement->bindParam(':date_creation',$fournisseur->date_creation);
                $statement->bindParam(':niu',$fournisseur->niu);
                $statement->bindParam(':rccm',$fournisseur->rccm);
                $statement->bindParam(':regime_impot',$fournisseur->regime_impot);
                $statement->bindParam(':profil',$fournisseur->profil);
                $statement->bindParam(':email',$fournisseur->email);
                $statement->bindParam(':specialite',$fournisseur->specialite);
                $statement->bindParam(':adresse',$fournisseur->adresse);
                $statement->bindParam(':contact',$fournisseur->contact);
                $statement->bindParam(':statut',$fournisseur->statut);
                $statement->bindParam(':besoin_selection',$fournisseur->besoin_selection);

                $statement->execute();
                                
                return $fournisseur;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($fournisseur)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ENT_fournisseur 
                        SET denomination = :denomination, niu = :niu, rccm = :rccm, regime_impot = :regime_impot,
                        profil = :profil,email = :email,specialite = :specialite, adresse = :adresse,contact = :contact,
                        statut = :statut, besoin_selection = :besoin_selection
                        WHERE code = :code"
                );

                $statement->bindParam(':code',$fournisseur->code);
                $statement->bindParam(':denomination',$fournisseur->denomination);
                $statement->bindParam(':date_creation',$fournisseur->date_creation);
                $statement->bindParam(':niu',$fournisseur->niu);
                $statement->bindParam(':rccm',$fournisseur->rccm);
                $statement->bindParam(':regime_impot',$fournisseur->regime_impot);
                $statement->bindParam(':profil',$fournisseur->profil);
                $statement->bindParam(':email',$fournisseur->email);
                $statement->bindParam(':specialite',$fournisseur->specialite);
                $statement->bindParam(':adresse',$fournisseur->adresse);
                $statement->bindParam(':contact',$fournisseur->contact);
                $statement->bindParam(':statut',$fournisseur->statut);
                $statement->bindParam(':besoin_selection',$fournisseur->besoin_selection);

                $statement->execute();
                                
                return $fournisseur;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($fournisseur)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ENT_fournisseur WHERE code = :code"
                );

                $statement->bindParam(':code',$fournisseur->code);

                $statement->execute();
                                
                return $fournisseur;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }