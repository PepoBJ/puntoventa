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
	<?=$helper->css('home');?>
</head>
<body>
	<header>
		<?= $this->view('Template/Cabezera');?>
	</header>
	<nav>
		<?= $this->view('Template/Menu', $datos_template);?>
	</nav>

	<section>
		<div class="ed-container" id="cuerpo">
			<div class="ed-item tablet-50 centrar">	
				<form class="formulario" action="<?= $helper->url('usuario', 'registro');?>" method="post" name="registro">
				<div class="ed-container">
					<div class="ed-item main-center cross-center">
						<h1 class="formulario__item formulario__titulo">REGISTRO</h1>
					</div>
					<div class="ed-item main-center cross-center">
						<span class="formulario__item formulario__<?=@$class_mensaje?>"><?=@$mensaje?></span>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__email base-100 tablet-50" name="email" type="text" placeholder="Email" value="<?=$email?>" autofocus required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__nombre base-100 tablet-50" name="nombre" type="text" placeholder="Nombres" value="<?=$nombre?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__apellido base-100 tablet-50" name="apellido" type="text" placeholder="Apellidos" value="<?=$apellido?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__password base-100 tablet-50" name="contrasena" type="password" placeholder="Contraseña" required>
					</div>
					<div class="ed-item main-center cross-center">
						 <select class="formulario__selector base-100 tablet-50" name="tipo">
							<option value="Normal">Normal</option>
							<option value="Admin">Administrador</option>
						</select> 
					</div>
					<div class="ed-item main-center cross-center">
						<select class="formulario__selector base-100 tablet-50" name="estado">
							<option value="Activo">Activo</option>
							<option value="Inactivo">Inactivo</option>
						</select> 
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__enviar base-100 tablet-50" type="submit" value="REGISTRARSE">
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