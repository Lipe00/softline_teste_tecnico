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
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/nav.css">
    <title>Listagem de Clientes</title>
</head>
<body>
    <div class="main">
    <?php
        include('../navbar.php');
    ?>
        <div class="view">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Fantasia</th>
                        <th>Documento</th>
                        <th>Endereço</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody id="tBody">
                            
                </tbody>
            </table>
        </div>
        <a href="./create.php" class="fab-button" title="Criar novo">
            <i class="ri-add-line"></i>
        </a>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            carregarDados();


        })
        async function carregarDados(){
            $.ajax({
                url: "./indexBD.php",
                type: "GET",
                dataType: "json",
                success: function(dados){
                    $('#tBody').empty();
                    if(dados.length > 0){
                        dados.forEach(function(item) {
                            let doc;
                            let linha = '<tr>';

                            linha += '<td>' + item["id"] + '</td>';
                            linha += '<td>' + item["nome"] + '</td>';
                            linha += '<td>' + item["fantasia"] + '</td>';
                            if (item['tipo_doc'] === 'C') {
                                doc = item['documento'].replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4");
                            } else {
                                doc = item['documento'].replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");
                            }
                            linha += '<td>' + doc + '</td>';
                            linha += '<td>' + item["endereco"] + '</td>';
                            linha += '<td>' + "<a href='./edit.php?id="+item["id"]+"'><i class='ri-edit-fill'></i></a>" + '</td>';
                            linha += '<td onclick="deleteItem('+item["id"]+')">' + "<i class='ri-delete-bin-5-fill'></i>" + '</td>';


                            linha += '</tr>';

                            // Adiciona a linha na tabela
                            $('#tBody').append(linha);
                        });
                    }else{
                        $('#tBody').append('<tr><td colspan="8">Nenhum dado encontrado</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao carregar dados:", error);
                    $('#tBody').append('<tr><td colspan="8">Erro ao carregar dados</td></tr>');
                }
            })
        }
        function deleteItem(id){
            if(confirm("Tem certeza que deseja excluir esse registro?\n Código - " +id)){
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: './deleteBD.php', 
                        type: 'GET',
                        data: {"id":id},
                        dataType: "json",
                        success: function(results) {
                            if (results.success) {
                                alert(results.message);
                                carregarDados();
                            } else {
                                alert("Erro: " + results.message);
                            }
                        },
                        error: function() {
                            reject("Erro ao conectar com o servidor.");
                        }
                    });
                })
                .then(message => {
                    alert(message);
                    carregarDados();
                })
                .catch(errorMessage => {
                    alert(errorMessage);
                });
            }
        }

    </script>
    
</body>
</html>