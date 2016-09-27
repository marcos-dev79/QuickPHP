<?php
/**
 * Created by PhpStorm.
 * User: marcos
 * Date: 18/07/16
 * Time: 21:43
 */

namespace Library\Emails;


class Emails
{
    public function registerMsg($nome, $email, $hash){
        $msg = '<p>Ol&aacute; '.$nome."</p>";
        $msg.= '<p>Recebemos os seus dados no site ObjetivaTour.com - Para prosseguir com a compra informamos tua senha</p>';
        $msg.= '<p><b>'.$hash."</b></p>";
        $msg.= "<p>Com esta senha &eacute; poss&iacute;vel comprar, editar o seu perfil, e receber suporte.</p>";
        $msg.= "<p>Muito Obrigado, </p>";
        $msg.= "<a href=\"http://objetivatour.com\">objetivatour.com</a>";

        $this->mailer($email, 'Confirmação de Cadastro Objetiva Tour', $msg);
    }

    public function userRegisterMsg($nome, $email, $hash){
        $msg = '<p>Bem-Vindo '.$nome."</p>";
        $msg.= '<p>Recebemos o seu cadastro no site ObjetivaTour.com - Guarde tua senha. Ela foi criptografada para sua segurança.</p>';
        $msg.= '<p><b>'.$hash."</b></p>";
        $msg.= "<p>Com esta senha &eacute; poss&iacute;vel comprar, editar o seu perfil, e receber suporte.</p>";
        $msg.= "<p>Muito Obrigado, </p>";
        $msg.= "<a href=\"http://objetivatour.com\">objetivatour.com</a>";

        $this->mailer($email, 'Confirmação de Cadastro Objetiva Tour', $msg);
    }

    public function newPassMsg($nome, $email, $hash){
        $msg = '<p>Olá '.$nome."</p>";
        $msg.= '<p>Recebemos a requisição para uma nova senha para seu perfil:</p>';
        $msg.= '<p><b>'.$hash."</b></p>";
        $msg.= "<p>Atenciosamente, </p>";
        $msg.= "<a href=\"http://objetivatour.com\">objetivatour.com</a>";

        $this->mailer($email, 'Recuperar Senha Objetiva Tour', $msg);
    }

    public function contatoMsg($nome, $email, $tel, $msg_contato){
        $msg = '<p>Olá Objetiva Tour</p>';
        $msg.= '<p>Recebemos uma mensagem de contato no seu site:</p>';
        $msg.= "<p><b>Nome:</b> {$nome}</p>";
        $msg.= "<p><b>Email:</b> {$email}</p>";
        $msg.= "<p><b>Telefone:</b> {$tel}</p>";
        $msg.= '<p><b>Mensagem:</b> '.$msg_contato."</p>";
        $msg.= "<p>Por favor não responda diretamente este email. Clique no email do contato.</p>";
        $msg.= "<a href=\"http://objetivatour.com\">Via objetivatour.com</a>";

        $this->mailer('contato@objetivatour.com', 'Novo contato do seu site', $msg);
    }

    private function mailer($email, $subject, $msg){

        $mail = new \PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPDebug = false;
        $mail->SMTPAuth = true;
        $mail->CharSet = 'utf-8';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->SMTPSecure = "ssl";
        $mail->Username = "contato@objetivatour.com";
        $mail->Password = "escritorio16";
        //$mail->SMTPDebug = 4;

        $mail->Subject  = $subject;
        $mail->Body     = $msg;
        $mail->WordWrap = 50;
        $mail->addReplyTo("contato@objetivatour.com");

        $address = $email;
        $mail->AddAddress($address);

        $mail->SetFrom("contato@objetivatour.com", "Objetiva Tour");

        $return = $mail->Send();

        if($return) {
            return true;
        }
        else{
            return false;
            //die($mail->ErrorInfo);
        }
    }
}