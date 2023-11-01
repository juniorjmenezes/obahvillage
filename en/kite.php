<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include 'layout/head.php'	?>
	<style>#features-kite {
		background-image: url("assets/images/sand_bg.jpg");
		background-repeat: repeat !important;
		}
	</style>
</head>
<body>
	<?php include 'layout/preloader.php'; ?>
	<?php include 'layout/header.php'; ?>
	
	<!-- Content -->
	<main class="main">
		<?php include 'partials/kite/intro.php'; ?>
		<?php include 'layout/contact_info.php'; ?>
		<?php include 'partials/kite/kite.php'; ?>
		<?php include 'partials/kite/features.php'; ?>
		<?php include 'layout/cta.php'; ?>
	</main>
	<!-- /Content -->
	<?php include 'layout/footer.php'; ?>
	<?php include 'layout/chat.php'; ?>
	<?php include 'layout/scripts.php'; ?>
</body>
</html>