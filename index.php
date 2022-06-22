<?php

require "db/connexion.php";
//création d'objet connexion
try {
  $connexion = new Connexion();
} catch (PDOException $ex) {
  echo $ex->getMessage(); //débogage
  exit;
}
//récupérer les animaux
$pdoStatement = $connexion->prepare("SELECT a.*, P.nom, P.prénom, n_g.nom_ FROM `animaux` a INNER JOIN propriétaire P ON a.proprietaire_id = P.proprietaire_id INNER JOIN nom_générique n_g ON a.nom_generique_id = n_g.nom_generique_id");
$pdoStatement->setFetchMode(PDO::FETCH_ASSOC); //tableau associatif
$pdoStatement->execute();
$animaux = $pdoStatement->fetchAll();

$titrePage = "Liste des animaux";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="style2.css" rel="stylesheet" type="text/css">
    <title>Les animaux Domestiques</title>
</head>
<body>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
<h1>Liste des animaux</h1>
<table class="table">
  <thead>
    <tr>
      <th>Photo</th>
      <th>nom</th>
      <th>nom générique</th>
      <th>nom du propriétaire</th>
      <th>prénom du propriétaire</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($animaux as $animal) : ?>
      <tr>
        <td><img src="<?php echo $animal["photo"]; ?>" alt="<?php echo $animal["nom_propre"]; ?>" width="100"></td>
        <td><?php echo $animal["nom_propre"]; ?></td>
        <td><?php echo $animal["nom_"]; ?></td>
        <td><?php echo $animal["nom"]; ?></td>
        <td><?php echo $animal["prénom"]; ?></td>
        <td>
          <!-- <a class="btn btn-primary" href="fiche_animal.php?id=<?php echo $sta['id']; ?>">Afficher</a> -->
          <!-- <a class="btn btn-warning" href="form_modif.php?id=<?php echo $sta['id']; ?>">Modifier</a> -->
            <button class="btn btn-danger suppBtn" data-id="<?php echo $animal['animaux_id']; ?>">Supprimer</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script>
    // on recupere tous les boutons
  let btnElements = document.querySelectorAll(".suppBtn");
  console.log(btnElements);
  for (let i = 0; i < btnElements.length; i++) {
    let btn = btnElements[i];
    // on ecoute si qqn clique sur le bouton
    btn.addEventListener("click", function(event) {
      //demander la confirmation à faire !!!
      // on recupere le bouton qui vient d etre cliqué
      let suppBtn = event.target;
      console.log(suppBtn);
        //  on recupere l identifiant de l'animal à supprimer
      let id = suppBtn.dataset.id;
      console.log(id);
        // envoyer une requete ajax
      var xhr = new XMLHttpRequest();
      xhr.open("POST", 'supp_traitement.php', true);

      //Envoie les informations du header adaptées avec la requête
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        // ecouteur d'evenement pour ecouter l'état d'objet xhr
      xhr.onreadystatechange = function() { //Appelle une fonction au changement d'état.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          let reponse = xhr.responseText;
          console.log(reponse);
          if (reponse == "OK") {
            window.location.reload();
          } else {
            alert("opération échouée !");
          }
          //à faire : supprimer la ligne : tr
        }
      }
      xhr.send("id=" + id);
    });
  }
</script>
<?php
// include "includes/footer.php"
?>
