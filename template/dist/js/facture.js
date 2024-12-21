function showFacture(numero)
{
    const facture = getFacture(numero);

    $('.numero').val(facture.numero);
    $('.date_facturation').val(facture.date_facturation);
    $('.total').val(facture.total);
    $('.bon_livraison').val(facture.bon_livraison);
    $('.debours').val(facture.debours);
    $('.commission').val(facture.commission);
    $('.fournisseur').val(facture.fournisseur);

    $('.fichier').attr('src',`Files/Facture/${facture.adresse_fichier}`);

    // if( livraison.statut_execution == "DRAFT")
    //     $( "#statut_draft" ).prop( "checked", true );
    // else if( commande.statut == "TRANSMIT")
    //     $( "#statut_transmit" ).prop( "checked", true );
    // else if( commande.statut == "ABORT"){
    //     $( "#statut_abort" ).prop( "checked", true );
    // }

    let text ="";
    // alert(JSON.stringify(facture.ITEMS));
    (facture.ITEMS).forEach(element => {
        let txt = 
            `<tr>
                <td> ${element.item_id} </td>
                <td> ${element.designation} </td>
                <td> ${element.quantite} </td>
                <td> ${element.prix_unitaire} </td>
            </tr>`;
        text = text.concat(txt); 
    });
    
    $('.ligneitemfacturemod').html(text);

    back('.list_commande','.mod_commande');
}

let ITEMS_FACTURES = {};

function addItemFacture()
{
    let item = $('#item').val();
    let quantite = $('#quantite').val();
    let pu = $('#pu').val();

    if(quantite =="" || item == "" || pu == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        ITEMS_FACTURES[UUID(item)] = {"item":item,"quantite":quantite,"pu":pu};
        $('.itemfacture').val( JSON.stringify(ITEMS_FACTURES) );
        writeItemFacture(ITEMS_FACTURES,'.ligneitemfacture');
    }
}

function removeItemFacture(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete ITEMS_FACTURES[idligne];
    if( Object.keys(ITEMS_FACTURES).length > 0)
        $('.itemfacture').val( JSON.stringify(ITEMS_FACTURES) );
    else
        $('.itemfacture').val( "" );   
}

function writeItemFacture(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        
        let txt = 
            `<tr id="${element}">
                <td> ${lignes[element].item} </td>
                <td> ${lignes[element].quantite} </td>
                <td> ${lignes[element].pu} </td>
                <td> 
                    <button type="button" onclick="removeItemFacture('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}

function UUID(str) {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        hash += str.charCodeAt(i);
    }
    return hash.toString(16); // Convertir en hexadécimal
}