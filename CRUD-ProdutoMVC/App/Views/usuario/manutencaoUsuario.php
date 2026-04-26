<main role="main" class="flex-shrink-0">
    <div class="container mt-5">
        <div class="row">  
            <div class="col-md-7">  
                <h2 class="h2 mt-2">Manutenção de Usuários do Sistema</h2>
            </div>
            <div class="col-md-3">  
                <input type="search" class="mt-2 form-control" placeholder="Pesquisar na tabela de usuários" id="pesquisaUsuario"></input>
            </div>
            <div class="col-md-2 row justify-content-end">
                <!-- Button trigger modal Cadastro Novo Usuário-->
                <button type="button" class="btn btn-outline-success btn-sm mb-2 mt-2" data-toggle="modal" data-target="#ModalNovoUsuario" > Novo Usuário </button> 
            </div>                  
        </div>
        <span>
            <?php
            //Mensagens de Erro e Sucesso na execução das funções              
            if (isset($_SESSION['msg'])) {
                // echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </span>          
        <!-- Modal Novo Usuário -->
        <div class="modal fade" id="ModalNovoUsuario">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h4 class="modal-title" id="ModalNovoUsuario">Cadastrar Novo Usuário</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formNovoUsuario" method="post">
                        <!--action="./salvarUsuario"-->
                        <div class="modal-body">
                            <span id="msgCadUsrModal"></span>
                            <div class="form-group">
                                <label for="login" class="col-form-label" minlength="0" maxlength="128">Login</label>
                                <input type="text" class="form-control" name="login" id="login" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="nome" class="col-form-label"  minlength="0" maxlength="256">Nome Completo</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="senha" class="col-form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" required  minlength="3" maxlength="32">
                            </div>                                
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required  minlength="0" maxlength="256" autocomplete="username">
                            </div>
                            <div class="form-group">
                                <label for="permissao" class="col-form-label">Tipo de Permissão</label>
                                <select class="form-control" name="permissao" id="permissao">
                                    <option value="Selecione" disabled selected class="bg-light">Selecione</option>
                                    <option value="Admin">Administrador</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Leitura">Somente Leitura</option>
                                </select>
                            </div>                
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnConfirmarCadastro" name="btnConfirmar" value="btnConfirmar" class="btn btn-outline-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>     
    </div>

    <div class="container">
        <?php
        //Mensagens de Erro ou Sucesso na execução das funções
        echo $Sessao::retornaMensagem();
        $Sessao::limpaMensagem();

        if (count($viewVar['listarUsuarios']) > 0) {
            echo '<div class="table-responsive ">';
            echo ' <table class="table table-hover table-sm table-striped">';
            echo ' <thead class="thead-dark">';
            echo ' <tr style="background-color: #bee5eb;">';
            echo ' <th class="info">Login</th>';
            echo ' <th class="info">Nome Completo</th>';
            echo ' <th class="info">Email</th>';
            echo ' <th class="info">Tipo de Permissão</th>';
            echo ' <th class="info"></th>';

            echo ' </tr>';
            echo ' </thead>';
            echo ' <tbody>';
            foreach ($viewVar['listarUsuarios'] as $objUsuario) {
                $login = $objUsuario->getLogin();
                $nome = $objUsuario->getNome();
                $email = $objUsuario->getEmail();
                $permissao = $objUsuario->getPermissao();

                echo '<tr>';
                echo ' <td class="loginUsuario">' . $login . '</td>';
                echo ' <td >' . $nome . '</td>';
                echo ' <td >' . $email . '</td>';
                echo ' <td >' . $permissao . '</td>';
                echo ' <td class="text-right"> <button  class="edit btn btn-warning btn-sm"  data-toggle="modal" data-target="#ModalEditarUsuario" data-login=' . "$login" . ' data-nome=' . "$nome" . ' data-email=' . "$email" . ' data-permissao=' . "$permissao" . '>Editar</button>  
              <button class="delete btn btn-info btn-sm mx-2" data-toggle="modal" data-target="#ModalResetarSenha" data-login=' . "$login" . ' data-nome=' . "$nome" . '>Resetar senha</button>'
                . '<button class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalExcluirUsuario" data-login=' . "$login" . ' data-nome=' . "$nome" . '>Excluir</button></td>';
                echo '</tr>';
            }
            echo ' </tbody>';
            echo ' </table>';
            echo '</div>';
        } else {
            echo "Nenhum Usuario Encontrado.";
        }
        ?>

        <!-- Modal Editar Usuário -->
        <div class="modal fade" id="ModalEditarUsuario">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title" id="ModalEditarUsuario">Editar usuário : <span id="tituloEditar"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEditarUsuario" method="post">
                        <div class="modal-body">
                            <span id="msgCadUsrModal"></span>
                            <div class="form-group">
                                <label for="login" class="col-form-label">Login</label>
                                <input type="text" class="form-control" name="login" id="loginEditar" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nome" class="col-form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="nome" id="nomeEditar" required autofocus>
                            </div>                              
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="emailEditar" required autocomplete="username">
                            </div>
                            <div class="form-group">
                                <label for="permissao" class="col-form-label">Tipo de Permissão</label>
                                <select class="form-control" name="permissao" id="permissaoEditar">
                                    <option value="Selecione" selected disabled class="bg-light">Selecione</option>
                                    <option value="Admin">Administrador</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Leitura">Somente Leitura</option>
                                </select>
                            </div>                
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnConfirmarEdicao" name="btnConfirmar" value="btnConfirmar" class="btn btn-outline-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <div class="container">

        <!-- Modal Editar Usuário -->
        <div class="modal fade" id="ModalExcluirUsuario">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-white bg-danger">
                        <h4 class="modal-title" id="ModalExcluirUsuario">Confirmação da Exclusão de <i>usuário</i></h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <form id="formExcluirUsuario" method="post" action="./excluirUsuario/excluir">
                        <input type="hidden" class="form-control" name="login" id="loginExcluir">
                        <div class="modal-body">
                            <span id="msgCadUsrModal"></span>
                            <h5>Excluir?</h5>   
                            Confirma exclusão do usuário: <b><span id="nomeExcluir"></span></b> ?
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnConfirmarExclusao" name="btnConfirmar" value="btnConfirmar" class="btn btn-outline-danger">Excluir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Ressetar Senha Usuário -->
    <div class="modal fade" id="ModalResetarSenha">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title" id="ModalResetarSenha">Resetar a Senha do Usuário</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  id="formResetarSenha" method="post">  
                    <div class="modal-body">
                        <span id="msgRstUsrModal"></span>
                        <div class="form-group">
                            <label for="Login" class="col-form-label">Login</label>
                            <input type="text" class="form-control" name="login" id="login" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Login" class="col-form-label">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" id="nome" readonly>
                        </div>              
                        <div class="form-group">
                            <label for="senha" class="col-form-label">Senha Provisória</label>
                            <input type="password" class="form-control" name="senha" id="senha" value="" autofocus>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnRessetarSenha" name="btnRessetarSenha" value="btnRessetarSenha" class="btn btn-outline-primary"  >Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  


</main>
