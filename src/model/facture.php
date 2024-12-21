<?php 

    class Facture{

        public $numero;
        public $date_facturation;
        public $libelle;
        public $debours;
        public $commission;
        public $total;
        public $statut;
        public $adresse_fichier;
        public $bon_livraison;
        public $bon_commande;
        public $type;
        public $fournisseur;

        public $ITEMS = [];

        public function setITEMS($items)
        {
            foreach ($items as $item) {
                if( $item->facture == $this->numero){
                    $this->ITEMS[] = $item;
                }
            }
        }

    }