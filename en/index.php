<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<?php include 'layout/head.php'; ?>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
	<style>
    /* Remover estilo .form-control:focus */
	.iti {
		display: inherit !important;
	}
	#sent-data input {
		-webkit-text-fill-color: #2c3f58 !important;
	}
	.inputText {
		font-size: 0.9rem;
	}
	.swal2-modal {
		padding: 20px !important;
	}
	.swal2-title {
		padding: 0 !important;
		color: inherit !important;
		font-size: 1.25rem !important;
	}
	.swal2-html-container {
		padding-top: 1.5rem !important;
		padding-bottom: 0 !important;
		font-size: inherit !important;
		color: inherit !important
	}
	.swal2-confirm {
		border-radius: 50px !important;
		background-color: #105063 !important;
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
		var guests = $("#person-adult").val() + " adult(s) and " + $("#person-kids").val() + " kid(s)";

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