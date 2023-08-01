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
                    <div class="rounded mb-3 p-3" style="background: #f4eee1; border: 1px solid #c9a96a">
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
                        <input type="text" class="form-control" id="name" name="name" required="required" autocomplete="off">
                    </div>
                    <div class="form-group mb-2">
                        <label class="labelFeature mb-0" for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off">
                    </div>
                    <div class="form-group mb-2">
                        <label class="labelFeature mb-0" for="phone">Telefone/WhatsApp</label>
                        <input type="text" class="form-control" id="phone" name="phone" required="required" autocomplete="off">
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
        $j('#sent-data').submit(function(event) {
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

            $.ajax({
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
                success: function(response) {
                    console.log('Sucesso (E-mail):', response); // Verifica a resposta do backend de e-mail
                    alert('Dados enviados com sucesso por e-mail!');
                },
                error: function(error) {
                    console.log('Erro (E-mail):', error); // Verifica o erro, se houver, do backend de e-mail
                    alert('Ocorreu um erro ao enviar os dados por e-mail.');
                }
            });

            // Enviar os dados para o WhatsApp Pousada
            $.ajax({
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
                success: function(response) {
                    console.log('Sucesso:', response); // Verifica a resposta do backend
                    alert('Dados enviados com sucesso!');
                },
                error: function(error) {
                    console.log('Erro:', error); // Verifica o erro, se houver
                    alert('Ocorreu um erro ao enviar os dados.');
                }
            });

            // Enviar os dados para o WhatsApp do Hóspede
            $.ajax({
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
                success: function(response) {
                    console.log('Sucesso:', response); // Verifica a resposta do backend
                    alert('Dados enviados com sucesso!');
                },
                error: function(error) {
                    console.log('Erro:', error); // Verifica o erro, se houver
                    alert('Ocorreu um erro ao enviar os dados.');
                }
            });
        });
    });
</script>