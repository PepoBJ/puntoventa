<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=$title?></title>
	<?=$helper->favicon()?>
	<?=$helper->responsive()?>

	<?=$helper->css('ed-grid');?>
	<?=$helper->css('cabezera-footer');?>
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
	
	<section  id="cuerpo">
		<div class="ed-container">
			<div class="ed-item main-center cross-center">
				<h3 class="texto">Bienvenido <?= $usuario->getNombre()?>, Al sistema de Plas Anthony</h3>
			</div>
			<?php if($usuario->getTipo() == "Admin"): ?>
			<div class="ed-item main-center cross-center">
				<a class="registrar" href="<?=$helper->url('usuario', 'registro')?>">Registrar Nuevo Usuario</a>
				<a class="registrar" href="<?=$helper->url('vendedor', 'nuevo')?>">Registrar Nuevo Vendedor</a>
			</div>
			<?php endif; ?>
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