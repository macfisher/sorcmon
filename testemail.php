<?php

// Pear Mail Library
require_once "Mail.php";

function sendMail($usr, $passwd, $from, $to, $subject, $body) {

	$from = $from;
	$to = $to;
	$subject = $subject;
	$body = $body; //"Hi,\n\nHow are you?"

	$headers = array(
	    'From' => $from,
	    'To' => $to,
	    'Subject' => $subject
	);

	$smtp = Mail::factory('smtp', array(
            'host' => 'smtp.gmail.com'
            'port' => '587',
	        'auth' => true,
	        'username' => $usr,
	        'password' => $passwd
	    ));


	$mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
	    echo('<p>' . $mail->getMessage() . '</p>');
	} else {
	    echo('<p>Message successfully sent!</p>');
	}
}

$cf = json_decode(file_get_contents('/var/www/public/sorcmon/scratch/config.json'));
sendMail(
    $cf->user,
    $cf->password,
    $cf->from,
    $cf->to,
    "Testing...",
    "This is a test email from sorcmon!"
);