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
				<form class="formulario" action="<?= $helper->url('gastos', 'nuevo');?>" method="post" name="registro">
				<div class="ed-container">
					<div class="ed-item main-center cross-center">
						<h1 class="formulario__item formulario__titulo">NUEVA GASTO</h1>
					</div>
					<div class="ed-item main-center cross-center">
						<span class="formulario__item formulario__<?=@$class_mensaje?>"><?=@$mensaje?></span>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__dni base-100 tablet-50" name="codigo" type="text" placeholder="Codigo Boleta Gastos" value="<?=$codigo?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__nombre base-100 tablet-50" name="nombre" type="text" placeholder="Nombre Recepcionista" value="<?=$nombre?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__nombre base-100 tablet-50" name="motivo" type="text" placeholder="Descripción Motivo" value="<?=$motivo?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__nombre base-100 tablet-50" name="monto" type="text" placeholder="Monto" value="<?=$monto?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__enviar base-100 tablet-50" type="submit" value="REGISTRAR GASTO">
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