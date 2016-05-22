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
				<form class="formulario" action="<?= $helper->url('reporte', 'generar');?>" method="post" name="registro">
				<div class="ed-container">
					<div class="ed-item main-center cross-center">
						<h1 class="formulario__item formulario__titulo">REPORTE</h1>
					</div>
					<div class="ed-item main-center cross-center">
						<span class="formulario__item formulario__<?=@$class_mensaje?>"><?=@$mensaje?></span>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__fecha_inicio base-100 tablet-50" name="fecha_ini" type="date" placeholder="Fecha Inicial" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__fecha_fin base-100 tablet-50" name="fecha_fin" type="date" placeholder="Fecha Final" required>
					</div>
					<div class="ed-item main-center cross-center">
						 <select class="formulario__selector base-100 tablet-50" name="tipo">
							<option value="venta">Venta</option>
							<option value="devolucion">Devolucion</option>
						</select> 
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__enviar base-100 tablet-50" type="submit" value="GENERAR REPORTE">
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