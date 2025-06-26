<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['id'])){
    header("Location: http://localhost/softlineapp/login/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/create.css">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <div class="container">
        <h1 class="title-text">Cadastro de Clientes</h1>
        <form action="" class="form" id="form" method="POST">
        <?php
            if(isset($_POST['btn-cad'])){
                include('./createBD.php');
            }
            ?>
            <div class="input-box">
                <label>Nome</label>
                <input type="text" placeholder="Informe o nome do cliente" name="nome" id="nome" required />
            </div>

            <div class="input-box">
                <label>Nome Fantasia</label>
                <input type="text" placeholder="Informe o nome fantasia do cliente" name="nomeFan" id="nomeFan" required />
            </div>

            <div class="input-box">
                <label>Tipo de Documento</label>
                <div class="radio-group">
                    <label><input type="radio" name="tipoDoc" value="cpf" checked> CPF</label>
                    <label><input type="radio" name="tipoDoc" value="cnpj"> CNPJ</label>
                </div>
            </div>

            <div class="input-box">
            <label id="label-doc">CPF</label>
            <input type="text" placeholder="Informe o CPF do cliente" name="documento" id="documento" required />
            </div>

            <div class="input-box">
                <label>Endereço</label>
                <input type="text" placeholder="Informe o endereço do cliente" name="endereco" id="endereco" required />
            </div>
            <button name="btn-cad">Cadastrar</button>
            <button class="btn-cancel" type="button" onclick="history.back()">Voltar</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $(function () {
    const $labelDoc = $('#label-doc');
    const $inputDoc = $('#documento');

    function formatCPF(cpf) {
        return cpf.replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }

    function formatCNPJ(cnpj) {
        return cnpj.replace(/\D/g, '')
                .replace(/^(\d{2})(\d)/, '$1.$2')
                .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
                .replace(/\.(\d{3})(\d)/, '.$1/$2')
                .replace(/(\d{4})(\d{1,2})$/, '$1-$2');
    }

    function aplicarMascara() {
        const tipo = $('input[name="tipoDoc"]:checked').val();
        let val = $inputDoc.val();
        let pos = $inputDoc[0].selectionStart;

        val = tipo === 'cpf' ? formatCPF(val) : formatCNPJ(val);
        $inputDoc.val(val);

        // Restaurar o cursor ao final (melhor experiência)
        $inputDoc[0].setSelectionRange(val.length, val.length);
    }

    $('input[name="tipoDoc"]').on('change', function () {
        const tipo = $(this).val();
        if (tipo === 'cpf') {
        $labelDoc.text('CPF');
        $inputDoc.attr({ placeholder: 'Informe o CPF do cliente', maxlength: 14 }).val('');
        } else {
        $labelDoc.text('CNPJ');
        $inputDoc.attr({ placeholder: 'Informe o CNPJ do cliente', maxlength: 18 }).val('');
        }
    });

    $inputDoc.on('input', aplicarMascara);
    });
    </script>

    
    
</body>
</html>