const listContacts = async () => {
    try {
        const contacts = await $.ajax(`${location.origin}/api/contacts`);

        if(!contacts.length) alert("No contacts");

        contacts.forEach(contact => {
            $('#contactsId').append(`
                <tr>
                    <td>${contact.full_name}</td>
                    <td>${contact.birthday}</td>
                    <td>${contact.mail}</td>
                    <td>${contact.cellphone}</td>
                    <td>
                    </td>
                </tr>
            `)
        });

    } catch (err) {
        console.error(err);
        alert('Não foi possível listar os contatos!');
    }
};


$(document).ready(function() {

    //mask
    const cellphone = $('#cellphone');
    cellphone.inputmask('(99) 99999-9999');

    const phone = $('#phone');
    phone.inputmask('(99) 9999-9999');

    const contactELm = $('#form-contact');

    contactELm.on('submit', async event => {

        event.preventDefault();

        try {

            const payload = {
                full_name: $('#fullName').val(),
                mail: $('#mail').val(),
                phone: $('#phone').val(),
                birthday: $('#birthday').val(),
                occupation: $('#occupation').val(),
                cellphone: $('#cellphone').val(),
                have_whatsapp: $('#whatsapp_check').prop('checked') ? 1 : 0,
                send_mail_permission: $('#email_check').prop('checked') ? 1 : 0,
                send_sms_permission: $('#sms_check').prop('checked') ? 1 : 0
            } 

            payload.have_whatsapp = parseInt(payload.have_whatsapp);
            payload.send_mail_permission = parseInt(payload.send_mail_permission);
            payload.send_sms_permission = parseInt(payload.send_sms_permission);
            
            await $.ajax({
                url: `${location.origin}/api/contacts`,
                method: 'POST',
                data: payload,
                success: function () {

                    listContacts();

                    contactELm.trigger('reset');
                },
                error: function (err) {
                    console.error(err);
                    alert('Não foi possível cadastrar o contato!');
                }
            });

        } catch (err) {
            console.error(err);
            alert('Não foi possível cadastrar o contato!');
        }
    });

}); 



listContacts();
