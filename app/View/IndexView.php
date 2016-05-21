<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=$title?></title>
	<?=$helper->favicon()?>
	<?=$helper->responsive()?>

	<?=$helper->css('ed-grid');?>
	<?=$helper->css('cabezera-footer');?>
	<?=$helper->css('formulario');?>
	<?=$helper->css('index');?>
</head>
<body>
	<header>
		<?= $this->view('Template/Cabezera');?>
	</header>

	<section>
		<div class="ed-container" id="cuerpo">
			<div class="ed-item tablet-50 centrar">	
				<form class="formulario" action="<?= $helper->url('index', 'login');?>" method="post" name="login">
				<div class="ed-container">
					<div class="ed-item main-center cross-center">
						<h1 class="formulario__item formulario__titulo">INGRESO</h1>
					</div>
					<div class="ed-item main-center cross-center">
						<span class="formulario__item formulario__error"><?=@$error?></span>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__dni base-100 tablet-50" name="dni" type="text" placeholder="DNI" value="<?=$dni?>" maxlength="8" minlength="8" autofocus required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__password base-100 tablet-50" name="password" type="password" placeholder="Contraseña" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__enviar base-100 tablet-50" type="submit" value="ENTRAR">
					</div>
					<div class="ed-item main-center cross-center">
						<a href="<?=$helper->url('index', 'registro')?>" class="formulario__item formulario__registro base-100 tablet-50">Registro</a>
					</div>
				</div>
				</form>
			</div>
		</div>
	</section>

	<footer>
		<?= $this->view('Template/Footer', $datos_template);?>
	</footer>
	
	<?=$helper->js('jquery');?>
	<?=$helper->js('variables-globales');?>
	<?=$helper->js('eventos');?>
</body>
</html>