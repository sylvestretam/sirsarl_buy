<?php 

    class BonCommande{

        public $numero;
        public $date_emmission;
        public $date_transmit;
        public $date_abort;
        public $emmetteur;
        public $debours;
        public $commission;
        public $statut;
        public $besoin;
        public $fournisseur;
        public $adresse_fichier;

        public $ITEMS = [];

        public function MontantTotal(){
            return array_reduce($this->ITEMS,function($carry, $object){ return   $carry + ($object->prix_unitaire*$object->quantite);},0);;
        }

        public function setITEMS($items)
        {
            foreach ($items as $item) {
                if( $item->bon_commande == $this->numero){
                    $this->ITEMS[] = $item;
                }
            }
        }

    }