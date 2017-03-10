<?php

namespace App\Helpers;

class UploadFilesHelper
{
  
   public static function removerCaracterEspecial($string){
   // pegando a extensao do arquivo
       $partes  = explode(".", $string);
       $extensao    = $partes[count($partes)-1];    
   // somente o nome do arquivo
       $nome    = preg_replace('/\.[^.]*$/', '', $string);  
   // removendo simbolos, acentos etc
       $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ?';
       $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
       $nome = strtr($nome, utf8_decode($a), $b);
       $nome = str_replace(".","-",$nome);
       $nome = preg_replace( "/[^0-9a-zA-Z\.]+/",'-',$nome);
       return utf8_decode(strtolower($nome.".".$extensao));
   }

   public static function removerCaracterEspecialUrl($string){
  
       $nome    = preg_replace('/\.[^.]*$/', '', $string);  
   // removendo simbolos, acentos etc
       $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ?';
       $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
       $nome = strtr($nome, utf8_decode($a), $b);
       $nome = str_replace(".","-",$nome);
       $nome = preg_replace( "/[^0-9a-zA-Z\.]+/",'-',$nome);
       return utf8_decode(strtolower($nome));
   }
}
