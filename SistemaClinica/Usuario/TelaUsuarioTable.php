<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

require_once './Usuario.php';

include_once '../Login/ProtectPaginas.php';
protect();

if(isset($_SESSION["tipoUsuario"])){
    $tipo_user = $_SESSION["tipoUsuario"];
    
    if ($tipo_user != "Administrador"){
        header("Location: ../Telas/Home.php");
    }
}

$usuario = new Usuario();
$usuario->retornaTudo($usuario);

?>
<html lang="pt-br">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/cadastro.css">
    <link rel="stylesheet" type="text/css" href="../css/tabela.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Pesquisar Usuário</title>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/login.js"></script>
    
    <script type="text/javascript">
            
            $(document).ready(function(){
              
              var tipo_user = "<?php echo $tipo_user ?>";
              
              if(tipo_user != "Administrador"){
                  $("#opcaoUser").remove();
              }
                               
            });
        
    </script>
    
    </head>
    <body ondragstart="return false;">
        
  <?php include '../util/nav.php' ?>

<div class="centro">
    <div class="conteudo">
      <table>
        <thead>
          <tr class="titulo-table">
            <th class="column1">Id</th>
            <th class="column2">Nome</th>
            <th class="column3">Login</th>
            <th class="column4">Tipo</th>
            <th class="column5">Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php while ($dado = $usuario->retornaDados("object"))  { ?>
          <tr class="tabela">
            <td><?php echo $dado->IDUSUARIO ?></td>
            <td><?php echo $dado->NOME ?></td>
            <td><?php echo $dado->LOGIN ?></td>
            <td><?php echo $dado->TIPOUSUARIO ?></td>
            <td class="column5"><a href="../Telas/TelaAtualizarUsuario.php?usuario=<?php echo $dado->IDUSUARIO; ?>">Editar</a> 
                <a href="" id="separador">|</a>
                <a href="javascript: if(confirm('DESEJA DELETAR OS DADOS DO USUARIO <?php echo $dado->NOME; ?> ?')) 
                    location.href='RemoveUsuario.php?usuario=<?php echo $dado->IDUSUARIO; ?>';">Excluir</a>
                </td>
          </tr> 
          </tbody>
         <?php } ?>
    </table>
  </div>
</div>

<?php include '../util/footer.php' ?>

</body>
</html>
