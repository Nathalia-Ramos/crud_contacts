const updateContact = async (contactId) => {
    try {
        const response = await $.ajax(`${location.origin}/api/contact/${contactId}`);

        const contact = JSON.parse(response)[0];

        $('#fullName').val(contact.full_name);
        $('#birthday').val(contact.birthday);
        $('#mail').val(contact.mail);
        $('#cellphone').val(contact.cellphone);
        $('#occupation').val(contact.occupation);
        $('#phone').val(contact.phone); 
        
        $('#submitButton').text('Atualizar Contato');

        $('.btn-primary').on('click', async (e) => {
            try {
                await $.ajax({
                    url: `${location.origin}/api/contacts/update/${contactId}`,
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        full_name: $('#fullName').val(),
                        birthday: $('#birthday').val(),
                        mail: $('#mail').val(),
                        cellphone: $('#cellphone').val(),
                        occupation: $('#occupation').val(),
                        phone: $('#phone').val()
                    }),
                });
                e.preventDefault();
                location.reload(true);
            } catch (err) {
                console.error(err);
                alert('Erro ao atualizar o contato!');
            }
        });

    } catch (err) {
        console.error(err);
        alert('Não foi possível carregar os dados do contato para edição!');
    }
};

const deleteContact = async (contactId) => {
    try {
        await $.ajax({
            url: `${location.origin}/api/contacts/${contactId}`,
            method: 'PUT',
            contentType: 'application/json',
        });

        alert('contato excluído com sucesso');
        location.reload(true);
    } catch (err) {
        console.error(err);
        alert('Erro ao atualizar o contato!');
    }
};

const listContacts = async () => {
    try {
        const contacts = await $.ajax(`${location.origin}/api/contacts`);

        if (!contacts.length) alert("No contacts");

        $('#contactsId').empty();

        contacts.forEach(contact => {
            $('#contactsId').append(`
                <tr>
                    <td>${contact.full_name}</td>
                    <td>${contact.birthday}</td>
                    <td>${contact.mail}</td>
                    <td>${contact.cellphone}</td>
                    <td>
                        <button class="btn btn-info" onclick="updateContact(${contact.id})">Editar</button>
                        <button class="btn btn-danger" onclick="deleteContact(${contact.id})">Excluir</button>
                    </td>
                </tr>
            `);
        });

    } catch (err) {
        console.error(err);
        alert('Não foi possível listar os contatos!');
    }   
};

$(document).ready(function() {

    // mask - descomentar depois
    // const cellphone = $('#cellphone');
    // cellphone.inputmask('(99) 99999-9999');

    // const phone = $('#phone');
    // phone.inputmask('(99) 9999-9999');

    const createContact = async () => {
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
            };

            payload.have_whatsapp = parseInt(payload.have_whatsapp);
            payload.send_mail_permission = parseInt(payload.send_mail_permission);
            payload.send_sms_permission = parseInt(payload.send_sms_permission);

            await $.ajax({
                url: `${location.origin}/api/contacts`,
                method: 'POST',
                data: payload,
                success: function () {
                    listContacts();
                    $('#form-contact').trigger('reset');
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
    };

    const contactELm = $('#form-contact');
    contactELm.on('submit', function (event) {
        event.preventDefault();
        createContact();;
    });

    listContacts();
});

