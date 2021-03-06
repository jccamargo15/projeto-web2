<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
  include_once('class/class.CentroCustos.php');
  include_once('class/class.CentroCustosDAO.php');


  if( isset($_GET['confirm']) and !empty($_GET['confirm']) ){
    if($_GET['confirm'] == 1){
      // echo "Categoria cadastrada com sucesso!!";
      echo '<div class="alert alert-success" role="alert">Categoria cadastrada com sucesso</div>';
    }
    if($_GET['confirm'] == 2){
      // echo "Categoria atualizada com sucesso!!";
      echo '<div class="alert alert-primary" role="alert">Categoria atualizada com sucesso</div>';
    }
    if($_GET['confirm'] == 3){
      // echo "Categoria excluída com sucesso!!";
      echo '<div class="alert alert-danger" role="alert">Categoria excluída com sucesso</div>';
    }
  }

  $centroCustosDAO = new CentroCustosDAO();

  if( isset($_GET['editar']) and !empty($_GET['editar']) ){
    $id = $_GET['id'];

    $vetor = $centroCustosDAO->listaUm($id);
  ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Cadastrar Categorias</h4>
      <form class="needs-validation" action="src/acao_categorias.php" method="POST" novalidate>
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $vetor[0]->getId();?>">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome da Categoria</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $vetor[0]->getNome();?>" required>
          </div>
        </div>

        <button class="btn btn-primary btn-lg" type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>

<?php
  }else{
?>
  
  <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Cadastrar Categorias</h4>
      <form class="needs-validation" action="src/acao_categorias.php" method="POST" novalidate>
        <input type="hidden" name="acao" value="inserir">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome da Categoria</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="" required>
          </div>
        </div>

        <button class="btn btn-primary btn-lg" type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>

<?php
  }
?>

<hr class="mb-4">

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>NOME</th>
        <th>AÇÃO</th>
      </tr>
    </thead>
    <tbody>
    <?php

    $lista = $centroCustosDAO->lista();
      if($lista != 0){
        foreach ($lista as $i =>$val) {
          echo '<tr>';
            echo '<td>'. $lista[$i]->getNome() .'</td>';
            echo '<td>';
            echo '<a href= "index.php?page=cadastro_categoria&editar=1&id='. $lista[$i]->getId() .'&acao=editar"><img width="24px" heigth="24px" src="img/edit.png"></a>';
            // echo '<a href= "src/acao_categorias.php?id='. $lista[$i]->getId() .'&acao=excluir"><img width="24px" heigth="244px" src="img/delete.png"></a>';
            echo '</td>';

          echo '</tr>';
        }
      }else{
        echo 'Nenhum registro encontrado!';
      }
    ?>
  </tbody>
  </table>

<?php include 'tpl.footer.php'; ?>
</div>