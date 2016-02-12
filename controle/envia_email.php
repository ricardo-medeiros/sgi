<?php
	define('__ROOT__',dirname(dirname(__FILE__)));
	require_once(__ROOT__.'/PHPMailer/PHPMailerAutoload.php');
	
	$mail = new PHPMailer();
	$mail->SetLanguage('br');
	
	$assunto = 'O ASSUNTO DO EMAIL';
	$mensagem = 'A MENSAGEM DO EMAIL. PODE SER HTML.';
	//$seu_email = 'jckadinho@gmail.com';
	$seu_email = 'atendimento@sgi-web.pe.hu';
	$seu_nome = 'Ricardo Medeiros';
	//$sua_senha = 'rick3332';
	$sua_senha = '8DIPO6sbSK';
	
	/* Se for do Gmail o servidor �: smtp.gmail.com */
	$host_do_email = 'mx1.hostinger.com.br';
	
	/* Configura os destinat�rios (pra quem vai o email) */
	$mail->AddAddress('jcricardomedeiros@gmail.com', 'Ricardo Teste');
	// $mail->AddAddress('email@email.com');
	// $mail->AddCC('email@email.com', 'Nome da pessoa'); // Copia
	// $mail->AddBCC('email@email.com', 'Nome da pessoa'); // C�pia Oculta
	
	/* ###########################
	 * # CONFIGURA��ES AVAN�ADAS #
	* ###########################
	*/
	
	$mail->SMTPDebug = 1;
	/* Define que � uma conex�o SMTP */
	$mail->IsSMTP();
	/* Define o endere�o do servidor de envio */
	$mail->Host = $host_do_email;
	/* Utilizar autentica��o SMTP */
	$mail->SMTPAuth = true;
	/* Protocolo da conex�o */
	$mail->SMTPSecure = "ssl";
	/* Porta da conex�o */
	$mail->Port = "587";
	/* Email ou usu�rio para autentica��o */
	$mail->Username = $seu_email;
	/* Senha do usu�rio */
	$mail->Password = $sua_senha;
	
	/* Configura os dados do remetente do email */
	$mail->From = $seu_email; // Seu e-mail
	$mail->FromName = $seu_nome; // Seu nome
	
	/* Configura a mensagem */
	$mail->IsHTML(true); // Configura um e-mail em HTML
	
	/*
	 * Se tiver problemas com acentos, modifique o charset
	 * para ISO-8859-1
	*/
	$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
	
	/* Configura o texto e assunto */
	$mail->Subject  = $assunto; // Assunto da mensagem
	$mail->Body = $mensagem; // A mensagem em HTML
	$mail->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro
	
	/* Configura o anexo a ser enviado (se tiver um) */
	//$mail->AddAttachment("foto.jpg", "foto.jpg");  // Insere um anexo
	
	/* Envia o email */
	$email_enviado = $mail->Send();
	
	/* Limpa tudo */
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	
	/* Mostra se o email foi enviado ou n�o */
	if ($email_enviado) {
		//echo "Email enviado!";
		header("Location: http://localhost:90/sgi/index.php");
	} else {
		echo "N�o foi poss�vel enviar o e-mail.<br /><br />";
		echo "<b>Informa��es do erro:</b> <br />" . $mail->ErrorInfo;
	}
?>