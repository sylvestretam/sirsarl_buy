function showLivraison(numero)
{
    const livraison = getLivraison(numero);

    $('.numero').val(livraison.numero);
    $('.date_livraison').val(livraison.date_livraison);
    $('.bon_commande').val(livraison.bon_commande);
    $('.statut_commande').val(livraison.statut_commande);

    $('.fichier').attr('src',`Files/BonLivraison/${livraison.adresse_fichier}`);

    if( livraison.statut_execution == "DRAFT")
        $( "#statut_draft" ).prop( "checked", true );
    else if( livraison.statut_execution == "ABORT"){
        $( "#statut_abort" ).prop( "checked", true );
    }

    let text ="";
    // alert(JSON.stringify(livraison.ITEMS));
    (livraison.ITEMS).forEach(element => {
        let txt = 
            `<tr>
                <td> ${element.designation} </td>
                <td> ${element.quantite} </td>
            </tr>`;
        text = text.concat(txt); 
    });
    
    $('.ligneitemlivraisonmod').html(text);

    back('.list_commande','.mod_commande');
}

let ITEMS_LIVRAISONS = {};

function addItemLivraison()
{
    let item = $('#item').val();
    let quantite = $('#quantite').val();

    if(quantite =="" || item == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        ITEMS_LIVRAISONS[UUID(item)] = {"item":item,"quantite":quantite};
        $('.itemlivraison').val( JSON.stringify(ITEMS_LIVRAISONS) );
        writeItemLivraison(ITEMS_LIVRAISONS,'.ligneitemlivraison');
    }
}

function removeItemLivraison(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete ITEMS_LIVRAISONS[idligne];
    if( Object.keys(ITEMS_LIVRAISONS).length > 0)
        $('.itemlivraison').val( JSON.stringify(ITEMS_LIVRAISONS) );
    else
        $('.itemlivraison').val( "" );   
}

function writeItemLivraison(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        
        let txt = 
            `<tr id="${element}">
                <td> ${lignes[element].item} </td>
                <td> ${lignes[element].quantite} </td>
                <td> 
                    <button type="button" onclick="removeItemLivraison('${element}')"> 
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