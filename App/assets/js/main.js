// $(document).ready(function () {
//     const ContactsApp = (function () {
//         const init = function () {
//             setupEventListeners();
//             loadContacts();
//         };

//         const setupEventListeners = function () {
//             $('#form').submit(function (event) {
//                 event.preventDefault();
//                 loadContacts();
//             });
//         };

//         const loadContacts = function () {
//             Contacts.getContacts()
//                 .done(renderContacts)
//                 .fail(handleError);
//         };

//         const renderContacts = function (contacts) {
//             const tbody = $('table tbody');
//             tbody.empty();

//             contacts.forEach(contact => {
//                 console.log(contact);
//                 const row = `
//                     <tr>
//                         <td>${contact.full_name}</td>
//                         <td>${contact.birthday}</td>
//                         <td>${contact.mail}</td>
//                         <td>${contact.cellphone}</td>
//                         <td></td>
//                     </tr>
//                 `;
//                 tbody.append(row);
//             });
//         };

//         const handleError = function (error) {
//             console.error(error);
//             console.error('Erro ao obter contatos:', error);
//         };

//         return {
//             init: init,
//         };
//     })();

//     ContactsApp.init();
// });
