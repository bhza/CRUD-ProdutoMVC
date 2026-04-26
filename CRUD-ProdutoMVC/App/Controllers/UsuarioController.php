<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\Util;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class UsuarioController extends Controller {

    public function manutencaoUsuario() {

        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('listarUsuarios', $usuarioDAO->listar());

        $this->render('/usuario/manutencaoUsuario');

        Sessao::limpaMensagem();
    }

    public function editarUsuario() {

        $usuario = new Usuario();
        $usuario->setUsuario($_POST);
        $usuarioDAO = new UsuarioDAO();

        $login = $usuario->getLogin();

        if ($login) {
            $usuarioDAO->atualizar($usuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario atualizado com sucesso</div>');

            $this->redirect('/usuario/manutencaoUsuario');
        } else {
            // Por enquanto o sistema não pode ter nenhum bug de editar errado o usuário
            // Já que o mesmo já existe no sistemas já passando por verificação.
        }

        Sessao::limpaMensagem();
    }

    public function salvarUsuario() {

        $usuario = new Usuario();
        $usuario->setUsuario($_POST);
        $usuario->setSenha(md5($_POST['senha']));
        $usuarioDAO = new UsuarioDAO();

        if ($usuarioDAO->listar($usuario->getLogin())) {
            $retornajs['erro'] = true;
            $retornajs['msg'] = '<div class="alert alert-danger" role="alert">Este Login já está sendo usado.</div>';
            header('Content-Type: application/json');
            echo json_encode($retornajs);  //Retorna para o javascript
            return;
        } else {
            $usuarioDAO->salvar($usuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario cadastrado com sucesso</div>');
           
        }
    }

    public function listar($param) {
        $usuarioDAO = new UsuarioDAO();  //Conecta ao Banco

        self::setViewParam('listaUsuarios', $usuarioDAO->listar()); //busca os dados

        $this->render('/usuario/manutencaoUsuario'); //Passa os dados p/ a view listar

        Sessao::limpaMensagem();
    }

    public function excluirUsuario() {

        $objUsuario = new Usuario();

        $objUsuario->setLogin(Util::sanitizar($_POST['login']));

        $usuarioDAO = new UsuarioDAO();

        if (!$usuarioDAO->excluir($objUsuario)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Usuário Não Encontrado.</div>');
        } else {
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuário excluído com sucesso!</div>');
        }

        $this->redirect('/usuario/manutencaoUsuario');
    }

    public function resetarSenha() {
        $usuario = new Usuario();
        $usuario->setUsuario($_POST);
        $usuarioDAO = new UsuarioDAO();
        $novaSenha = md5($usuario->getSenha());

        $login = $usuario->getLogin();
        
//        $retornajs['erro'] = true;
//            $retornajs['msg'] = $login;
//            header('Content-Type: application/json');
//            echo json_encode($retornajs);  //Retorna para o javascript
//            return;
        

        if ($login) {
            $usuario = $usuarioDAO->listar($login);
            $usuario->setUsuario($usuario->getUsuario());
            $usuario->setSenha($novaSenha);
            $usuarioDAO->atualizar($usuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario atualizado com sucesso</div>');

//            $this->redirect('/usuario/manutencaoUsuario');
        } else {
            // Por enquanto o sistema não pode ter nenhum bug de editar errado o usuário
            // Já que o mesmo já existe no sistemas já passando por verificação.
        }

//        Sessao::limpaMensagem();
    }
}

//Fim da Classe

