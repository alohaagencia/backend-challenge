<?php
class Utils{

  public static function toSlug($str, $delimiter = '-',$limit = null) {
    $map = array('á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'é' => 'e', 'ê' => 'e', 'í' => 'i', 'ó' => 'o',
      'ô' => 'o', 'õ' => 'o', 'ú' => 'u', 'ü' => 'u', 'ç' => 'c', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A', 'Â' => 'A',
      'É' => 'E', 'Ê' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ç' => 'C'
    );
    $str = strtr($str, $map);

    $str = preg_replace('~[^\\pL\d]+~u', $delimiter, $str);
    $str = trim($str, $delimiter);
    setlocale(LC_ALL, 'pt_BR.utf8');
    $str = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $str = strtolower($str);
    $str = preg_replace('~[^-\w]+~', '', $str);
    if (empty($str)) {
      return 'n-a';
    }
    if($limit){
      $str = substr($str, 0, $limit);
    }
    return $str;
  }

  public static function removeAccents($str,$lowercase = false){
    $map = array('á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'é' => 'e', 'ê' => 'e', 'í' => 'i', 'ó' => 'o',
      'ô' => 'o', 'õ' => 'o', 'ú' => 'u', 'ü' => 'u', 'ç' => 'c', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A', 'Â' => 'A',
      'É' => 'E', 'Ê' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ç' => 'C'
    );
    $str = strtr($str, $map);
    if($lowercase){
      $str = mb_strtolower($str);
    }
    return $str;
  }

}