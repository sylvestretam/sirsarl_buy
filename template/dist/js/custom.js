function showImmo(code)
{
    const immo = getImmo(code);

    $('.code').val(code);
    $('.designation').val(immo.designation);
    $('.date_acquisition').val(immo.date_acquisition);
    $('.date_mise_en_service').val(immo.date_mise_en_service);
    $('.valeur_origine').val(immo.valeur_origine);
    $('.valeur_origine_entree').val(immo.valeur_origine_entree);
    $('.valeur_residuelle').val(immo.valeur_residuelle);
    $('.exercice_entree').val(immo.exercice_entree);
    $('.taux_ammortissement').val(immo.taux_ammortissement);
    $('.fournisseur').val(immo.fournisseur);

    back('.list_immo','.mod_immo');
}

function showExercice(code,exercice)
{
    const ammortissement = getAmmortissement(code,exercice);
    const immobilisation_exercice = getImmobilisation_exercice(code,exercice);

    $('.immobilisation').val(code);
    $('.exercice').val(exercice);

    $('.a_nouveau_ammort').val("");
    $('.dotation').val("");
    $('.a_nouveau').val("");
    $('.entree').val("");
    $('.sortie').val("");

    if( ammortissement != null){
        $('.a_nouveau_ammort').val(ammortissement.a_nouveau);
        $('.dotation').val(ammortissement.dotation);
    }

    if( immobilisation_exercice != null){
        $('.a_nouveau').val(immobilisation_exercice.a_nouveau);
        $('.entree').val(immobilisation_exercice.entree);
        $('.sortie').val(immobilisation_exercice.sortie);
    }

    back('.list_exercice','.mod_exercice');
}

