# Composer novembre/mail
*SendMail in WP*

Envoi d'un email configuré avec MJML

```
$_mail = new Novembre\Mail\Mail();
$_mail->setSubject("Email de test");
$_mail->setFrom("digital@novembre.com");
$_mail->setFromName("Novembre");

// le template est ici : src/mail/mail-nomdutemplate.mjml et sera généré par gulp
$_mail->setOptions(array(
    "mjml" => true,
    "template" => "nomdutemplate"
));

// Assignation de variable disponible dans le template ( <?php echo $title; ?> )
$_mail->assign(array(
	'title' => "Titre",
	'description' => "Description"
));

// Plusieurs adresses sont admises
// Retourne boolean si envoyé ou non
$_mail->send(array(
    'coudert@novembre.com'
));
```

Envoi d'un email sans MJML

```
$_mail = new Novembre\Mail\Mail();
$_mail->setSubject("Email de test");
$_mail->setFrom("digital@novembre.com");
$_mail->setFromName("Novembre");

// le template est ici : templates/views/mails/mail-nomdutemplate.php
// Il sera intégré dans un layout ici : templates/views/layouts/layout-mail.php
$_mail->setOption(array(
    "template" => "nomdutemplate",
    "layout" => "mail"
));

// Assignation de variable disponible dans le template ( <?php echo $title; ?> )
$_mail->assign(array(
	'title' => "Titre",
	'description' => "Description"
));

// Plusieurs adresses sont admises
// Retourne boolean si envoyé ou non
$_mail->send(array(
    'coudert@novembre.com'
));
```
