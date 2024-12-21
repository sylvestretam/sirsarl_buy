<?php

    require_once('src/doc/TCPDF-main/tcpdf.php');

    class BonCommandePDF extends TCPDF {

        public $fournisseur= "ZANTEMARK LIMITED";
        public $niu= "PW100122588993";
        public $bp= "5244";
        public $rccm= "010-2589-3692";
        public $person= "NSOH Junior";
        public $pays= "CAMEROUN";
        public $ville= "DOUALA";
        public $email= "signature@sisas.cm";
        public $contact= "698 983 276";
        public $numero= "BC/SIRSARL/2024/10/00/000";
        public $monnaie= "XAF";
        public $date_emmission= "03.10.2024";

        public $total= 0;
        public $debours= 0;
        public $commission= 0;
        public $items = [];


        public function Header() {
            // Logo
            // $image_file = '../asset/logosirsarl.jpg';
            // $this->Image($image_file, 10, 5, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }
        
        public function MonContenu() 
        {
            $fontreg = "";// TCPDF_FONTS::addTTFfont('../font/sansation/Sansation-Regular.ttf', 'TrueTypeUnicode', '', 96);
            $fontbold = ""; //TCPDF_FONTS::addTTFfont('../font/sansation/Sansation-Bold.ttf', 'TrueTypeUnicode', '', 96);
            
            $lineheight = 8;
            $this->SetFont($fontreg, 'B', 10);
            $this->Cell(90,$lineheight,'CUSTOMER',1,0,'C');
            $this->Cell(50,$lineheight,'Etablit par : ',1,0,'C');
            $this->Cell(50,$lineheight,'BON DE COMMANDE',1,1,'C');

            $this->SetFont($fontreg, 'B', 8);
            $this->Cell(30,$lineheight,'Denomination :',"L",0,'L');
            $this->Cell(60,$lineheight,$this->fournisseur,0,0,'L');
            $this->Cell(50,$lineheight,'SIGNATURE RESOURCING SARL',"L",0,'C');
            $this->Cell(50,$lineheight,$this->numero,"R",1,'C');
            
            $this->Cell(30,$lineheight,'NIU :',"L",0,'L');
            $this->Cell(60,$lineheight,$this->niu,0,0,'L');
            $this->Cell(40,$lineheight,"B.P:","L",0,'L');
            $this->Cell(60,$lineheight,$this->bp,"R",1,'L');

            $this->Cell(30,$lineheight,'RCCM :',"L",0,'L');
            $this->Cell(60,$lineheight,$this->rccm,0,0,'L');
            $this->Cell(40,$lineheight,"Personne à contacter :","L",0,'L');
            $this->Cell(60,$lineheight,$this->person,"R",1,'L');

            $this->Cell(30,$lineheight,'Pays :',"L",0,'L');
            $this->Cell(60,$lineheight,$this->pays,0,0,'L');
            $this->Cell(40,$lineheight,"Contact :","L",0,'L');
            $this->Cell(60,$lineheight,$this->contact,"R",1,'L');

            $this->Cell(30,$lineheight,'Ville :',"LB",0,'L');
            $this->Cell(60,$lineheight,$this->ville,"B",0,'L');
            $this->Cell(40,$lineheight,"Email :","LB",0,'L');
            $this->Cell(60,$lineheight,$this->email,"BR",1,'L');

            $this->ln(2);
            $this->SetFont($fontbold, 'B', 8);
            $this->Cell(20,$lineheight,'ITEM',1,0,'L');
            $this->Cell(55,$lineheight,'Description',1,0,'C');
            $this->Cell(20,$lineheight,'QTY',1,0,'C');
            $this->Cell(25,$lineheight,'Date Emmission',1,0,'C');
            $this->Cell(25,$lineheight,'Prix Unitaire',1,0,'C');
            $this->Cell(25,$lineheight,'Montant Total',1,0,'C');
            $this->Cell(20,$lineheight,'Monnaie',1,1,'C');

            $this->SetFont($fontreg, '', 8);
            $i=1;
            foreach ($this->items as $key => $value) {
                $this->Cell(20,$lineheight,"SIRSARL_0".$i++,1,0,'L');
                $this->Cell(55,$lineheight,$key,1,0,'C');
                $this->Cell(20,$lineheight,$value->quantite,1,0,'C');
                $this->Cell(25,$lineheight,$this->date_emmission,1,0,'C');
                $this->Cell(25,$lineheight,$value->pu,1,0,'C');
                $this->Cell(25,$lineheight,number_format($value->pu * $value->quantite, 0, '', ' '),1,0,'C');
                $this->Cell(20,$lineheight,$this->monnaie,1,1,'C');
            }

            $this->ln(2);
            $this->SetFont($fontbold, 'B', 8);
            $this->Cell(145,$lineheight,'Debours / TOTAL HT : ',1,0,'R');
            $this->Cell(25,$lineheight,number_format($this->debours, 0, '', ' '),1,0,'C');
            $this->Cell(20,$lineheight,$this->monnaie,1,1,'C');
            $this->Cell(145,$lineheight,'Commission : ',1,0,'R');
            $this->Cell(25,$lineheight,number_format($this->commission, 0, '', ' '),1,0,'C');
            $this->Cell(20,$lineheight,$this->monnaie,1,1,'C');
            $this->Cell(145,$lineheight,'TOTAL HT : ',1,0,'R');
            $this->Cell(25,$lineheight,number_format($this->total, 0, '', ' '),1,0,'C');
            $this->Cell(20,$lineheight,$this->monnaie,1,1,'C');

            $fmt = new NumberFormatter('fr', NumberFormatter::SPELLOUT);

            $this->SetFont($fontreg, 'I', 13);
            $this->Cell(190,$lineheight,"Arréter le present Bon de Commande à la somme ".$this->monnaie." de ".$fmt->format( $this->total ),1,1,'C');

        }

        function Footer() {
            
        }
    }

