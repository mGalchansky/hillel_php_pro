<?php
require_once 'vendor/autoload.php';
use Classes\ContactBuilder;

$contact = new ContactBuilder();
$newContact = $contact->name('Jon')
                      ->surname("Grey")
                      ->email('grey@gmail.com')
                      ->phone('+555-555-555-555')
                      ->address('Jon_Grey street 555')
                      ->build();
$newContact->getContact();