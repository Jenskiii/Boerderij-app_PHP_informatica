<?php

// error messages
function urlAlertMessages($message)
{
  // errormessages
  $errorMessages = [
    'standard' => 'Oeps, er is iets fout gegaan!',
    'edit_fail' => 'Wijziging niet gelukt!',
    'no_post' => 'Ongeldig toegang, alleen te bereiken via POST!',

    // img upload errors
    'incomplete_file' => 'Bestand alleen gedeeltelijk geüpload!',
    'no_file' => 'Geen bestand is geüpload!',
    'upload_stopped' => 'Bestand upload is gestopt door PHP!',
    'unknown_error' => 'Onbekende upload error!',
    'file_too_large' => 'Bestand is te groot!',
    'invalid_type' => 'Alleen .JPEG en .PNG toegestaan!',
    'no_tempfolder' => 'Tijdelijke folder niet gevonden!',
    'no_save' => 'Bestand niet kunnen opslaan!',
    'move_upload' => 'Kan het geüploade bestand niet verplaatsen!',

    // FORM
    'invalid_number_input' => 'Invoer mag alleen bestaan uit nummers!',
    'invalid_letter_input' => 'Invoer mag alleen bestaan uit letters!'
  ];
  // succesmessages
  $successMessages = [
    'payment' => 'Veel plezier met uw product!',
    'change' => 'Wijziging is succesvol!',
    'add_product' => 'Product is succesvol toegevoegd!',
    'empty_vak' => 'Vak is geleegd!',
    'edit_success' => 'Wijziging gelukt!',
  ];

  // Check eerst errorMessages
  if ($message !== null && isset($errorMessages[$message])) {
    return $errorMessages[$message];
  }

  // Check successMessages
  if ($message !== null && isset($successMessages[$message])) {
    return $successMessages[$message];
  }


}
