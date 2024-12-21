function back(active,future)
{
    $(active).addClass('invisible');
    $(future).removeClass('invisible');
}

function format(number)
{
    var options = {maximumFractionDigits:2};
    return number.toFixedDown(2);
}

function getBesoin(fiche_id)
{
    return fiches_besoins.find(element=> element.fiche_id == fiche_id);
}

function getCommande(numero)
{
    return commandes.find(element=> element.numero == numero);
}

function getLivraison(numero)
{
    return livraisons.find(element=> element.numero == numero);
}

function getFacture(numero)
{
    return factures.find(element=> element.numero == numero);
}

function getPostulant(besoin,fournisseur)
{
    return postulants.find(element=> element.besoin == besoin && element.fournisseur == fournisseur);
}

function getLog(numero_pja)
{
    return logs.find(element=> element.numero_pja == numero_pja);
}