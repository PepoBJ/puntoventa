<div class="ed-container" id="menu">
	<div class="ed-item base-20 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('usuario','editar')?>" class="menu__item icon-usuario espacio menu__usuario"><?=explode(' ', $usuario->getNombre())[0]?></a>
	</div>
	<div class="ed-item base-20 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('TipoResolucion','index')?>" class="menu__item menu__tipo__resolucion">Tipo Resolucion</a>
	</div>
	<div class="ed-item base-20 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('Area','index')?>" class="menu__item menu__area">Area</a>
	</div>
	<div class="ed-item base-20 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('Resolucion','index')?>" class="menu__item menu__resolucion">Resoluciones</a>
	</div>
	<div class="ed-item base-20 cross-center tablet-end main-center centrar-texto">
		<a href="<?=$helper->url('index','logout')?>" class="icon-cerrar espacio menu__item menu__salir">Salir</a>
	</div>
</div>