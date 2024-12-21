<?php

    require_once('src/repository/fiche_besoin.php');
    require_once('src/repository/employee.php');

    class BesoinController{

        private $dbconnect;

        private $FicheBesoinRepo;
        private $EmployeeRepo;

        private $fiches_besoins = [];
        private $today_fiches_besoins = [];
        private $employees = [];

        private $BES_FILE_NAME;

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->FicheBesoinRepo = new FicheBesoinRepository($this->dbconnect);
            $this->EmployeeRepo = new EmployeeRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $fiches_besoins = $this->fiches_besoins;
            $today_fiches_besoins = $this->today_fiches_besoins;
            $employees = $this->employees;
            
            $draft = array_reduce($this->fiches_besoins,function($carry, $object){ return  ($object->statut == "DRAFT") ? $carry + 1 : $carry + 0;},0);
            $commander = array_reduce($this->fiches_besoins,function($carry, $object){ return  ($object->statut == "COMMANDER") ? $carry + 1 : $carry + 0;},0);
            $livrer = array_reduce($this->fiches_besoins,function($carry, $object){ return  ($object->statut == "LIVRER") ? $carry + 1 : $carry + 0;},0);
            $rejeter = array_reduce($this->fiches_besoins,function($carry, $object){ return  ($object->statut == "REJETER") ? $carry + 1 : $carry + 0;},0);
            require("template/besoin.php");
        }

        function init()
        {
            $this->fiches_besoins = $this->FicheBesoinRepo->getAll();
            $this->today_fiches_besoins = $this->FicheBesoinRepo->getTODAYAll();
            $this->employees = $this->EmployeeRepo->getAll();
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveBesoin':
                                        
                    // if ($this->SaveFile()) {
                    //     $besoin = new FicheBesoin();
                    //     $besoin->date_fiche = $_REQUEST['date_emmission'];
                    //     $besoin->emmetteur = $_REQUEST['emmetteur'];
                    //     $besoin->departement = $_REQUEST['departement'];
                    //     $besoin->nature = $_REQUEST['nature'];
                    //     $besoin->description = $_REQUEST['description'];
                    //     $besoin->statut = "DRAFT";
                    //     $besoin->adresse_fichier = basename($_FILES['fichier']['name']);
                    //     $besoin->uuid = uniqid('bes_');
                    //     $besoin->fiche_id = $besoin->uuid;

                    //     $repo = new FicheBesoinRepository($this->dbconnect);
                    //     $besoin = $repo->save($besoin);
                    // } else {
                    //     $GLOBALS['error'] =  "Un problème est survenue lors du tranfert de fichier !!!";
                    // }

                    
                    $besoin = new FicheBesoin();
                    $besoin->date_fiche = $_REQUEST['date_emmission'];
                    $besoin->emmetteur = $_REQUEST['emmetteur'];
                    $besoin->departement = $_REQUEST['departement'];
                    $besoin->nature = $_REQUEST['nature'];
                    $besoin->description = $_REQUEST['description'];
                    $besoin->statut = "DRAFT";
                    $besoin->adresse_fichier = "***";
                    $besoin->uuid = uniqid('bes_');
                    $besoin->fiche_id = $_REQUEST['numero'];

                    $repo = new FicheBesoinRepository($this->dbconnect);
                    $besoin = $repo->save($besoin);

                    break;

                case 'updateBesoin':
                    $besoin = new FicheBesoin();
                    $besoin->fiche_id = $_REQUEST['fiche_id'];
                    $besoin->date_fiche = $_REQUEST['date_emmission'];
                    $besoin->nature = $_REQUEST['nature'];
                    $besoin->description = $_REQUEST['description'];

                    if( !empty($_REQUEST['rejeter']) ){
                        if($_REQUEST['rejeter'] == "on"){
                            $repo = new FicheBesoinRepository($this->dbconnect);
                            $besoin->statut = "REJETER";
                            $besoin = $repo->updateStatut($besoin);
                        }
                    }

                    $repo = new FicheBesoinRepository($this->dbconnect);
                    $besoin = $repo->update($besoin);
                    break;

                case 'deleteBesoin':
            
                    $besoin = new FicheBesoin();
                    $besoin->fiche_id = $_REQUEST['fiche_id'];

                    $repo = new FicheBesoinRepository($this->dbconnect);
                    $besoin = $repo->delete($besoin);
                    break;

                default:
                    # code...
                    break;
            }

        }

        function SaveFile()
        {

            $uploaddir = $GLOBALS['FILESERVERPATH'];
            $uploadfile = $uploaddir . basename($_FILES['fichier']['name']);
            return move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile);
        }

    }