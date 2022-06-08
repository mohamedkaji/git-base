<?php 

require_once (__DIR__.DIRECTORY_SEPARATOR.'login.php');

echo '<pre>';
var_dump($_POST);
echo '</pre>';

$link = mysqli_connect("localhost", "root", "", "animaux domestiques");
 // Check connection
 if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$sql_gen = "SELECT * FROM `nom_générique`";
$all_gen = mysqli_query($link,$sql_gen);


$nom = $nom_generique = $titre = $nom_proprietaire = $prenom_proprietaire = $photo = "";


$nom_err = $nom_generique_err = $titre_err = $nom_proprietaire_err = $prenom_proprietaire_err = $photo_err = "";


if (isset($_POST)) {
    // Check nom
    // if(empty(trim($_POST["nom"]))){
        //     $nom_err = "Entrer le nom de votre animal.";
        //     } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["nom"]))){
            //         $prenom_err = "Ce champ peut contenir uniquement des lettres et sans accent.";
            //     } else{
                //         $nom = $_POST["nom"];
                //         }
                
                // // Check nom gen
                // if(empty(trim($_POST["nom_generique"]))){
                    //     $nom_generique_err = "Entrer le nom générique.";
                    //     } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["nom_generique"]))){
                        //         $prenom_err = "Ce champ peut contenir uniquement des lettres et sans accent.";
        //     } else{
            //         $nom_generique = $_POST["nom_generique"];
            //         }
            
            //     // Check nom gen
            //     if(empty(trim($_POST["nom_generique"]))){
                //         $nom_generique_err = "Entrer le nom générique.";
                //         } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["nom_generique"]))){
                    //             $prenom_err = "Ce champ peut contenir uniquement des lettres et sans accent.";
                    //         } else{
                        //             $nom_generique = $_POST["nom_generique"];
                        //             }
    $nom = $_POST["nom"];
    $nom_generique = $_POST["nom_g"];
    if (isset($_POST["titre"])) {
            $titre = $_POST["titre"];
        }
    $nom_proprietaire = $_POST["nom_proprietaire"];
    $prenom_proprietaire = $_POST["prenom_proprietaire"];
    $photo = $_POST["photo"];
    
    $sql = "INSERT INTO `propriétaire` (`proprietaire_id`, `titre`, `nom`, `prénom`) VALUES (NULL, '$titre', '$nom_proprietaire', '$prenom_proprietaire')";
    $sql_ok = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($sql_ok);
    var_dump(mysqli_stmt_store_result($sql_ok));

    if (mysqli_stmt_execute($sql_ok)) {
        echo 'yes';
        $sql3 = "SELECT * FROM `propriétaire`";
        // $sql_ok2 = mysqli_prepare($link, $sql2);
        foreach ($connect->query($sql3) as $row) {
            $id_proprietaire = $row["proprietaire_id"];
        }
        $id = $id_proprietaire;
    }

    $sql2 = "INSERT INTO `animaux` (`animaux_id`, `nom_propre`, `photo`, `proprietaire_id`, `nom_generique_id`) VALUES (NULL, '$nom', '$photo', '$id', '$nom_generique')";
    $sql_ok2 = mysqli_prepare($link, $sql2);
    mysqli_stmt_execute($sql_ok2);
    

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
 


<!-- about //
<div class="about">
  <a class="bg_links social portfolio" href="https://www.rafaelalucas.com" target="_blank">
     <span class="icon"></span>
  </a>
  <a class="bg_links social dribbble" href="https://dribbble.com/rafaelalucas" target="_blank">
     <span class="icon"></span>
  </a>
  <a class="bg_links social linkedin" href="https://www.linkedin.com/in/rafaelalucas/" target="_blank">
     <span class="icon"></span>
  </a>
  <a class="bg_links logo"></a>
</div>  -->
<!-- end about -->

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

   
<!-- about //
<div class="about">
  <a class="bg_links social portfolio" href="https://www.rafaelalucas.com" target="_blank">
     <span class="icon"></span>
  </a>
  <a class="bg_links social dribbble" href="https://dribbble.com/rafaelalucas" target="_blank">
     <span class="icon"></span>
  </a>
  <a class="bg_links social linkedin" href="https://www.linkedin.com/in/rafaelalucas/" target="_blank">
     <span class="icon"></span>
  </a>
  <a class="bg_links logo"></a>
</div>    -->
<!-- end about -->

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
<form action="" method="post">

            <div class="form-group"> <br>
    
            <label>Prénom</label>
            <input id="nom" type="text" name="nom" value="<?php echo $nom; ?>"> <br>
                
            <label>Nom générqiue</label>
        <select name="nom_g">
        <option value="">
            <?php while ($gen = mysqli_fetch_array($all_gen,MYSQLI_ASSOC)):;?>
                <option value="<?= $gen["nom_generique_id"];?>"><?= $gen["nom_"];?>
                </option>
            <?php endwhile;?>
        </select>
        <br>



            <label for="Propriétaire"> Propriétaire : </label> <br>
            
            <div>
                <label for="titre">Mr</label>
                <input type="checkbox" id="scales" name="titre" value="Mr">
                <label for="titre">Mme</label>
                <input type="checkbox" id="scales" name="titre" value="Mme">
            </div>
            <br>
    
            <label for="Nom"> Nom </label>
            <input type="text" id="Nom" name="nom_proprietaire"> <br>
    
        
            <label for="Prénom"> Prénom </label>
            <input type="text" id="Prenom" name="prenom_proprietaire">
            
    
            
            <br> <br>
    
            <label for="photo"> Photo </label>
            <input type="file" id="photo" name="photo"> <br> <br> 
            
            <input type="submit" id="ajout" value="Ajouter l'animal">
            </div>
        
    
        </form>
    </div>
        
</body>
</html>