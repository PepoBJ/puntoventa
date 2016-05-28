<?php namespace app\Model\Action;

	use App\Model\Clase\Gastos as CGastos;
	use App\Core\ModeloBase;

	class Gastos extends ModeloBase
	{

		public function __construct()
		{
			$table = "gasto__externo";
			parent::__construct($table);
		}

		public function save(CGastos $gastos)
		{
			$save = $this->runSql(
				"INSERT INTO gasto__externo(
					id_gasto,
					nombre,
					motivo,
					monto,
					fecha,
					fk_email_usuario
				) VALUES (
					'" . $gastos->getIdGasto() . "',
					'" . $gastos->getNombre() . "',
					'" . $gastos->getMotivo() . "',
					'" . $gastos->getMonto() . "',
					'" . $gastos->getFecha() . "',
					'" . $gastos->getFkEmailUsuario() . "'
				)"
			);

			return $save;
		}

		public function update(CGastos $gastos)
		{
			$update = $this->runSql(
				"UPDATE gasto__externo SET 
				nombre = '" . $gastos->getNombre() . "',
				motivo = '" . $gastos->getMotivo() . "',
				monto = '" . $gastos->getMonto() . "',
				fecha = '" . $gastos->getFecha() . "',
				fk_email_usuario = '" . $gastos->getFkEmailUsuario() . "' 
				WHERE id_gasto = '" . $gastos->getIdGasto() . "'"
			);

			return $update;
		}

	}