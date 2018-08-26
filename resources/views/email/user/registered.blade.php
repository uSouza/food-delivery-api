<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>E-mail de Boas Vindas!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <style type="text/css">
        div, p, a, li, td { -webkit-text-size-adjust:none; }
    </style>
</head>
<body style="margin:0;padding:0;font-family: helvetica;">
<table width="600" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td style="padding:10px 0 10px 0;" bgcolor="#2d2f3a" align="center">
            <img alt="Pandeco" style="display:block;"
                 src="<?php echo $message->embed(public_path().'/email/users/logo.png'); ?>">
        </td>
    </tr>
    <tr>
        <td style="padding:20px 20px 20px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border-bottom:2px solid #ccc;padding:30px 0 30px 0;">
                        <span style="color:#888;font-size:22px;">Olá, {{$user->name}}</span>
                        <p style="color:#888;font-size:16px;">Nossa empresa tem o prazer de lhe dar boas vindas e agradecer pela sua recente inclusão em nosso portfólio de clientes. </p>
                        <p style="color:#888;font-size:16px;">Trabalhamos para oferecer o melhor jeito de realizar pedidos de marmitas, buscando sempre a excelência no atendimento com qualidade e tecnologia! </p>
                        <p style="color:#888;font-size:16px;">A parceria se inicia agora, e no que depender de nós, será muito proveitosa.</p>
                        <p style="color:#888;font-size:16px;">Temos por missão, tornar simples e moderno o processo de pedido, agendamento e entrega de refeições prontas, facilitando a interação entre restaurantes e consumidores através do meio eletrônico.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px 20px 20px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="250">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <img alt="Image" style="display:block;"
                                         src="<?php echo $message->embed(public_path().'/email/users/img.png'); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0 10px 0;color:#666;font-size:15px;line-height:21px;">
                                    Agende seus pedidos, nunca mais deixe pra realizar pedidos em cima da hora.
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="60"></td>
                    <td valign="top" width="250">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <img alt="Contato" style="display:block;"
                                         src="<?php echo $message->embed(public_path().'/email/users/contato.png'); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0 10px 0;color:#666;font-size:15px;line-height:21px;">
                                    Entre em contato por meio de nosso e-mail <span style="color:blue">contato@pandeco.com.br</span> ou nosso whatsap (45) 9 9105-8739.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px 20px 20px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0">

            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:15px 10px 15px 10px;color:#1FF;" bgcolor="#fec73c" >
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="480" style="color:#000;font-size:13px;" align="left">Pandeco 2018 - Todos os direitos reservados</td>
                    <td style="font-size:12px;" width="30" align="left"><a style="color:#000" target="_blank" href="https://www.pandeco.com.br">Website</a></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>