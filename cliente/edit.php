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
    <title>Editar Cliente</title>
</head>
<body>
    <div class="container">
    <?php
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            require_once('../connection.php');
            $conn = getConn();
            $sql = "SELECT * FROM `cliente` WHERE id=:id";
            $select = $conn->prepare($sql);
            $select->execute(array(":id" => $id));
            $result = $select->fetch(PDO::FETCH_ASSOC);
        ?>
        <h1 class="title-text">Editar Cliente</h1>
        <form action="" class="form" id="form" method="POST">
            <?php
                if(isset($_POST['btn-edit'])){
                    include('./editBD.php');
                }
            ?>
            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <div class="input-box">
                <label>Nome</label>
                <input type="text" placeholder="Informe o Nome" name="nome" id="nome" value="<?=$result['nome'];?>" />
            </div>

            <div class="input-box">
                <label>Nome Fantasia</label>
                <input type="text" placeholder="Informe o Nome Fantasia" name="nomeFan" id="nomeFan" value="<?=$result['fantasia'];?>" />
            </div>

            <div class="input-box">
                <label>Tipo de Documento</label>
                <div class="radio-group">
                    <?php
                    if($result['tipo_doc'] == 'C'){
                    ?>
                        <label><input type="radio" name="tipoDoc" value="cpf" checked> CPF</label>
                        <label><input type="radio" name="tipoDoc" value="cnpj"> CNPJ</label>
                    <?php
                    }else{
                    ?>
                        <label><input type="radio" name="tipoDoc" value="cpf" > CPF</label>
                        <label><input type="radio" name="tipoDoc" value="cnpj"checked> CNPJ</label>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="input-box">
            <?php
                    if($result['tipo_doc'] == 'C'){
                    ?>

                        <label id="label-doc">CPF</label>
                        <input type="text" placeholder="Informe o CPF" name="documento" id="documento"  value="<?=preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $result['documento']);?>" />
                    <?php
                    }else{
                    ?>
                        <label id="label-doc">CNPJ</label>
                        <input type="text" placeholder="Informe o CNPJ" name="documento" id="documento"  value="<?=preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $result['documento']);?>" />
                    <?php
                    }
                    ?>
            </div>

            <div class="input-box">
                <label>Endereço</label>
                <input type="text" placeholder="Informe o Endereço" name="endereco" id="endereco"  value="<?=$result['endereco'];?>" />
            </div>
            <button name="btn-edit">Cadastrar</button>
            <button class="btn-cancel" type="button" onclick="history.back()">Voltar</button>
        </form>
        <?php    
        }else{
        ?>
        <h1>Nenhum registro selecionado!</h1>
        <?php
        }
        ?>
    </div>


    <script>
        const tipoDocRadios = document.querySelectorAll('input[name="tipoDoc"]');
        const labelDoc = document.getElementById('label-doc');
        const inputDoc = document.getElementById('documento');

        tipoDocRadios.forEach(radio => {
            radio.addEventListener('change', () => {
            if (radio.checked) {
                if (radio.value === 'cpf') {
                labelDoc.textContent = 'CPF';
                inputDoc.placeholder = 'Digite o CPF';
                inputDoc.maxLength = 14; // opcional
                } else if (radio.value === 'cnpj') {
                labelDoc.textContent = 'CNPJ';
                inputDoc.placeholder = 'Digite o CNPJ';
                inputDoc.maxLength = 18; // opcional
                }
            }
            });
        });
    </script>
    
    
</body>
</html>