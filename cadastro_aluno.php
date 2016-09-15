<?php
/** O nome do banco de dados*/
define('DB_NAME', 'db_lgd');
/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');
/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');
/** nome do host do MySQL */
define('DB_HOST', 'localhost');

?>
<?php
mysqli_report(MYSQLI_REPORT_STRICT);
function conecta() {
	try {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}
function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>

<?php

//Função para validar os dados do formulário de cadastro de usuário
//Esta função retorna uma string vazia caso não encontre nenhum erro
//Esta função retorna uma string com os erros encontrados na validação
//dos dados
function valida_dados($e_nome,$e_cpf,$e_email,$e_senha,$e_contrasenha)
{
   $erro = "";	
   //testando a variável e_nome
   if ($e_nome == "") {
        $erro = $erro . "Nome não pode ser em branco.\\n";
    }
    //testando a variável e_cpf	  	
   if ($e_cpf == "") {
        $erro = $erro . "CPF Inválido.\\n";
    }
    //testando a variável e_mail	  
   if ($e_email == "") {
        $erro = $erro . "e-mail Inválido.\\n";
    }
    //testando a variável e_senha	  
   if ($e_senha == "") {
        $erro = $erro . "Senha não pode ser em branco.\\n";
    } else {
        if ($e_contrasenha != $e_senha) {
            $erro = $erro . "Senha não confere.";
        }
    }
    return $erro;
}

function mostra_janela($texto)
{
 echo "<script type=\"text/javascript\" language=\"javascript\">";
   echo "alert(\"$texto\");";
 echo "</script>";
}


?>

<?php
$op = $_REQUEST['op'];
//testando a existência da variável op
if (!isset($op)) {
    $op = 0;
}

if ($op == 0) {
    //resetar variáveis
    $e_nome = "";
    $e_cpf = "";
    $e_email = "";
    $e_senha = "";
    $e_contrasenha = "";
}
if ($op == 1) {
    //obter os dados do formulário
    $e_nome = @ $_REQUEST['e_nome'];
    $e_cpf = @ $_REQUEST['e_cpf'];
    $e_email = @ $_REQUEST['e_email'];
    $e_senha = @ $_REQUEST['e_senha'];
    $e_contrasenha = @ $_REQUEST['e_contrasenha'];
    //validar dados
    $err = valida_dados($e_nome, $e_cpf, $e_email, $e_senha, $e_contrasenha);
    if ($err == "") {
        if (conecta()) {
            //testar se já existe o cadastro que está sendo inserido
            $texto_sql = "SELECT * FROM cad_aluno where cpf='$e_cpf'";
            $mysqli = new mysqli('localhost', 'root', '', 'db_lgd');
            $resultado = mysqli_query($mysqli, $texto_sql);
            if (@mysql_num_rows($resultado) == 0) {
                //inserir dados no banco de dados
                $texto_sql = "INSERT INTO cad_aluno (nome, cpf, email, senha) VALUES ('$e_nome', '$e_cpf', '$e_email', '$e_senha')";
                $resultado = mysqli_query($mysqli, $texto_sql);
                if ($resultado > 0) {
                    //dados inseridos com sucesso 
                    mostra_janela("Dados inseridos com sucesso!");
                    //resetar variáveis
                    $e_nome = "";
                    $e_cpf = "";
                    $e_email = "";
                    $e_senha = "";
                    $e_contrasenha = "";
                } else { //erro na inserção dos dados   
                    mostra_janela("Erro na inserção dos dados!");
                }
            } else { //dados não podem ser inseridos pois já existe a chave na tabela
                mostra_janela("Usuário já cadastrado!");
            }
        } else {
            //erro de conexão  
            mostra_janela("Ocorreu um problema indeterminado com o sistema.\\nEspere alguns instantes e tente novamente!");
        }
    } else {
        //erro nos dados  
        mostra_janela($err);
    }
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Castro de Usuários</title>
    </head>

    <body>
        <form id="form_caduser" name="form_caduser" method="post" action="cadastro_aluno.php?op=1">
            <table width="567" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="563"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="2" align="center" bgcolor="#00FFFF"><strong>CADASTRO DE USUÁRIO</strong></td>
                            </tr>
                            <tr>
                                <td width="26%" align="right">Nome:</td>
                                <td width="74%"><label for="e_nome"></label>
                                    <input name="e_nome" type="text" id="e_nome" value="<?php echo $e_nome; ?>" size="50" maxlength="50" /></td>
                            </tr>
                            <tr>
                                <td align="right">C.P.F.:</td>
                                <td><label for="e_cpf"></label>
                                    <input name="e_cpf" type="text" id="e_cpf" value="<?php echo $e_cpf; ?>" size="11" maxlength="11" /></td>
                            </tr>
                            <tr>
                                <td align="right">e-mail:</td>
                                <td><label for="e_email"></label>
                                    <input name="e_email" type="text" id="e_email" value="<?php echo $e_email; ?>" size="50" maxlength="50" /></td>
                            </tr>
                            <tr>
                                <td align="right">Senha:</td>
                                <td><label for="e_senha"></label>
                                    <input name="e_senha" type="password" id="e_senha" value="<?php echo $e_senha; ?>" size="8" maxlength="8" /></td>
                            </tr>
                            <tr>
                                <td align="right">Contra-Senha:</td>
                                <td><label for="e_contrasenha"></label>
                                    <input name="e_contrasenha" type="password" id="e_contrasenha" value="<?php echo $e_contrasenha; ?>" size="8" maxlength="8" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" name="Submit" id="button" value="Cadastrar" />
                                    <input type="reset" name="button2" id="button2" value="Limpar" /></td>
                            </tr>
                        </table></td>
                </tr>
            </table>


        </form>
    </body>
</html>