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
				<form class="formulario" action="<?= $helper->url('venta', 'nuevo');?>" method="post" name="registro">
				<div class="ed-container">
					<div class="ed-item main-center cross-center">
						<h1 class="formulario__item formulario__titulo">NUEVA VENTA</h1>
					</div>
					<div class="ed-item main-center cross-center">
						<span class="formulario__item formulario__<?=@$class_mensaje?>"><?=@$mensaje?></span>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__dni base-100 tablet-50" name="codigo" type="text" placeholder="Codigo Proforma" value="<?=$codigo?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__nombre base-100 tablet-50" name="monto" type="text" placeholder="Monto" value="<?=$monto?>" required>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__nombre base-100 tablet-50" name="cod_boleta" type="text" placeholder="Codigo Boleta" value="<?=$cod_boleta?>" >
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__nombre base-100 tablet-50" name="cod_factura" type="text" placeholder="Codigo Factura" value="<?=$cod_factura?>" >
					</div>
					<div class="ed-item main-center cross-center">
						<select class="formulario__item formulario__nombre base-100 tablet-50" name="vendedor" required>
							<?php if( isset($vendedores)): ?>
								<?php foreach($vendedores as $vendedor): ?>
									<option value="<?=$vendedor->getDni()?>"><?=$vendedor->getNombre()?> <?=$vendedor->getApellido()?></option>
								<?php endforeach; ?>
							<?php else: ?>
								<option value="null">No hay vendedores</option>
							<?php endif; ?>
						</select>
					</div>
					<div class="ed-item main-center cross-center">
						<input class="formulario__item formulario__enviar base-100 tablet-50" type="submit" value="REGISTRAR VENTA">
					</div>
					<div class="ed-item main-center cross-center">
						<a class="registrar" href="<?=$helper->url('venta', 'modificar')?>">Modificar Boleta/Factura</a>
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