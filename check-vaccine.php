<?php
require __DIR__ . '/vendor/autoload.php';

/**
 * CONFIGURATION AREA
 */

//Your personal Information (required)
$zipCode = '12345'; //Example: 26127
$birthdate = '01.01.2000'; //Example: 01.01.2000
$birthdate = str_replace('.','',$birthdate);

// for which vaccine types do you want to get notifications?
$messageForVector = true; // true or false
$messageForMRNA = true; //true or false

//E-Mail credentials
//recommendation: for security reasons, create a new e-mail account for example
//a new gmx.net mailbox
$mailHost = 'mail.gmx.net'; //mail smtp host example: mail.gmx.net
$mailPort = 465; //for gmx.net use: 465 if you want to use ssl
$mailEncryption = 'ssl'; //standard is ssl
$mailUsername = 'exampleEmailAddress@gmx.de'; //should be your email address for example text@gmx.de
$mailPasswort = 'examplePassword'; //the password for the email above
$receiverEmail = 'receiverAddress@yourdomain.de'; //your actual email address you want to receive the email with

/**
 * END OF CONFIGURATION AREA
 */

$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://www.impfportal-niedersachsen.de/portal/rest/appointments/findVaccinationCenterListFree/' . $zipCode .'?stiko=&count=1&birthdate=' . $birthdate .'&showWithVectorVaccine=true');
$result = json_decode($response->getBody()->getContents());
$resultArray = $result->resultList;
$vaccineName = null;
if($resultArray[0]->vaccineType == 'Vector' && $messageForVector){
    $vaccineName = $resultArray[0]->vaccineName;
    // Create the Transport
    $transport = (new Swift_SmtpTransport($mailHost, $mailPort,$mailEncryption))
        ->setUsername($mailUsername)
        ->setPassword($mailPasswort)
    ;

// Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

// Create a message
    $message = (new Swift_Message('Impfplätze sind frei'))
        ->setFrom([$mailUsername => 'Impfbenachrichtigung'])
        ->setTo([$receiverEmail])
        ->setBody('<p>Hallo,</p><p>dies ist dein eingerichteter Impfbot. Es sind neue Impfplätze für einen Vektor Impfstoff in deinem Impfzentrum frei. </p><p>Folgender Impfstoff wird angeboten: <strong>' . $vaccineName .'</strong>.</p><p>Buche dir deinen Termin über <a href="https://www.impfportal-niedersachsen.de">https://www.impfportal-niedersachsen.de</a>. Bitte denke daran diesen Bot auszuschalten, wenn du ihn nicht mehr benötigst. Nur dadurch kann unnötiger Spam vermieden werden.</p><p>Wenn dir der Bot geholfen hat, lasse es mich gerne wissen: <a href="https://github.com/lukasboc/impfbenachrichtigung-nds-bot/discussions">https://github.com/lukasboc/impfbenachrichtigung-nds-bot/discussions</a></p><p>Viele Grüße<br>Lukas</p>','text/html')
    ;

// Send the message
    $sentMessage = $mailer->send($message);
}

if($resultArray[0]->vaccineType == 'mRNA' && $messageForMRNA){
    $vaccineName = $resultArray[0]->vaccineName;
    // Create the Transport
    $transport = (new Swift_SmtpTransport($mailHost, $mailPort,$mailEncryption))
        ->setUsername($mailUsername)
        ->setPassword($mailPasswort)
    ;

// Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

// Create a message
    $message = (new Swift_Message('Impfplätze sind frei'))
        ->setFrom([$mailUsername => 'Impfbenachrichtigung'])
        ->setTo([$receiverEmail])
        ->setBody('<p>Hallo,</p><p>dies ist dein eingerichteter Impfbot. Es sind neue Impfplätze für einen mRNA Impfstoff in deinem Impfzentrum frei. </p><p>Folgender Impfstoff wird angeboten: <strong>' . $vaccineName .'</strong>.</p><p>Buche dir deinen Termin über <a href="https://www.impfportal-niedersachsen.de">https://www.impfportal-niedersachsen.de</a>. Bitte denke daran diesen Bot auszuschalten, wenn du ihn nicht mehr benötigst. Nur dadurch kann unnötiger Spam vermieden werden.</p><p>Wenn dir der Bot geholfen hat, lasse es mich gerne wissen: <a href="https://github.com/lukasboc/impfbenachrichtigung-nds-bot/discussions">https://github.com/lukasboc/impfbenachrichtigung-nds-bot/discussions</a></p><p>Viele Grüße<br>Lukas</p>','text/html')
    ;

// Send the message
    $sentMessage = $mailer->send($message);
}