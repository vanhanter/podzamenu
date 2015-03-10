<?php

namespace Podzamenu\MainBundle\Model;

class UsefullModel
{
    public function check_email($adress, $href)
    {
        $subject = "Активация учетной записи";
        $message = "<p>Уважаемый пользователь!</p>\r\n
                <p>Вы получили данное сообщение в связи с регистрацией пользователя www.podzamenu.ru,
                связанного с данным адресом электронной почты. Если вы не отправляли такой запрос,
                просто не обращайте внимание на данное сообщение.</p><br/>\r\n
                <p>Для активации учетной записи <span style='font-weight: bold; font-size: 20px;'>".$adress."</span> кликните по ниже указанной ссылке:</p>\r\n
                <a href='http://www.podzamenu.ru/confirm-email/".$href."'>
                http://www.podzamenu.ru/confirm-email/".$href."</a></p><br/><br/><br/>\r\n
                <p>Внимание! Ссылка для активации учетной записи действительна в течении часа.</p>\r\n
                <p>При возникновении вопросов относительно безопастности вашего аккаунта, вы можете связаться с нами
                <a href='mailto:info@podzamenu.ru'>info@podzamenu.ru</a></p>\r\n
                <p>Данное сообщение отправлено автоматически. Не отвечайте на него.</p>\r\n
                <a href='http://www.podzamenu.ru'>http://www.podzamenu.ru</a>";

        $header = "Content-type: text/html; charset=\"utf-8\""."\r\n";
        $header.= "From: not_answer@podzamenu.ru"."\r\n";
        $header.= "Subject: $subject"."\r\n";
        $header.= "Content-type: text/html; charset=\"utf-8\""."\r\n";

        mail($adress, $subject, $message, $header);
    }
}