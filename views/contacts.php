<!DOCTYPE html>
<html lang="PT-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../App/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <title>Contatos</title>
</head>
    <body>
        <div class="container d-flex justify-content-start pt-3 mb-4" style="background-color: #068ED0; ">
            <div class="row">
            <div class="col-2">
                <img src="../App/images/logo_alphacode.png" alt="Logo" class="img-fluid">
            </div>
            <div class="col-10">
                <h1 class="text-white">Cadastro de contatos</h1>
            </div>
            </div>
        </div>
        <form id="form">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" id="fullName" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="mail" name="mail" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone para contato</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Data de nascimento</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>
                        <div class="mb-3">
                            <label for="occupation" class="form-label">Profissão</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" required>
                        </div>
                        <div class="mb-3">
                            <label for="cellphone" class="form-label">Celular para contato</label>
                            <input type="tel" class="form-control" id="cellphone" name="cellphone" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                    <div class="col-6 mb-3">
                            <input class="form-check-input" type="checkbox" id="whatsapp-check" name="has_whatsapp">
                            <label class="form-check-label" for="whatsapp-check">Número de celular possui Whatsapp</label>
                        </div>
                        <div class="col-6">
                            <input class="form-check-input" type="checkbox" id="email-check" name="send_email">
                            <label class="form-check-label" for="email-check">Enviar notificações por E-mail</label>
                        </div>
                        <div class="col-6">
                            <input class="form-check-input" type="checkbox" id="sms-notify-check" name="send_sms">
                            <label class="form-check-label" for="sms-check">Enviar notificações por SMS</label>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Cadastrar Contato</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-white" style="background-color: #068ED0;">Nome</th>
                    <th scope="col" class="text-white" style="background-color: #068ED0;">Data de Nascimento</th>
                    <th scope="col" class="text-white" style="background-color: #068ED0;">E-mail</th>
                    <th scope="col" class="text-white" style="background-color: #068ED0;">Celular para Contato</th>
                    <th scope="col" class="text-white" style="background-color: #068ED0;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>1990-01-01</td>
                    <td>john.doe@example.com</td>
                    <td>(123) 456-7890</td>
                    <td>     
                </tr>  
            </tbody>
        </table>
        <div class="container" style="background-color: #068ED0">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 mt-5 border-top ">
                    <div class="text-light">Termos | Políticas</div>
                    <div class="text-light">
                        &copy; Copyright 2023 | Desenvolvido por
                        <img src="../App/images/logo_rodape_alphacode.png" alt="Logo" style="height: 50px;" />
                    </div>
                    <div class="text-light">&copy; Alphacode IT Solutions 2023</div>
                </footer>
        </div>
    </body>
</html>