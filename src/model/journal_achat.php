<?php 

    class JournalAchat{

        public $numero_pja;
        public $date_facturation;
        public $motif;
        public $libelle;
        public $montant_total;
        public $facture;
        public $fournisseur;

        public $ITEMS = [];

        public function setITEMS($items)
        {
            foreach ($items as $item) {
                if( $item->numero_pja == $this->numero_pja){
                    $this->ITEMS[] = $item;
                }
            }
        }

    }