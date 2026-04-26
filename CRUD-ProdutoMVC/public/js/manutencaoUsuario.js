$("#emailEditar").on("blur", function (e) {
    e.preventDefault();
    var email = $("#emailEditar").val();
    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    $("#emailEditar")[0].setCustomValidity("");
    if (!(regexEmail.test(email))) {
        $("#emailEditar")[0].setCustomValidity("O email deve conter um domínio válido. Ex: @email.com.br"); // Como o jQuery tem seus objetos próprios
        $("#emailEditar")[0].reportValidity();                                                              // é necessário usar o [0] para acessar o  
    }
});


$("#nomeEditar").on("blur", function (e) {
    e.preventDefault();
    var nome = $("#nomeEditar").val();
    var regexNome = /^[^\d]+$/;

    $("#nomeEditar")[0].setCustomValidity("");
    if (!(regexNome.test(nome))) {
        $("#nomeEditar")[0].setCustomValidity("Evite nomes com números."); // Como o jQuery tem seus objetos próprios
        $("#nomeEditar")[0].reportValidity();                              // é necessário usar o [0] para acessar o  
    }
})

$("#email").on("blur", function (e) {
    e.preventDefault();
    var email = $("#email").val();
    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    $("#email")[0].setCustomValidity("");
    if (!(regexEmail.test(email))) {
        $("#email")[0].setCustomValidity("O email deve conter um domínio válido. Ex: @email.com.br"); // Como o jQuery tem seus objetos próprios
        $("#email")[0].reportValidity();                                                              // é necessário usar o [0] para acessar o  
    }
});


$("#nome").on("blur", function (e) {
    e.preventDefault();
    var nome = $("#nome").val();
    var regexNome = /^[^\d]+$/;

    $("#nome")[0].setCustomValidity("");
    if (!(regexNome.test(nome))) {
        $("#nome")[0].setCustomValidity("Evite nomes com números."); // Como o jQuery tem seus objetos próprios
        $("#nome")[0].reportValidity();                              // é necessário usar o [0] para acessar o  
    }
});

$("#senha").on("blur", function (e) {
    e.preventDefault();
    var senha = $("#senha").val();
    var regexSenha = /\d{3,}/;

    $("#senha")[0].setCustomValidity("");
    if (!(regexSenha.test(senha))) {
        $("#senha")[0].setCustomValidity("A senha deve conter pelo menos 3 digitos, letras, número ou caracteres especiais."); // Como o jQuery tem seus objetos próprios
        $("#senha")[0].reportValidity();                              // é necessário usar o [0] para acessar o  
    }
});

//$("#login").on("blur", function (e) {
//    e.preventDefault();
//
//    $("#login")[0].setCustomValidity("");
//
//    $(".loginUsuario").each(function () {
//        if ($(this).html() === $("#login").val()) {
//            $("#login")[0].setCustomValidity(`O login: ${$(this).html()} já está em uso, escolha outro.`);
//            $("#login")[0].reportValidity();
//            $("#login")[0].val(" ");
//        }
//    });
//});

$("#pesquisaUsuario").on("input", function () {
    var pesquisa = $(this).val().toLowerCase();
    $("tr").each(function () {
        if (!($(this).find("th").length)) {
            var thisLinha = $(this);
            var encontrou = false;
            $(this).find("td").each(function () {
                if (!$(this).find("button").length) {
                    if ($(this).text().toLowerCase().includes(pesquisa)) {
                        encontrou = true;
                        return false;
                    }
                }
            });
            if (encontrou) {
                thisLinha.show();
            } else {
                thisLinha.hide();
            }

        }
    });
});

$('#formNovoUsuario').on('submit', function (e) {
    e.preventDefault();

    var dados = $('#formNovoUsuario').serialize();
      $.post("./salvarUsuario", dados, function(retorno){
        if (retorno['erro']){ //Erro no Cadastro
            $("#msgCadUsrModal").html(retorno['msg']);  //Mensagem no Modal
        } else { //Cadastro realizado com sucesso
            //Mensagem na tela Principal vai via SESSION
            //Limpar campos
			$('#formNovoUsuario')[0].reset();
							
			//Fechar janela modal Novo Usuário
			$('#ModalNovoUsuario').modal('hide');
            
            //Chama a página de Manutenção de Usuários e mostra a msg de Sucesso.            
            location.reload(true);
        }
      });
});


$('#formEditarUsuario').on('submit', function (e) {
    e.preventDefault();

    var dados = $('#formEditarUsuario').serialize();
      $.post("./editarUsuario", dados, function(retorno){
        if (retorno['erro']){ //Erro no Cadastro
            $("#msgCadUsrModal").html(retorno['msg']);  //Mensagem no Modal
        } else { //Cadastro realizado com sucesso
            //Mensagem na tela Principal vai via SESSION
            //Limpar campos
			$('#formEditarUsuario')[0].reset();
							
			//Fechar janela modal Novo Usuário
			$('#ModalEditarUsuario').modal('hide');
            
            //Chama a página de Manutenção de Usuários e mostra a msg de Sucesso.            
            location.reload(true);
        }
      });
});

//Passa parâmetros para o Modal usado no Ressetar Senha
$('#ModalResetarSenha').on('show.bs.modal', function (event) {    

    var button = $(event.relatedTarget); //Botão que ativou o Modal
    var recipientLogin      = button.data('login');
    var recipientNome       = button.data('nome');
    //alert(recipientLogin);
    //alert(recipientNome);
    var modal = $(this);
    //Pega o valor armazenado no recipient e substitui no modal onde o #id = o id do campo no modal 
    modal.find('#login').val(recipientLogin);
    modal.find('#nome').val(recipientNome);
});

$('#formResetarSenha').on('submit', function(e){
      e.preventDefault();
      //alert("Dentro do script de enviar post");
      //Recebe os dados do Formulário
      var dados = $('#formResetarSenha').serialize();
      //alert(dados);
      $.post('./resetarSenha', dados, function(retorno){
//        alert(retorno);
        if (retorno['erro']){ //Erro de Validação
            $("#msgRstUsrModal").html(retorno['msg']);  //Mensagem no Modal
        }else { //Alteração realizada com sucesso
            //Limpar campos
			$('#formResetarSenha')[0].reset();	
			//Fechar janela modal Editar Usuário
			$('#ModalResetarSenha').modal('hide');
            //Chama a página de Manutenção de Usuários e mostra a msg de Sucesso via SESSION
            location.href = "./manutencaoUsuario";
        }
      });
    });