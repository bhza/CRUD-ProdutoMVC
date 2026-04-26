<?php

/**
 * Description of HomeController
 * Esta classe é chamada por default quando não é digitado um controller
 *   específico na URL. 
 * O método index() será chamado por default e simplesmente renderiza a
 *   view home/index através do método render() da classe Mãe Controller.php 
 */


namespace App\Controllers; #Serve para o autoload das classe do composer saber onde é a classe

use App\Lib\Sessao; #Para usar a classe Sessao
use App\Models\DAO\UsuarioDAO; #Para usar a classe UsuarioDAO
use App\Models\Entidades\Usuario; #Para usar a classe Usuario
use App\Lib\Util; #Para usar a classe Util

class HomeController extends Controller #Todos os controladodres devem ser filhos da classe Controle
{
    #Aqui nós temos os action
    
    public function index() 
    {
        $this->render('home/index');
    }

    //Verifica se o usuário está logado

    public function validar()
    {

        if(isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_SESSION['permissao'])){
            Sessao::limpaLogin();
        }

        //Recebe os dados do formulário de login

        $dadosForm = Util::sanitizar($_POST); //Sanitiza os dados do formulário

        //Instancia um objeto da classe Usuario

        $usuario = new Usuario();

        //Atribui os dados do formulário ao objeto

        $usuario->setLogin($dadosForm['login']);
        $usuario->setSenha(md5($dadosForm['senha']));

        //Instancia um objeto da classe UsuarioDAO

        $usuarioDAO = new UsuarioDAO();

        //Chama o método validar() da classe UsuarioDAO


        $usuarioDAO->listar($usuario->getLogin());

        //Verifica se o usuário existe
        
        
        if($usuarioDAO->listar($usuario->getLogin()) == null){
            Sessao::gravaErro('erroLogin', '<div class="alert alert-danger" role="alert">Usuário e/ou Senha Inválidos!</div>');
            $this->redirect('/login.php');
        } else {
            if($usuarioDAO->listar($usuario->getLogin())->getSenha() != $usuario->getSenha()){
                Sessao::gravaErro('erroLogin', '<div class="alert alert-danger" role="alert">Usuário e/ou Senha Inválidos!</div>'); 
                $this->redirect('/login.php');
            }
        }

        Sessao::gravaLogin($usuario->getLogin(), $usuario->getSenha(), $usuarioDAO->listar($usuario->getLogin())->getPermissao());
        $this->redirect('/home');

    }

    //Faz o logout do usuário

    public function logout()
    {
        Sessao::limpaLogin();
        $this->redirect('/login');
    }

    public function negado(){
        $this->render('home/negado');
    }
}
