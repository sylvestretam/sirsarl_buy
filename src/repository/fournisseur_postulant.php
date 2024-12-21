<?php

    require_once("src/model/fournisseur_postulant.php");

    class FournisseurPostulantRepository
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
                    "SELECT * FROM ACH_fournisseur_postulant"
                );


                $statement->execute();
                
                $fournisseur_postulants = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $fournisseur_postulant = new FournisseurPostulant();
                    $fournisseur_postulant->fournisseur = $row['fournisseur'];
                    $fournisseur_postulant->date_postulat = $row['date_postulat'];
                    $fournisseur_postulant->besoin = $row['besoin'];
                    $fournisseur_postulant->offre_technique = $row['offre_technique'];
                    $fournisseur_postulant->offre_financiere = $row['offre_financiere'];
                    $fournisseur_postulant->note_emmetteur = $row['note_emmetteur'];
                    $fournisseur_postulant->note_financier = $row['note_financier'];
                    $fournisseur_postulant->motivation_emmetteur = $row['motivation_emmetteur'];
                    $fournisseur_postulant->motivation_financier = $row['motivation_financier'];
                    $fournisseur_postulant->statut = $row['statut'];
                    $fournisseur_postulant->observation = $row['observation'];
                    
                    $fournisseur_postulants[] = $fournisseur_postulant;
                }
                
                return $fournisseur_postulants;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($fournisseur_postulant)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO ACH_fournisseur_postulant(fournisseur,besoin,date_postulat,offre_technique,offre_financiere,note_emmetteur,
                    note_financier,motivation_emmetteur,motivation_financier,statut,observation) 
                    VALUES(:fournisseur,:besoin,:date_postulat,:offre_technique,:offre_financiere,:note_emmetteur,:note_financier,
                    :motivation_emmetteur,:motivation_financier,:statut,:observation)"
                );

                $statement->bindParam(':fournisseur',$fournisseur_postulant->fournisseur);
                $statement->bindParam(':besoin',$fournisseur_postulant->besoin);
                $statement->bindParam(':date_postulat',$fournisseur_postulant->date_postulat);
                $statement->bindParam(':offre_technique',$fournisseur_postulant->offre_technique);
                $statement->bindParam(':offre_financiere',$fournisseur_postulant->offre_financiere);
                $statement->bindParam(':note_emmetteur',$fournisseur_postulant->note_emmetteur);
                $statement->bindParam(':note_financier',$fournisseur_postulant->note_financier);
                $statement->bindParam(':motivation_emmetteur',$fournisseur_postulant->motivation_emmetteur);
                $statement->bindParam(':motivation_financier',$fournisseur_postulant->motivation_financier);
                $statement->bindParam(':statut',$fournisseur_postulant->statut);
                $statement->bindParam(':observation',$fournisseur_postulant->observation);

                $statement->execute();
                                
                return $fournisseur_postulant;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateNotePostulant($fournisseur_postulant)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE ACH_fournisseur_postulant SET note_emmetteur = :note_emmetteur, note_financier = :note_financier, 
                     motivation_emmetteur = :motivation_emmetteur, motivation_financier = :motivation_financier, date_postulat = :date_postulat 
                    WHERE fournisseur = :fournisseur AND besoin = :besoin"
                );

                $statement->bindParam(':fournisseur',$fournisseur_postulant->fournisseur);
                $statement->bindParam(':besoin',$fournisseur_postulant->besoin);
                $statement->bindParam(':date_postulat',$fournisseur_postulant->date_postulat);
                $statement->bindParam(':note_emmetteur',$fournisseur_postulant->note_emmetteur);
                $statement->bindParam(':note_financier',$fournisseur_postulant->note_financier);
                $statement->bindParam(':motivation_emmetteur',$fournisseur_postulant->motivation_emmetteur);
                $statement->bindParam(':motivation_financier',$fournisseur_postulant->motivation_financier);

                $statement->execute();
                                
                return $fournisseur_postulant;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($fournisseur_postulant)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM ACH_fournisseur_postulant WHERE fournisseur = :fournisseur AND besoin = :besoin"
                );

                $statement->bindParam(':fournisseur',$fournisseur_postulant->fournisseur);
                $statement->bindParam(':besoin',$fournisseur_postulant->besoin);

                $statement->execute();
                                
                return $fournisseur_postulant;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }