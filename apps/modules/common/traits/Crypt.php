<?php

namespace Agenda\Modules\Common\Traits;

trait Crypt {

  protected static function getKeyCrypt() {
    return "Fazer dinheiro é arte, e... Andy Warhol";
  }
  
  public static function base64url_encode($data) { 
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
  } 

  public static function base64url_decode($data) { 
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
  } 
  
  public static function encrypt($value, $key = null){
    if (! $key) {
      $key = self::getKeyCrypt();
    }
    return self::base64url_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $value, MCRYPT_MODE_ECB));
  }

  public static function decrypt($value, $key = null){
    if (! $key) {
      $key = self::getKeyCrypt();
    }
    return trim(mcrypt_decrypt(MCRYPT_BLOWFISH, $key, self::base64url_decode($value), MCRYPT_MODE_ECB));
  }
  
}