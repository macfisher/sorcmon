<?php

// IMAP must be enabled for gmail account
// sudo apt-get install sendmail
// sudo apt-get install php-pear
// sudo pear install Mail
// sudo pear install Net_SMTP
// turned this on: enabled less secure apps for from@gmail.com
// https://www.google.com/settings/security/lesssecureapps
// Very slight security issue, but can be fixed later.

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
	        'host' => 'ssl://smtp.gmail.com',
	        'port' => '465',
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

sendMail(
	'from@example.com',
	'password_str', 
	'<from@example.com>',
	'<to@example.com>',
	'Testing...',
	"SORC LAB TESTING:\n\nEMAIL TESTING"
);