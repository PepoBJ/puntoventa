<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=$title?></title>
	<?=$helper->favicon()?>
	<?=$helper->responsive()?>

	<?=$helper->css('cabezera-footer');?>
	<?=$helper->css('formulario');?>
	<?=$helper->css('index');?>
	<?=$helper->css('home');?>
	<?=$helper->css('pdf');?>
</head>
<body>
	

	<section>
		
		<?php if(isset($reporte_complejo) && $reporte_complejo): ?>
			<div class="div">
				<h2 class="titulo__tabla titulo_central">REPORTE DIARIO - <?=$titulo_tabla?></h2>
			</div>

			<?php if(isset($reporte_ventas)):?>
			<div class="ed-container">
				<div class="ed-item">
					<h2 class="titulo__tabla">REPORTE DE VENTAS - <?=$titulo_tabla?></h2>
				</div>
				<div class="ed-item">					
					<table class="reporte__tabla">
					    <tr class="tabla__titulos">
					    	<?php foreach($cabezeras_ventas as $cabezera): ?>
					    		<td><?=$cabezera?></td>
							<?php endforeach; ?>
					    </tr>

				      	<?php foreach($reporte_ventas as $item_reporte): ?>
					    	<tr class="tabla__items">
					      		<?php foreach($cabezeras_ventas as $cabezera): ?>
						    		<td><?=$item_reporte->$cabezera?></td>
								<?php endforeach; ?>
					    	</tr>
						<?php endforeach; ?>
						<tr class="tabla__total tabla__items">
							<td>TOTAL</td>
							<td colspan="7"><?=$reporte_ventas[0]->total?></td>
						</tr>
					</table> 
				</div>
			</div>
			<?php endif; ?>

			<?php if(isset($reporte_devoluciones)):?>
			<div class="ed-container">
				<div class="ed-item">
					<h2 class="titulo__tabla">REPORTE DE DEVOLUCIONES - <?=$titulo_tabla?></h2>
				</div>
				<div class="ed-item">					
					<table class="reporte__tabla">
					    <tr class="tabla__titulos">
					    	<?php foreach($cabezeras_devoluciones as $cabezera): ?>
					    		<td><?=$cabezera?></td>
							<?php endforeach; ?>
					    </tr>

				      	<?php foreach($reporte_devoluciones as $item_reporte): ?>
					    	<tr class="tabla__items">
					      		<?php foreach($cabezeras_devoluciones as $cabezera): ?>
						    		<td><?=$item_reporte->$cabezera?></td>
								<?php endforeach; ?>
					    	</tr>
						<?php endforeach; ?>
						<tr class="tabla__total tabla__items">
							<td>TOTAL</td>
							<td colspan="7"><?=$reporte_devoluciones[0]->total?></td>
						</tr>
					</table> 
				</div>
			</div>
			<?php endif; ?>
			
			<?php if(isset($reporte)):?>
			<div class="ed-container">
				<div class="ed-item">
					<h2 class="titulo__tabla">REPORTE DE GASTOS - <?=$titulo_tabla?></h2>
				</div>
				<div class="ed-item">					
					<table class="reporte__tabla">
					    <tr class="tabla__titulos">
					    	<?php foreach($cabezeras_gastos as $cabezera): ?>
					    		<td><?=$cabezera?></td>
							<?php endforeach; ?>
					    </tr>

				      	<?php foreach($reporte_gastos as $item_reporte): ?>
					    	<tr class="tabla__items">
					      		<?php foreach($cabezeras_gastos as $cabezera): ?>
						    		<td><?=$item_reporte->$cabezera?></td>
								<?php endforeach; ?>
					    	</tr>
						<?php endforeach; ?>
						<tr class="tabla__total tabla__items">
							<td>TOTAL</td>
							<td colspan="7"><?=$reporte_gastos[0]->total?></td>
						</tr>
					</table> 
				</div>
			</div>
			<?php endif; ?>


			<div class="ed-container">
				<div class="ed-item">
					<h2 class="titulo__tabla">RESUMEN</h2>
				</div>
				<div class="ed-item">					
					<table class="reporte__tabla">
					    <tr class="tabla__titulos">
					    	<td>Tipo</td>
					    	<td>Sub-Total</td>
					    </tr>
						
						<tr class="tabla__items">
							<td>Ventas</td>
							<td><?= isset($reporte_ventas) ? $reporte_ventas[0]->total : 0?></td>
						</tr>
						<tr class="tabla__items">
							<td>Gastos</td>
							<td><?= isset($reporte_gastos) ? $reporte_gastos[0]->total : 0 ?></td>
						</tr>

						<tr class="tabla__total tabla__items">
							<td>TOTAL</td>
							<td colspan="7"><?=  (isset($reporte_ventas) ? $reporte_ventas[0]->total : 0) - (isset($reporte_gastos) ? $reporte_gastos[0]->total : 0 )?></td>
						</tr>
					</table> 
				</div>
			</div>
		<?php else: ?>

		<?php if(isset($reporte)):?>
			<div class="ed-container">
				<div class="ed-item">
					<h2 class="titulo__tabla"><?=$titulo_tabla?></h2>
				</div>
				<div class="ed-item">					
					<table class="reporte__tabla">
					    <tr class="tabla__titulos">
					    	<?php foreach($cabezeras as $cabezera): ?>
					    		<td><?=$cabezera?></td>
							<?php endforeach; ?>
					    </tr>

				      	<?php foreach($reporte as $item_reporte): ?>
					    	<tr class="tabla__items">
					      		<?php foreach($cabezeras as $cabezera): ?>
						    		<td><?=$item_reporte->$cabezera?></td>
								<?php endforeach; ?>
					    	</tr>
						<?php endforeach; ?>
						<tr class="tabla__total tabla__items">
							<td>TOTAL</td>
							<td colspan="7"><?=$reporte[0]->total?></td>
						</tr>
					</table> 
				</div>
			</div>
		<?php endif; ?>
		<?php endif; ?>
	</section>

</body>
</html>