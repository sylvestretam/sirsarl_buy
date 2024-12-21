function showBesoin(besoin_id){

    const besoin = getBesoin(besoin_id);

    // alert( besoin_id );
    // alert( JSON.stringify(besoin) );

    $(".fiche_id").val(besoin.fiche_id);
    $(".nature").val(besoin.nature);
    $(".description").val(besoin.description);
    $(".statut").val(besoin.statut);
    $(".date_emmission").val(besoin.date_fiche);

    $(".fichier").attr("href", `Files/Besoin/${besoin.adresse_fichier}`);

    if( besoin.statut != "DRAFT" )
        $(".rejeter").attr('disabled', 'disabled');
    else
    {
        $(".rejeter").removeAttr("disabled");
        $(".rejeter")[0].checked = false;
    }

    if( besoin.statut == "REJETER" )
        $(".rejeter")[0].checked = true;

    back('.list_besoin','.mod_besoin');
}