<?php
    
    session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <!-- Css do login -->
    <link rel="stylesheet" href="public/css/login.css">
    <!-- Icone do site -->
    <link rel="icon" href="public/images/favicon.ico">
    <!-- Biblioteca de icones fontawesome-->
    <link href="public/fontawesome/css/all.css" rel="stylesheet">

    <title>CRUD-ProdutoMVC Login</title>
</head>

<body class="text-center">
    <form class="form-login" action="home/validar" method="post" id="formLogin">
        <img src="public/images/CrudLogo.png" style="width:134px;height:86px;" alt="CRUD_logo">
        <span> <?php
                //Mensagens de Erro na Autenticação            
                if (isset($_SESSION['erro'])) {
                    echo $_SESSION['erro']['erroLogin'];
                    unset($_SESSION['erro']);
                }
                ?>  </span>
        <div class="form-row align-items-center" style="margin-right: 8px;">
            <i class="fas fa-user col-2" style="margin-bottom:20px; font-size:25px;color:#012060;"></i>
            <input type="text" name="login" value="<?php if (isset($_SESSION["login"])) {
                                                        echo $_SESSION["login"];
                                                        unset($_SESSION["login"]);
                                                    } ?>" class="form-control col-10" style="margin-bottom:20px; font-size:16px;" placeholder="Digite o Login" required autofocus>
        </div>
        <div class="form-row align-items-center" style="margin-right: 8px;">
            <i class="fas fa-lock col-2" type="icon" style="margin-bottom:30px; font-size:25px;color:#012060;"></i>
            <input type="password" name="senha" class="form-control col-10" style="margin-bottom:30px;" placeholder="Digite a senha" required>
        </div>
        <div class="form-row align-items-center">
            <button class="btn btn-lg btn-outline-warning btn-block btn-hover" style="margin-left:15px; margin-right: 10px;" type="submit">Entrar</button>
        </div>
        <div class="form-row align-items-center">
            <p class="col-12 font-italic text-muted" style="margin-top:30px;">&copy; Desenvolvido por Bruno - SI</p>
        </div>

    </form>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="public/js/jquery-3.5.1.min.js"></script>
    <script src="public/js/popper.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
</body>

</html>