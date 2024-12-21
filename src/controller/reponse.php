<?php

    require_once('src/repository/fiche_besoin.php');
    require_once('src/repository/fournisseur_postulant.php');

    class ReponseController{

        private $dbconnect;

        private $FicheBesoinRepo;
        private $FournisseurRepo;
        private $FournisseurPostulantRepo;

        private $fiches_besoins = [];
        private $postulants = [];
        private $fournisseurs = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->FicheBesoinRepo = new FicheBesoinRepository($this->dbconnect);
            $this->FournisseurRepo = new FournisseurRepository($this->dbconnect);
            $this->FournisseurPostulantRepo = new FournisseurPostulantRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $fiches_besoins = $this->fiches_besoins;
            $fournisseurs = $this->fournisseurs;
            $postulants = $this->postulants;
            
            require("template/reponse.php");
        }

        function init()
        {
            $this->fiches_besoins = $this->FicheBesoinRepo->getAll();
            $this->postulants = $this->FournisseurPostulantRepo->getAll();
            $this->fournisseurs = $this->FournisseurRepo->getAll();
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'savePostulant':
                    
                    
                    if ($this->SaveFile()) {
                        $postulant = new FournisseurPostulant();
                        $postulant->besoin = $_REQUEST['besoin'];
                        $postulant->fournisseur = $_REQUEST['fournisseur'];
                        $postulant->date_postulat = $_REQUEST['date_postulat'];
                        $postulant->offre_financiere = basename($_FILES['offre_financiere']['name']);
                        $postulant->offre_technique = basename($_FILES['offre_technique']['name']);
                        $postulant->motivation_emmetteur = $_REQUEST['motivation_emmetteur'];
                        $postulant->motivation_financier = $_REQUEST['motivation_financier'];
                        $postulant->note_emmetteur = $_REQUEST['note_emmetteur'];
                        $postulant->note_financier = $_REQUEST['note_financier'];
                        $postulant->statut = "DRAFT";

                        $repo = new FournisseurPostulantRepository($this->dbconnect);
                        $repo->save($postulant);
                    } else {
                        $GLOBALS['error'] =  "Un problème est survenue lors du tranfert de fichier !!!";
                    }

                    break;

                case 'updateNotePostulant':
                    $postulant = new FournisseurPostulant();
                    $postulant->besoin = $_REQUEST['besoin'];
                    $postulant->fournisseur = $_REQUEST['fournisseur'];
                    $postulant->date_postulat = $_REQUEST['date_postulat'];
                    $postulant->motivation_emmetteur = $_REQUEST['motivation_emmetteur'];
                    $postulant->motivation_financier = $_REQUEST['motivation_financier'];
                    $postulant->note_emmetteur = $_REQUEST['note_emmetteur'];
                    $postulant->note_financier = $_REQUEST['note_financier'];

                    $repo = new FournisseurPostulantRepository($this->dbconnect);
                    $repo->updateNotePostulant($postulant);
                    break;

                case 'deletePostulant':
            
                    $postulant = new FournisseurPostulant();
                    $postulant->besoin = $_REQUEST['besoin'];
                    $postulant->fournisseur = $_REQUEST['fournisseur'];

                    $repo = new FournisseurPostulantRepository($this->dbconnect);
                    $repo->delete($postulant);
                    break;

                default:
                    # code...
                    break;
            }

        }

        function SaveFile()
        {

            $uploaddir = $GLOBALS['OFFREFINFILESERVERPATH'];
            $uploadfile = $uploaddir . basename($_FILES['offre_financiere']['name']);
            $finance = move_uploaded_file($_FILES['offre_financiere']['tmp_name'], $uploadfile);

            $uploaddir = $GLOBALS['OFFRETECHFILESERVERPATH'];
            $uploadfile = $uploaddir . basename($_FILES['offre_technique']['name']);
            $technique =  move_uploaded_file($_FILES['offre_technique']['tmp_name'], $uploadfile);

            return ($finance && $technique);
        }

    }