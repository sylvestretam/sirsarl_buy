<?php 

    class BonLivraison{

        public $numero;
        public $date_livraison;
        public $date_emmission;
        public $statut_execution;
        public $statut_commande;
        public $bon_commande;
        public $adresse_fichier;
        public $emmetteur;
        public $type;

        public $ITEMS = [];

        public function setITEMS($items)
        {
            foreach ($items as $item) {
                if( $item->bon_livraison == $this->numero){
                    $this->ITEMS[] = $item;
                }
            }
        }

    }