function showCommande(numero)
{
    const commande = getCommande(numero);

    $('.numero').val(commande.numero);
    $('.date_emmission').val(commande.date_emmission);
    $('.fournisseur').val(commande.fournisseur);
    $('.besoin').val(commande.besoin);
    $('.statut').val(commande.statut);
    $('.debours').val(commande.debours);
    $('.commission').val(commande.commission);
    $('.date_abort').val(commande.date_abort);

    $('.fichier').attr('src',`Files/BonCommande/${commande.adresse_fichier}`);

    $( "#statut_draft" ).prop( "checked", true );

    if( commande.statut == "DRAFT")
        $( "#statut_draft" ).prop( "checked", true );
    else if( commande.statut == "TRANSMIT")
        $( "#statut_transmit" ).prop( "checked", true );
    else if( commande.statut == "ABORT"){
        $( "#statut_abort" ).prop( "checked", true );

        $( "#statut_abort" ).attr( "disabled", "disabled" );
        $( "#statut_transmit" ).attr( "disabled", "disabled" );
    }

    let text ="";
    
    (commande.ITEMS).forEach(element => {
        let txt = 
            `<tr>
                <td> ${element.designation} </td>
                <td> ${element.quantite} </td>
                <td> ${element.prix_unitaire} </td>
                <td> ${element.prix_unitaire*element.quantite} </td>
            </tr>`;
        text = text.concat(txt); 
    });
    
    $('.itemBonCommandes').html(text);

    back('.list_commande','.mod_commande');
}

let ITEMS_COMMANDES = {};

function addItemCommande()
{
    let item = $('#item').val();
    let quantite = $('#quantite').val();
    let pu = $('#pu').val();

    if(quantite =="" || pu == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        ITEMS_COMMANDES[item] = {"quantite":quantite,"pu":pu};
        $('.itemcommande').val( JSON.stringify(ITEMS_COMMANDES) );
        writeItemCommande(ITEMS_COMMANDES,'.ligneitemcommande');
    }
}

function removeItemCommande(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete ITEMS_COMMANDES[idligne];
    if( Object.keys(ITEMS_COMMANDES).length > 0)
        $('.itemcommande').val( JSON.stringify(ITEMS_COMMANDES) );
    else
        $('.itemcommande').val( "" );   
}

function writeItemCommande(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        let txt = 
            `<tr id="${element}">
                <td> ${element} </td>
                <td> ${lignes[element].quantite} </td>
                <td> ${lignes[element].pu} </td>
                <td> ${lignes[element].pu * lignes[element].quantite} </td>
                <td> 
                    <button type="button" onclick="removeItemCommande('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}