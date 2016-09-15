<?php
   include('../minhas_funcoes.php'); 

   $op = @ $_REQUEST['op'];
   if (!isset($op))
     $op = 0;

   if ($op == 1)
   {
//campos usados para o envio de email

   		$destino  = @ $_REQUEST['e_destino'];
   		$assunto  = @ $_REQUEST['e_assunto'];
   		$mensagem = @ $_REQUEST['e_mensagem'];
   
   		$headers = 'From: aluno@portaldoctordj.com' . "\r\n" .
   		'Reply-To: aluno@portaldoctordj.com' . "\r\n" .
   		'X-Mailer: PHP/' . phpversion();
   
   		$resultado = mail($destino,$assunto,$mensagem,$headers); 
   		if ($resultado == true)
   		{
      		//echo "Enviando e-mail para $destino <br>";
      		mostra_janela("e-mail enviado com sucesso.");
   		}
   		else
      		mostra_janela("não foi possível envio o e-mail.");	
    } 
	     
?>

<html>
  <head>
     <title>Enviando e-mail...</title>
    
  </head>
  <body>
  <form name="form_email" method="post" action="email.php?op=1">
    <table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="center">Enviando e-mail</td>
      </tr>
      <tr>
        <td>Destino</td>
        <td><label for="e_destino"></label>
        <input name="e_destino" type="text" id="e_destino" size="60" maxlength="60"></td>
      </tr>
      <tr>
        <td>Assunto</td>
        <td><label for="e_assunto"></label>
        <input name="e_assunto" type="text" id="e_assunto" size="80" maxlength="80"></td>
      </tr>
      <tr>
        <td>Mensagem</td>
        <td><label for="e_mensagem"></label>
        <textarea name="e_mensagem" id="e_mensagem" cols="80" rows="20"></textarea></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Enviar"></td>
      </tr>
    </table>
  </form>
  </body>
</html>