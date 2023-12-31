const showToast = (message) => {  
    const toastElm = $('.custom-toast');
    toastElm.find('.toast-body').text(message);

    toastElm.toast('show');

}

const updateContact = async (id) => {
    try {
        const response = await $.ajax(`${location.origin}/api/contact/${id}`);

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
                    url: `${location.origin}/api/contacts/update/${id}`,
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

                showToast('Contato atualizo com sucesso!');

                setTimeout(() => {
                    location.reload(true);
                }, 3000);

  
            } catch (err) {
                console.error(err);
                showToast('Erro ao atualizar o contato!');
            }
        });

    } catch (err) {
        console.error(err);
        showToast('Não foi possível carregar os dados do contato para edição!');
    }
};

const deleteContact = async (contactId) => {
    try {
        await $.ajax({
            url: `${location.origin}/api/contacts/${contactId}`,
            method: 'PUT',
            contentType: 'application/json',
        });

        showToast('Contato excluído com sucesso!');

        setTimeout(() => {
            location.reload(true);
        }, 3000);

    } catch (err) {
        console.error(err);
        showToast('Erro ao atualizar o contato!');
    }
};


const listContacts = async () => {
    try {
        const contacts = await $.ajax(`${location.origin}/api/contacts`);

        $('#contactsId').empty();

        contacts.forEach(contact => {
            $('#contactsId').append(`
                <tr>
                    <td>${contact.full_name}</td>
                    <td>${contact.birthday}</td>
                    <td>${contact.mail}</td>
                    <td>(${contact.cellphone.substring(0, 2)}) ${contact.cellphone.substring(2, 6)}-${contact.cellphone.substring(6)}</td>
                    <td>
                        <button class="btn btn-info" onclick="updateContact(${contact.id})">Editar</button>
                        <button id="btn-delete-contact" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-contact-id="${contact.id}">Excluir</button>
                    </td>
                </tr>
            `);
        });

    } catch (err) {
        console.error(err);
        showToast('Não foi possível listar os contatos!');
    }   
};

$(document).ready(function() {

    const cellphone = $('#cellphone');
    cellphone.inputmask('(99) 99999-9999');

    const phone = $('#phone');
    phone.inputmask('(99) 9999-9999');

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
                    showToast('Contato cadastrado com sucesso!');
            
                    setTimeout(() => {
                        listContacts();
                        $('#form-contact').trigger('reset');
                    }, 2000); 
            
                },
                error: function (err) {
                    console.error(err);
                    showToast('Não foi possível cadastrar o contato!');
                }
            });
            

        } catch (err) {
            console.error(err);
            showToast('Não foi possível cadastrar o contato!');
        }
    };
    

    $(document).on('click', '#btn-delete-contact', function(e) {
        e.preventDefault();
        const contactId = $(this).data('contact-id');
        $('#confirmDeleteModal').data('contact-id', contactId);
        $('#confirmDeleteModal').modal('show');
    });
    
    $('#confirmDeleteBtn').on('click', async function() {
        const contactId = $('#confirmDeleteModal').data('contact-id');
        await deleteContact(contactId);

        $('#confirmDeleteModal').modal('hide');
    });

    const contactELm = $('#form-contact');
    contactELm.on('submit', function (e) {
        e.preventDefault();
        createContact();
    });

    listContacts();
});

