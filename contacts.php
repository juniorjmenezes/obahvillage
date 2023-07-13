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
        <section class="container section section-first">
		    <div class="row">
			    <div class="col-12">
				    <h1 class="title title--h1 js-lines">Encontre-nos.</h1>
				</div>
			</div>
			<div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-contact js-scroll-show">
				    <h4 class="title title--h4">Endereço</h4>
					<p class="paragraph">Vila Preá, SN<br>Preá - Ceará - Brasil</p>
				</div>
				<div class="col-12 col-md-6 col-lg-4 col-contact js-scroll-show">
				    <h4 class="title title--h4">Reservas</h4>
					<p class="paragraph">reservas@obahvillage.com.br<br>+55 (88) 9 9664-2583</p>
				</div>
				<div class="col-12 col-md-6 col-lg-4 col-contact js-scroll-show">
				    <h4 class="title title--h4">Siga-nos</h4>
					<p class="paragraph">Conect-se conosco no  <a class="link-underline" href="#">facebook</a>,<br><a class="link-underline" href="#">twitter</a> or <a class="link-underline" href="https://instagram.com/pousadaobahvillage_?igshid=MzRlODBiNWFlZA==">instagram</a></p>
				</div>
			</div>
		</section>
		
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