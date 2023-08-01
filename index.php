<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include 'layout/head.php'; ?>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
	<style>
    /* Remover estilo .form-control:focus */
	.iti {
		display: inherit !important;
	}
	#sent-data input {
		-webkit-text-fill-color: #2c3f58 !important;
	}
	.form-control {
		font-size: 0.875rem;
	}
	.form-control:focus {
		outline: none; /* Remove o contorno quando o input está em foco */
		box-shadow: none; /* Remove qualquer sombra ao redor do input */
		border: 1px solid #c9a96a;
	}
  </style>
</head>
<body>
	<?php include 'layout/preloader.php'; ?>
	<?php include 'layout/header.php'; ?>
	<!-- Content -->
	<main class="main">
		<?php include 'partials/home/slider.php'; ?>
		<?php include 'partials/home/booking.php'; ?>
		<?php include 'partials/modals/modal_booking.php'; ?>
		<?php include 'partials/home/about_us.php'; ?>
		<?php include 'partials/home/rooms.php'; ?>
		<?php include 'partials/home/features.php'; ?>
		<?php include 'partials/home/testimonials.php'; ?>				
		<?php include 'layout/cta.php'; ?>
	</main>
	<!-- /Content -->
	<?php include 'layout/footer.php'; ?>   
	<?php include 'layout/chat.php'; ?>
	<?php include 'layout/scripts.php'; ?>
	<script>
	$(document).ready(function() {
		// Função para calcular o número de diárias entre as datas de check-in e check-out
		function calcularDiarias(checkInStr, checkOutStr) {
		const checkInDate = convertToDate(checkInStr);
		const checkOutDate = convertToDate(checkOutStr);
		const timeDifference = checkOutDate - checkInDate;
		const oneDayInMilliseconds = 24 * 60 * 60 * 1000;
		return Math.floor(timeDifference / oneDayInMilliseconds);
		}

		// Função para converter a data no formato "dd/mm/yy" para objeto Date
		function convertToDate(dateStr) {
		const [day, month, year] = dateStr.split("/");
		return new Date(`20${year}`, month - 1, day);
		}

		// Manipule o evento de envio do formulário
		$("#booking").submit(function(e) {
		// Evite o envio padrão do formulário
		e.preventDefault();

		// Obtenha os valores dos campos do formulário
		var checkIn = $("#check-in").val();
		var checkOut = $("#check-out").val();
		var guests = $("#person-adult").val() + " adulto(s) e " + $("#person-kids").val() + " criança(s)";

		// Calcular o número de diárias
		var nights = calcularDiarias(checkIn, checkOut);

		// Preencha o modal com os valores do formulário e o número de diárias
		$("#modal-check-in").text(checkIn);
		$("#modal-check-out").text(checkOut);
		$("#modal-guests").text(guests);
		$("#modal-nights").text(nights);

		// Exiba o modal
		$("#booking-modal").modal("show");
		});
	});
	</script>
</body>
</html>