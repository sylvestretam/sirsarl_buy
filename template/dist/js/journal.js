function showJournal(numero_pja){

    const log = getLog(numero_pja);

    $(".numero_pja").val(numero_pja);
    $(".facture").val(log.facture);
    $(".date_facturation").val(log.date_facturation);
    $(".fournisseur").val(log.fournisseur);
    $(".libelle").val(log.libelle);
    $(".montant_total").val(log.montant_total);
    $(".motif").val(log.motif);

    let text_debit ="";
    let text_credit ="";
    
    (log.ITEMS).forEach(element => {
        let txt = 
            `<tr>
                <td> ${element.compte} </td>
                <td> ${element.montant} </td>
            </tr>`;

        if(element.type_operation == "DEBIT")
            text_debit = text_debit.concat(txt);
        else 
            text_credit = text_credit.concat(txt);
    });

    $(".ligneitemjournaldebit").html(text_debit);
    $(".ligneitemjournalcredit").html(text_credit);

    back('.list_besoin','.mod_besoin');
}

function feedJournal(e){
    const numero = $(e).val();
    const facture = getFacture(numero);
    $('.libelle').val( facture.libelle );
    $('.montant_total').val( facture.total );
    $('.fournisseur').val( facture.fournisseur );
    $('.date_facturation').val( facture.date_facturation );
}

let ITEMS_JOURNALS = {};

function addItemJournal()
{
    let compte = $('#compte').val();
    let type_operation = $('#type_operation').val();
    let montant = $('#montant').val();

    if(compte ==null || type_operation == "" || montant == "")
    {
        $('.txt_message_error').html("Veuillez remplir tous les champs");
        $('.sect_error').removeClass('invisible');
    }
    else
    {
        ITEMS_JOURNALS[compte] = {"type_operation":type_operation,"montant":montant};
        $('.itemjournal').val( JSON.stringify(ITEMS_JOURNALS) );
        writeItemJournal(ITEMS_JOURNALS,'.ligneitemjournal');
    }
}

function removeItemJournal(idligne)
{
    $(`#${idligne}`).addClass("invisible");
    delete ITEMS_JOURNALS[idligne];
    if( Object.keys(ITEMS_JOURNALS).length > 0)
        $('.itemjournal').val( JSON.stringify(ITEMS_JOURNALS) );
    else
        $('.itemjournal').val( "" );   
}

function writeItemJournal(lignes,tbody)
{
    let text ="";
    for (const element in lignes) {
        
        let txt = 
            `<tr id="${element}">
                <td> ${element} </td>
                <td> ${lignes[element].type_operation} </td>
                <td> ${lignes[element].montant} </td>
                <td> 
                    <button type="button" onclick="removeItemJournal('${element}')"> 
                        <i class="fas fa-trash" aria-hidden="true"></i> 
                    </button>
                </td>
            </tr>`;
        text = text.concat(txt); 
    }
    
    $(tbody).html(text);
}
