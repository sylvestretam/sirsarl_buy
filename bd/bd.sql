#Ma base de données : 

-- DROP TABLE IF EXISTS ACH_fiche_besoin;
-- CREATE TABLE ACH_fiche_besoin(
--         fiche_id     varchar(32),
--         date_fiche     date,
--         nature     varchar(255),
--         description     varchar(500),
--         emmetteur     varchar(25),
--         departement     varchar(64),
--         adresse_fichier     varchar(255),
--         statut_departement     varchar(25),
--         statut_md     varchar(25),
--         statut_departement_by     varchar(25),
--         statut_md_by     varchar(25),
--         PRIMARY KEY (fiche_id)
-- );




-- DROP TABLE IF EXISTS ENT_fournisseur;
-- CREATE TABLE ENT_fournisseur(
--         code     varchar(25),
--         date_creation     date,
--         niu     Varchar (50),
--         rccm     Varchar (50),
--         regime_impot     varchar(255),
--         profil     varchar(255),
--         email     varchar(255),
--         specialite     varchar(255),
--         adresse     varchar(255),
--         contact     varchar(25),
--         besoin     integer,
--         PRIMARY KEY (code)
-- );



DROP TABLE IF EXISTS ACH_bon_commande;
CREATE TABLE ACH_bon_commande(
        numero     varchar(255),
        date_emmission     date,
        date_transmit     date,
        date_abort     date,
        emmetteur     varchar(255),
        debours     float,
        commission     float,
        statut     varchar(25),
        besoin     varchar(32),
        fournisseur     varchar(25),
        adresse_fichier     varchar(255),
        type varchar(32),
        PRIMARY KEY (numero)
);


DROP TABLE IF EXISTS ACH_facture;
CREATE TABLE ACH_facture(
        numero     varchar(255),
        date_facturation     date,
        libelle     varchar(255),
        debours     integer,
        commission     integer,
        total     float,
        statut     varchar(25),
        adresse_fichier     varchar(255),
        bon_livraison     varchar(255),
        bon_commande     varchar(255),
        type varchar(32),
        fournisseur     varchar(25),
        PRIMARY KEY (numero)
);



DROP TABLE IF EXISTS ENT_compte;
CREATE TABLE ENT_compte(
        numero     varchar(25),
        designation     varchar(255),
        classe     integer,
        PRIMARY KEY (numero)
);


DROP TABLE IF EXISTS ACH_item_facture;
CREATE TABLE ACH_item_facture(
        item_id     integer auto_increment,
        designation     varchar(255),
        quantite     integer,
        prix_unitaire     integer,
        facture     varchar(255),
        PRIMARY KEY (item_id)
);



DROP TABLE IF EXISTS ACH_bon_livraison;
CREATE TABLE ACH_bon_livraison(
        numero     varchar(255),
        date_livraison     date,
        date_emmission     date,
        statut_commande     varchar(25),
        statut_execution     varchar(25),
        bon_commande     varchar(255),
        adresse_fichier     varchar(255),
        emmetteur     varchar(32),
        type varchar(32),
        PRIMARY KEY (numero)
);



DROP TABLE IF EXISTS ACH_item_bon_livraison;
CREATE TABLE ACH_item_bon_livraison(
        item_id     integer auto_increment,
        designation     varchar(255),
        description     varchar(255),
        quantite     integer,
        bon_livraison     varchar(255),
        PRIMARY KEY (item_id)
);



DROP TABLE IF EXISTS ACH_item_bon_commande;
CREATE TABLE ACH_item_bon_commande(
        item_id     integer auto_increment,
        designation     varchar(255),
        description     varchar(255),
        quantite     integer,
        prix_unitaire     integer,
        bon_commande     varchar(255),
        PRIMARY KEY (item_id)
);



DROP TABLE IF EXISTS ACH_fournisseur_postulant;
CREATE TABLE ACH_fournisseur_postulant(
        date_postulat     date,
        note_emmetteur     float,
        note_financier     float,
        motivation_emmetteur     varchar(255),
        motivation_financier     varchar(255),
        statut     varchar(25),
        observation     varchar(255),
        offre_technique     varchar(255),
        offre_financiere     varchar(255),
        fournisseur     varchar(25),
        besoin     varchar(32),
        PRIMARY KEY (fournisseur,besoin)
);


DROP TABLE IF EXISTS ACH_journal_achat;
CREATE TABLE ACH_journal_achat(
        numero_pja     varchar(255),
        date_facturation     date,
        montant_total     float,
        motif     varchar(255),
        libelle     varchar(255),
        facture     varchar(25),
        fournisseur     varchar(25),
        PRIMARY KEY (numero_pja)
);

DROP TABLE IF EXISTS ACH_item_journal_achat;
CREATE TABLE ACH_item_journal_achat(
        numero_pja     varchar(255),
        compte     varchar(25),
        type_operation     varchar(25),
        montant     float,
        PRIMARY KEY (numero_pja,compte)
);

ALTER TABLE ACH_journal_achat ADD CONSTRAINT FK_ACH_journal_achat_facture FOREIGN KEY (facture) REFERENCES ACH_facture(numero);

ALTER TABLE ACH_item_journal_achat ADD CONSTRAINT FK_ACH_item_journal_achat_journal_achat FOREIGN KEY (numero_pja) REFERENCES ACH_journal_achat(numero_pja);
ALTER TABLE ACH_item_journal_achat ADD CONSTRAINT FK_ACH_item_journal_achat_compte FOREIGN KEY (compte) REFERENCES ENT_compte(numero);

ALTER TABLE ENT_fournisseur ADD CONSTRAINT FK_ENT_fournisseur_besoin FOREIGN KEY (besoin_selection) REFERENCES ACH_fiche_besoin(fiche_id);

ALTER TABLE ACH_bon_commande ADD CONSTRAINT FK_ACH_bon_commande_besoin FOREIGN KEY (besoin) REFERENCES ACH_fiche_besoin(fiche_id);
ALTER TABLE ACH_bon_commande ADD CONSTRAINT FK_ACH_bon_commande_fournisseur FOREIGN KEY (fournisseur) REFERENCES ENT_fournisseur(CODE);

ALTER TABLE ACH_facture ADD CONSTRAINT FK_ACH_facture_bon_livraison FOREIGN KEY (bon_livraison) REFERENCES ACH_bon_livraison(numero);
ALTER TABLE ACH_facture ADD CONSTRAINT FK_ACH_facture_bon_commande FOREIGN KEY (bon_commande) REFERENCES ACH_bon_commande(numero);

ALTER TABLE ACH_item_facture ADD CONSTRAINT FK_ACH_item_facture_facture FOREIGN KEY (facture) REFERENCES ACH_facture(numero);
ALTER TABLE ACH_bon_livraison ADD CONSTRAINT FK_ACH_bon_livraison_bon_commande FOREIGN KEY (bon_commande) REFERENCES ACH_bon_commande(numero);
ALTER TABLE ACH_item_bon_livraison ADD CONSTRAINT FK_ACH_item_bon_livraison_bon_livraison FOREIGN KEY (bon_livraison) REFERENCES ACH_bon_livraison(numero);
ALTER TABLE ACH_item_bon_commande ADD CONSTRAINT FK_ACH_item_bon_commande_bon_commande FOREIGN KEY (bon_commande) REFERENCES ACH_bon_commande(numero);
ALTER TABLE ACH_fournisseur_postulant ADD CONSTRAINT FK_ACH_fournisseur_postulant_fournisseur FOREIGN KEY (fournisseur) REFERENCES ENT_fournisseur(CODE);
ALTER TABLE ACH_fournisseur_postulant ADD CONSTRAINT FK_ACH_fournisseur_postulant_besoin FOREIGN KEY (besoin) REFERENCES ACH_fiche_besoin(fiche_id);
