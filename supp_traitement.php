<?php
//Vérifier le jeton CSRF
require "db/connexion.php";
//création d'objet connexion
try {
  $connexion = new Connexion();
} catch (PDOException $ex) {
  echo "KO";
  exit;
}

try {
  $sql = "delete from animaux where =:id";
  $pdoStat = $connexion->prepare($sql);
  $pdoStat->bindParam(":id", $_POST["id"]);
  $pdoStat->execute();
  echo "OK";
} catch (PDOException $ex) {
  echo "KO";
}