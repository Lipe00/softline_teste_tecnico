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
    <link rel="stylesheet" href="../css/nav.css">
    <title>Cadastrar Produtos</title>
</head>
<body>
    
    <div class="container">
    
        <h1 class="title-text">Cadastro de Produtos</h1>
        <form action="" class="form" id="form" method="POST">
            <?php
            if(isset($_POST['btn-cad'])){
                include('./createBD.php');
            }
            ?>
            <div class="input-box">
                <label>Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Informe a descrição do produto" rows="4" required></textarea>
            </div>


            <div class="input-box">
                <label>Código de Barras</label>
                <input type="text" placeholder="Informe o código de barras" name="codBar" id="codBar" required />
            </div>

            <div class="input-box">
                <label>Valor de venda</label>
                <input type="text" value="R$0.00" name="valorVenda" id="valorVenda" required />
            </div>

            <div class="input-box">
                <label>Peso Bruto</label>
                <input type="text" value="0.000kg" name="pesoBruto" id="pesoBruto" required />
            </div>

            <div class="input-box">
                <label>Peso líquido</label>
                <input type="text" value="0.000kg" name="pesoLiquido" id="pesoLiquido" required />
            </div>
            <button name="btn-cad">Cadastrar</button>
            <button class="btn-cancel" type="button" onclick="history.back()">Voltar</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $(function() {
        function formatCurrency($input) {
            let raw = $input.val().replace(/\D/g, '');
            raw = raw.replace(/^0+/, '');
            if (raw === '') raw = '0';

            raw = raw.padStart(3, '0');
            const intPart = raw.slice(0, -2);
            const decPart = raw.slice(-2);

            $input.val(`R$ ${parseInt(intPart, 10)},${decPart}`);
        }

        function formatWeight($input) {
            let raw = $input.val().replace(/\D/g, '');
            raw = raw.replace(/^0+/, '');
            if (raw === '') raw = '0';

            raw = raw.padStart(4, '0');
            const intPart = raw.slice(0, -3);
            const decPart = raw.slice(-3);

            $input.val(`${parseInt(intPart, 10)},${decPart}kg`);
        }

        function restrictToNumbers(e) {
            if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete') {
                e.preventDefault();
            }
        }

        const $codBar = $('#codBar');
        const $valorVenda = $('#valorVenda');
        const $pesoBruto = $('#pesoBruto');
        const $pesoLiquido = $('#pesoLiquido');

        $codBar.add($valorVenda).add($pesoBruto).add($pesoLiquido).on('keypress', restrictToNumbers);

        $valorVenda.on('input', function() {
            formatCurrency($(this));
        });

        $pesoBruto.on('input', function() {
            formatWeight($(this));
        });

        $pesoLiquido.on('input', function() {
            formatWeight($(this));
        });
    });
    </script>   

    
</body>
</html>