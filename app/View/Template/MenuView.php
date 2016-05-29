<div class="ed-container" id="menu">
	<div class="ed-item base-1-6 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('usuario','editar')?>" class="menu__item icon-usuario espacio menu__usuario"><?=explode(' ', $usuario->getNombre())[0]?></a>
	</div>
	<div class="ed-item base-1-6 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('venta','nuevo')?>" class="menu__item menu__tipo__resolucion">Venta</a>
	</div>
	<div class="ed-item base-1-6 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('gastos','nuevo')?>" class="menu__item menu__tipo__resolucion">Gastos</a>
	</div>
	<div class="ed-item base-1-6 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('devolucion','nuevo')?>" class="menu__item menu__area">Devolucion</a>
	</div>
	<div class="ed-item base-1-6 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('reporte','generar')?>" class="menu__item menu__resolucion">Reporte</a>
	</div>
	<div class="ed-item base-1-6 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('index','logout')?>" class="icon-cerrar espacio menu__item menu__salir">Salir</a>
	</div>
</div>