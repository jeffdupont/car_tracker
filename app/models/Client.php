<?php

class Client extends Eloquent {

  function phone_format() {

    $phone = $this->phone;

    // remote all but the numbers
    $phone = preg_replace('/[^\d]/', '', $phone);

    switch( strlen($phone) ) {

      case 10:
      preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $phone, $matches );
      $phone = '(' . $matches[1] . ') ' .$matches[2] . '-' . $matches[3];
      break;

      case 11:
      preg_match( '/^(\d)(\d{3})(\d{3})(\d{4})$/', $phone, $matches );
      $phone = '+' . $matches[1] . ' (' . $matches[2] . ') ' .$matches[3] . '-' . $matches[4];
      break;

      case 7:
      preg_match( '/^(\d{3})(\d{4})$/', $phone, $matches );
      $phone = $matches[1] . '-' .$matches[2];
      break;
    }

    return $phone;
  }
  
}