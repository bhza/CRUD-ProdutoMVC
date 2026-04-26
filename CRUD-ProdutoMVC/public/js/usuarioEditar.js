$(".edit").on('click', function() {
    var login = $(this).data('login');
    var nome = $(this).data('nome');
    var email = $(this).data('email');
    var permissao = $(this).data('permissao');

    // Exemplo de uso: atualizar o conteúdo de um elemento com o ID 'tituloEditar'
    $('#tituloEditar').html(nome);

    // Exemplo de uso: preencher campos de um formulário no modal
    $('#loginEditar').val(login);
    $('#nomeEditar').val(nome);
    $('#emailEditar').val(email);
    $('#permissaoEditar').val(permissao);
});
