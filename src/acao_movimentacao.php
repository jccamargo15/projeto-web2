<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
	
	require_once('../class/class.Movimentacao.php');
	require_once('../class/class.MovimentacaoDAO.php');
	require_once('../class/class.Log.php');

	function limpa_moeda($valor) {
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
		return $valor;
	}

	if(isset($_GET['acao']) && !empty($_GET['acao']) && $_GET['acao']=='excluir'){
		$tipo = $_GET['tipo'];

		$movimentacao = new Movimentacao();
		$movimentacao->setId($_GET['id']);
		
		$movimentacaoDAO = new MovimentacaoDAO();
		$movimentacaoDAO->excluir($movimentacao);

	
		if($tipo == 'credito'){
			header("Location: ../index.php?page=movimentacao_credito&confirm=3");
			exit();
		}

		if($tipo == 'debito'){
			header("Location: ../index.php?page=movimentacao_debito&confirm=3");
			exit();
		}

	}else{

		if( $_POST['acao']=='inserir'){

			$movimentacao = new Movimentacao();
			$log = new Log();

			$movimentacao->setIdCentroCustos($_POST['id_centro_custos']);
			$movimentacao->setIdConta($_POST['id_conta']);
			$movimentacao->setTipoMov($_POST['tipo_mov']);
			$movimentacao->setData($_POST['data']);
			$movimentacao->setDescricao($_POST['descricao']);
			$valor = limpa_moeda($_POST['valor']);
			$movimentacao->setValor($valor);
					
			$movimentacaoDAO = new MovimentacaoDAO();
			$movimentacaoDAO->cadastra($movimentacao);

			//registrar movimentação no arquivo de Log
			$msg = '['. date("d/m/Y H:i:s").'] - ';
			$msg .= $movimentacao->getTipoMov() .' - ';
			$msg .= 'R$ '. $movimentacao->getValor();
			$msg .= PHP_EOL;
			$log->abrirArquivo();
			$log->escreverArquivo($msg);

			if($_POST['tipo_mov'] == 'credito'){
				header("Location: ../index.php?page=movimentacao_credito&confirm=1");
				exit();
			}
			if($_POST['tipo_mov'] == 'debito'){
				header("Location: ../index.php?page=movimentacao_debito&confirm=1");
				exit();
			}

		}

		if( $_POST['acao']=='editar'){

			$movimentacao= new Movimentacao();

			$movimentacao->setId($_POST['id']);
			$movimentacao->setIdConta($_POST['id_conta']);
			$movimentacao->setIdCentroCustos($_POST['id_centro_custos']);
			$movimentacao->setTipoMov($_POST['tipo_mov']);
			$movimentacao->setData($_POST['data']);
			$movimentacao->setDescricao($_POST['descricao']);
			$valor = limpa_moeda($_POST['valor']);
			$movimentacao->setValor($valor);

			$movimentacaoDAO = new MovimentacaoDAO();
			$movimentacaoDAO->atualiza($movimentacao);


			if($_POST['tipo_mov'] == 'credito'){
				header("Location: ../index.php?page=movimentacao_credito&confirm=2");
				exit();
			}
			if($_POST['tipo_mov'] == 'debito'){
				header("Location: ../index.php?page=movimentacao_debito&confirm=2");
				exit();
			}

			

		}


	}	
?>