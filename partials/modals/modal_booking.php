<!-- Modal -->
<div class="modal fade border-0" id="booking-modal" tabindex="-1" role="dialog" aria-labelledby="booking-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 0">
            <div class="modal-header">
                <h5 class="modal-title" id="booking-modal-label">Vamos preparar sua reserva?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="sent-data" autocomplete="off">
                <div class="modal-body">
                    <!-- Aqui você pode exibir os detalhes da reserva -->
                    <div class="rounded mb-3 p-3" style="background: #f4eee1; border: 1px solid #c9a96a; line-height: 1.2rem">
                        <div class="row">
                            <div class="col text-center">
                            <div class="labelFeature mb-0">Check-in <span class="font-weight-bold" style="color: #2c3f58" id="modal-check-in"></span></div>
                            </div>
                            <div class="col text-center">
                            <div class="labelFeature mb-0">Check-out <span class="font-weight-bold" style="color: #2c3f58" id="modal-check-out"></span></div>
                            </div>
                            <div class="col text-center">
                            <div class="labelFeature mb-0">Diárias <br><span class="font-weight-bold" style="color: #2c3f58" id="modal-nights"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="labelFeature mb-0" for="nome">Nome</label>
                        <input type="text" class="inputText" id="name" name="name" required="required" autocomplete="off">
                    </div>
                    <div class="form-group mb-2">
                        <label class="labelFeature mb-0" for="email">E-mail</label>
                        <input type="email" class="inputText" id="email" name="email" autocomplete="off">
                    </div>
                    <div class="form-group mb-2">
                        <label class="labelFeature mb-0" for="phone">Telefone/WhatsApp</label>
                        <input type="text" class="inputText" id="phone" name="phone" required="required" autocomplete="off">
                    </div>
                    <div class="small mt-3 mb-1" style="line-height: 0.8rem"><span class="text-danger mr-2">*</span><span class="small">Lembramos que até o momento não foi efetuado nenhum bloqueio de disponibilidade de apartamento ou tarifa e os mesmos estão sujeitos à alteração sem aviso prévio.</span></div>
                    <div class="small mt-3 mb-3" style="line-height: 0.8rem"><span class="text-danger mr-2">**</span><span class="small">Reservas também podem ser feitas através do telefone/WhatsApp: +55 88 99664-2583.</span></div>
                    <button type="submit" class="btn btn-secondary w-100 d-flex flex-column"><p class="text-center">Consultar Disponibilidade para</p><div class="text-center" id="modal-guests"></div></button>
                </div>

            </form>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $j = jQuery.noConflict();

    $j(document).ready(function() {
        // Input phone
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "br",
            separateDialCode: true,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                return '' + selectedCountryPlaceholder.replace(/[0-9]/g, 'X');
            },
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
        });

        $j('input#phone').on("focus click countrychange", function(e, countryData) {
            var pl = $(this).attr('placeholder') + '';
            var res = pl.replace(/X/g, '9');
            if (res !== 'undefined') {
                $j(this).inputmask(res, {
                    placeholder: "X",
                    clearMaskOnLostFocus: true
                });
            }
        });

        // Interceptar o evento de envio do formulário
        $('#sent-data').submit(function(event) {
        event.preventDefault(); // Impede o comportamento padrão do envio do formulário
        // Obter os dados do formulário
        const checkin = document.getElementById('modal-check-in').innerText;
        const checkout = document.getElementById('modal-check-out').innerText;
        const nights = document.getElementById('modal-nights').innerText;
        const guests = document.getElementById('modal-guests').innerText;
        const name = $('#name').val();
        const email = $('#email').val();
        //const code = ;
        const phone = $('.iti__selected-dial-code').text() +  $('#phone').val();
        //console.log(code);

        // Array para armazenar as promessas das requisições
        const promises = [];

        // Função para enviar a mensagem usando o SweetAlert2
        function showSuccessMessage() {
            Swal.fire({
                position: 'top-end',
                title: 'Obah! Agora é só aguardar...',
                text: 'Já recebemos o seu pedido. Aguarde nosso contato para a confirmação de sua reserva!',
                confirmButtonText: 'Fechar',
                customClass: {
                    confirmButton: 'btn btn-secondary',
                },
                }).then(() => {
                // Fechar o modal após exibir a mensagem de sucesso
                $('#booking-modal').modal('hide');
            });
        }

        // Função para enviar a mensagem de erro usando o SweetAlert2
        function showErrorMessage() {
            Swal.fire({
                position: 'top-end',
                title: 'Ah não! Tente novamente...',
                text: 'Ocorreu um erro ao enviar os dados.',
                confirmButtonText: 'Fechar',
                customClass: {
                    confirmButton: 'btn btn-danger',
                },
            });
        }

        // Enviar os dados para o backend de e-mail
        promises.push($.ajax({
            url: 'backend_mail.php',
            method: 'POST',
            data: {
                checkin: checkin,
                checkout: checkout,
                nights: nights,
                guests: guests,
                name: name,
                email: email,
                phone: phone
            },
        }));

        // Enviar os dados para o WhatsApp Pousada
        promises.push($.ajax({
            url: 'backend_hotel.php',
            method: 'POST',
            data: {
                checkin: checkin,
                checkout: checkout,
                nights: nights,
                guests: guests,
                name: name,
                email: email,
                phone: phone
            },
        }));

        // Enviar os dados para o WhatsApp do Hóspede
        promises.push($.ajax({
            url: 'backend_client.php',
            method: 'POST',
            data: {
                checkin: checkin,
                checkout: checkout,
                nights: nights,
                guests: guests,
                name: name,
                email: email,
                phone: phone
            },
        }));

        // Usar Promise.all para aguardar todas as requisições terminarem
        Promise.all(promises)
            .then(function(responses) {
                // Todas as requisições foram bem-sucedidas
                console.log('Sucesso:', responses);
                showSuccessMessage();
            })
            .catch(function(errors) {
                // Pelo menos uma requisição falhou
                console.log('Erro:', errors);
                showErrorMessage();
            });
		});
    });
</script>