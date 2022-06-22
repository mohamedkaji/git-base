<?php 

require_once (__DIR__.DIRECTORY_SEPARATOR.'/db/connexion.php');

function uploadFile($paramName)
{
  // On donne un repertoire pour stocker les photos
  $uploadDirectory = "uploads/";

  $fileName = $_FILES[$paramName]['name'];
  $fileTmpName  = $_FILES[$paramName]['tmp_name'];
  $uploadPath = $uploadDirectory . basename($fileName);
  $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
  if (!$didUpload) {
    throw new Exception("Echec d'enregistrement de fichier sur le serveur");
  }
  return $uploadPath;
}

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
// require "db/connexion.php";
try {
  // Créér une connexion entre PHP et la base de données
  $connexion2 = new Connexion();
  // On récupère les noms génériques
  $sql_gen = "SELECT * FROM `nom_générique`";
  $pdoStatement = $connexion2->query($sql_gen);
  $all_gen = $pdoStatement->fetchAll();

  // On récupère les propriétaires
  $sql_gen = "SELECT * FROM `propriétaire`";
  $pdoStatement = $connexion2->query($sql_gen); // préparation de la requete
  $all_pro = $pdoStatement->fetchAll();
} catch (PDOException $ex) {
  // var_dump($ex);
  // location : redirection
  header("location:add-animal.php?erreur=dbErreur");
} catch (Exception $ex) {
  // var_dump($ex->getMessage());
  header("location:add-animal.php?erreur=dbErreur");
}

// $sql_gen = "SELECT * FROM `nom_générique`";
// $all_gen = mysqli_query($link,$sql_gen);


$nom = $nom_generique =  $photo = "";


$nom_err = $nom_generique_err = $photo_err = "";


 if (isset($_POST["nom"])) {
//     // Check nom
//     if(empty(trim($_POST["nom"]))){
//             $nom_err = "Entrer le nom de votre animal.";
//             } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["nom"]))){
//                     $prenom_err = "Ce champ peut contenir uniquement des lettres et sans accent.";
//                 } else{
//                         $nom = $_POST["nom"];
//                         }
                
//                 // Check nom gen
//                 if(empty(trim($_POST["nom_generique"]))){
//                         $nom_generique_err = "Entrer le nom générique.";
//                         } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["nom_generique"]))){
//                                 $prenom_err = "Ce champ peut contenir uniquement des lettres et sans accent.";
//             } else{
//                     $nom_generique = $_POST["nom_generique"];
//                     }
            
//                 // Check nom gen
//                 if(empty(trim($_POST["nom_generique"]))){
//                         $nom_generique_err = "Entrer le nom générique.";
//                         } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["nom_generique"]))){
//                                 $prenom_err = "Ce champ peut contenir uniquement des lettres et sans accent.";
//                             } else{
//                                     $nom_generique = $_POST["nom_generique"];
//                                     }
    


    if (isset($_POST["nom"])) {
           
    $nom = $_POST["nom"]; }

    if (isset($_POST["nom_g"])) {
           
      $nom_generique = $_POST["nom_g"]; }
  

    if (isset($_POST["proprietaire_id"])) {
           
      $id = $_POST["proprietaire_id"];
    }

// if (isset($_POST["photo"])){
//   $photo = $_POST["photo"]; 
//   }

  $uploadPath = uploadFile("photo");
    $sql = "INSERT INTO `animaux` (`animaux_id`, `nom_propre`, `photo`, 
    `proprietaire_id`, `nom_generique_id`)     VALUES (NULL, ?, ?, ?, ?)";

//préparation de la requete ci-dessus
try {
    $statement = $connexion2->prepare($sql);
    $statement->execute([$nom, $uploadPath, $id, $nom_generique]);
    header("location:index.php");
} catch (PDOException $ex) {
  header("location:add-animal.php?erreur=dbErreur");
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
    <title>Animaux Domestiques</title>
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

<div class="content">
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
 <!-- enctype : pour envoyer des fichiers vers le serveur, uploader  -->
<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group"> <br>
  
  <label>Nom</label>
  <input id="nom" type="text" name="nom" value="<?php echo $nom; ?>" required pattern="[a-zA-Z]{2,}";> <br>
  
  <label>Nom générique</label>
  <select name="nom_g">
    <option value="">
    <?php foreach ($all_gen as $gen):?>
      <option value="<?= $gen["nom_generique_id"];?>"><?= $gen["nom_"];?>
      <?php endforeach;?>
  </select>
  <br>
  
  
  <label for="photo"> Photo </label>
  <input type="file" id="photo" name="photo"> <br> <br> 

  <label>Propriétaire</label>
  <select name="proprietaire_id">
    <option value="">

    <?php foreach ($all_pro as $prop):?>
      <option value="<?= $prop["proprietaire_id"];?>"><?= $prop["nom"]." ". $prop["prénom"]; ?>
      <?php endforeach;?>
    
  </select>

  <br> <br>
  
  <input type="submit" id="ajout" value="Ajouter l'animal">
</div>


</form>
</div>

</body>
</html>
