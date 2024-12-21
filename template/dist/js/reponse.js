function showPostulant(besoin,fournisseur){

    const postulant = getPostulant(besoin,fournisseur);

    $(".besoin").val(besoin);
    $(".fournisseur").val(fournisseur);
    $(".note_financier").val(postulant.note_financier);
    $(".note_emmetteur").val(postulant.note_emmetteur);
    $(".motivation_financier").val(postulant.motivation_financier);
    $(".motivation_emmetteur").val(postulant.motivation_emmetteur);
    $(".date_postulat").val(postulant.date_postulat);

    $('.offre_technique').attr('href',`Files/OffreTechnique/${postulant.offre_technique}`);
    $('.offre_financiere').attr('href',`Files/OffreFinanciere/${postulant.offre_financiere}`);

    back('.list_besoin','.mod_besoin');
}