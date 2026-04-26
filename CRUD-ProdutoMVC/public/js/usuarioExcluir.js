$(".delete").on('click', function() {
    var login = $(this).data('login');
    var nome = $(this).data('nome');
    var email = $(this).data('email');
    var permissao = $(this).data('permissao');

    // Exemplo de uso: preencher campos de um formulário no modal
    $('#nomeExcluir').html(nome);
    $('#loginExcluir').val(login);
});
