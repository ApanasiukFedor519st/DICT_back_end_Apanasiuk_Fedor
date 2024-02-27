<?php
$subject = 'New Email';

echo '----------' . "\n";
echo $subject . "\n";
echo '----------' . "\n";

$firstName = 'Fedor';
$text1 = "firstName : {$firstName}" . "\n";

$lastName = 'Apanasiuk';
$text2 = "lastName : {$lastName}" . "\n";

$location = 'Kharkiv, Ukraine';
$text3 = "location : {$firstName}" . "\n";

$occupaion = 'student';
$text4 = "firstName : {$occupaion}" . "\n";

$date = '31.01.2009';
$text5 = "date : {$date}" . "\n";
$text6 = "What???";
$message = $text1 . $text2 . $text3. $text4. $text5. $text6;
echo $message;
$headers = 'From: a.fedorik@gmail.com';
mail('b.bagdanovish@gmail.com', $subject, $message, $headers);