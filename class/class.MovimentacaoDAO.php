<?php 

require_once '../inc/class.DbAdmin.php';
require_once 'class.Movimentacao.php';

/**
 * criado por José Carlos de camargo
 * em 04/10/2018
 */
class MovimentacaoDAO
{
	private $dba;

	public function MovimentacaoDAO()
	{
		$dba = new DbAdmin('mysql');
		$dba->connect('localhost', 'root', '', 'contas');
		//disponibiliza o objeto criado 
		$this->dba = $dba;
	}

	public function cadastra($mov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id_centro_custos 	= $mov->getIdCentroCustos();
		$id_conta 			= $mov->getIdConta();
		$tipo_mov 			= $mov->getTipoMov();
		$data				= $mov->getData();
		$descricao			= $mov->getDescricao();
		$valor				= $mov->getValor();

		//cria comando SQL
		$query = 'INSERT INTO movimentacao (id_centro_custos, id_conta, tipo_mov, data, descricao, valor) VALUES ('.$id_centro_custos.', '.$id_conta.', "'.$tipo_mov.'", "'.$data.'", "'.$descricao.'", '.$valor.')';

		//executar comando SQL
		$dba->query($query);

	}


	public function lista()
	{
		$dba = $this->dba;

		$query = 'SELECT * FROM movimentacao';

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i<$num; $i++) {
			$id 			 	= $dba->result($res, $i, 'id'); 
			$id_centro_custos 	= $dba->result($res, $i, 'id_centro_custos');
			$id_conta 			= $dba->result($res, $i, 'id_conta');
			$tipo_mov 			= $dba->result($res, $i, 'tipo_mov');
			$data 				= $dba->result($res, $i, 'data');
			$descricao 			= $dba->result($res, $i, 'descricao');
			$valor 				= $dba->result($res, $i, 'valor');

			$mov = new Movimentacao();
			$mov->setId($id);
			$mov->setIdCentroCustos($id_centro_custos);
			$mov->setIdConta($id_conta);
			$mov->setTipoMov($tipo_mov);
			$mov->setData($data);
			$mov->setDescricao($descricao);
			$mov->setValor($valor);

			$ver[] = $mov;
		}

		return $ver;
	}

	public function listaUm($mov)
	{
		$dba = $this->dba;

		$idc = $mov->getIdcliente();

		$query = 'SELECT * FROM movimentacao WHERE id = '.$idc;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i<$num; $i++) {
			$id 			 	= $dba->result($res, $i, 'id'); 
			$id_centro_custos 	= $dba->result($res, $i, 'id_centro_custos');
			$id_conta 			= $dba->result($res, $i, 'id_conta');
			$tipo_mov 			= $dba->result($res, $i, 'tipo_mov');
			$data 				= $dba->result($res, $i, 'data');
			$descricao 			= $dba->result($res, $i, 'descricao');
			$valor 				= $dba->result($res, $i, 'valor');

			$mov = new Movimentacao();
			$mov->setId($id);
			$mov->setIdCentroCustos($id_centro_custos);
			$mov->setIdConta($id_conta);
			$mov->setTipoMov($tipo_mov);
			$mov->setData($data);
			$mov->setDescricao($descricao);
			$mov->setValor($valor);

			$ver[] = $mov;
		}

		return $ver;
	}

	public function exlcuir($mov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id = $mov->getId();

		//cria comando SQL
		$query = 'DELETE FROM movimentacao WHERE id = "'.$id.'"';

		//executar comando SQL
		$dba->query($query);

	}

	public function atualiza($mov)
	{
		//atribui o atributo de classe para a variavel
		$dba = $this->dba;

		//retira os dados de dentro do objeto
		$id 				= $mov->getId();
		$id_centro_custos 	= $mov->getIdCentroCustos();
		$id_conta 			= $mov->getIdConta();
		$tipo_mov 			= $mov->getTipoMov();
		$data				= $mov->getData();
		$descricao			= $mov->getDescricao();
		$valor				= $mov->getValor();

		//cria comando SQL
		$query = 'UPDATE FROM movimentacao SET 
		id_centro_custos='.$id_centro_custos.', id_conta='.$id_conta.',  tipo_mov="'.$tipo_mov.'"  data="'.$data.'",  descricao="'.$descricao.'", valor="'.$valor.'"  WHERE id = "'.$id.'"';

		//executar comando SQL
		$dba->query($query);

	}


}

 ?>