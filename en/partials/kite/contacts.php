<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include 'layout/head.php'	?>
    <!-- Mapbox-->
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
	<?php include 'layout/preloader.php'; ?>
	<?php include 'layout/header.php'; ?>
	
	<!-- Content -->
	<main class="main">
		<?php include 'partials/contacts/intro.php'; ?>
		<?php include 'layout/contact_info.php'; ?>
		<?php include 'partials/contacts/contacts.php'; ?>
		<!-- Map -->
		<div class="map-bottom" id="map"></div>
	</main>
	<!-- /Content -->
	<?php include 'layout/footer.php'; ?>
	<?php include 'layout/chat.php'; ?>
	<?php include 'layout/scripts.php'; ?>
    <!-- Mapbox init -->
	<script src="assets/js/mapbox.init.js"></script>	
</body>
</html>