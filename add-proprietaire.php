<?php 

require_once (__DIR__.DIRECTORY_SEPARATOR.'/db/connexion.php');

//echo '<pre>';
//var_dump($_POST);
// echo '</pre>';

//DSN ( Data Source Name)

// $link = mysqli_connect("localhost", "root", "", "animaux domestiques");
//  // Check connection
//  if($link === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }

//on insère les données dans la BDD
require "db/connexion.php";

 $titre = $nom_proprietaire = $prenom_proprietaire =  "";


 $titre_err = $nom_proprietaire_err = $prenom_proprietaire_err = "";


 if (isset($_POST["nom_proprietaire"])) {

    if (isset($_POST["titre"])) {
           
      $titre = $_POST["titre"];
    }
    if (isset($_POST["nom_proprietaire"])) {
        $nom_proprietaire = $_POST["nom_proprietaire"]; 
}

if (isset($_POST["prenom_proprietaire"])){
$prenom_proprietaire = $_POST["prenom_proprietaire"];
}
  // if (isset($_POST["nom"])) {

    $sql = "INSERT INTO `propriétaire` (`proprietaire_id`, `titre`, `nom`, `prénom`) 
    VALUES (NULL, ?, ?, ?)";

//préparation de la requete ci-dessus
try {
    $connexion2 = new Connexion();
    $statement = $connexion2->prepare($sql);
    $statement->execute([$titre, $nom_proprietaire, $prenom_proprietaire]);
    header("location:liste-proprietaire.php?erreur=dbErreur");
} catch (PDOException $ex) {
  header("location:add-proprietaire.php?erreur=dbErreur");
}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Ajout d'un proprétaire</title>
</head>
<body>
 



<div class="content">
  
   <div class="cat">

     <div class="ears">
       <span></span>
       <span></span>
     </div>

     <div class="eyes">
       <span></span>
       <span></span>
       <span></span>
       <span></span>
     </div>

     <div class="nose">
       <span></span>
       <span></span>
     </div>

     <div class="mouth">3</div>

     <div class="paws">
       <span></span>
       <span></span>
     </div>

     <div class="tail"></div>

   </div>


   <div class="cat2">

     <div class="ears">
       <span></span>
       <span></span>
     </div>

     <div class="eyes">
       <span></span>
       <span></span>
       <span></span>
       <span></span>
     </div>

     <div class="nose">
       <span></span>
       <span></span>
     </div>

     <div class="mouth">3</div>

     <div class="paws">
       <span></span>
       <span></span>
     </div>

     <div class="tail"></div>

   </div>

</div>


</div>

<div class="container">
<form action="" method="post">

  <div class="form-group"> <br>

  <label for="Propriétaire"> Propriétaire : </label> <br>
            
  <div>
    <label for="titre">Mr</label>
    <input type="checkbox" id="scales" name="titre" value="Mr">
    <label for="titre">Mme</label>
    <input type="checkbox" id="scales" name="titre" value="Mme">
  </div>
  <br>
  
  <label for="Nom"> Nom </label>
  <input type="text" id="Nom" name="nom_proprietaire" required pattern="[a-zA-Z]{2,}";> <br>
  
  
  <label for="Prénom"> Prénom </label>
  <input type="text" id="Prenom" name="prenom_proprietaire" required pattern="[a-zA-Z]{2,}";>
  
  
  
  <br> <br>
  
  
  <input type="submit" id="ajout" value="Ajouter le proprétaire">
</div>


</form>
</div>

<!-- <button id="proan">Aller vers la page d'ajout d'animal</button> -->
</body>
<!-- <script src="/script.js"></script> -->
</html>