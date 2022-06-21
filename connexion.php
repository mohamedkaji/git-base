<?php

//on créé une classe pour pouvoir créér des objets de type connexion
// notre classe hérite de la classe PDO (permet de communiquer avec la base de données)
class Connexion extends PDO
{
  public function __construct($configFile = "config/db.ini")
  {
    //lire le fichier ini
    $iniTab = parse_ini_file($configFile);
    if (!$iniTab) {
      $dsn = "mysql:host=localhost;dbname=animaux domestiques";
      $user = "root";
      $password = "";
      $options = [];
    } else {
      $host = $iniTab["server"];
      $dbname = $iniTab["dbname"];
      $user = $iniTab["user"];
      $password = $iniTab["password"];
      $dsn = "mysql:host=$host;dbname=$dbname";
      $options = [];
    }
    // création d'objet connexion
    parent::__construct($dsn, $user, $password, $options);
    // Pour gérer les exceptions
    parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}