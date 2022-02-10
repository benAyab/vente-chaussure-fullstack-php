<?php 
    session_start();
    include_once('views/header.php');
?>
  <body>
    <header class="header is-infos">
      <h1 class="title">Bienvenue sur vente-chaussures-hommes</h1>
      <nav class="navbar has-fixed-top is-light" role="navigation" aria-label="main navigation">
        <div class="navbar-menu">
          <div class="navbar-start">
            <a class="navbar-item">Home</a>
            <a class="navbar-item">Mocassins</a>
            <a class="navbar-item">Richelieu</a>

            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link"> <i class="feather feather-plus"></i>Plus de choix</a>
              <div class="navbar-dropdown">
                <a class="navbar-item">Choix 1</a>
                <a class="navbar-item">Choix 2</a>
                <a class="navbar-item">Choix 3</a>
              </div>
            </div>

            <div class="navbar-item level">
              <div class="level-left">
                <div class="level-item">

                <div class="field has-addons">
                  <p class="control">
                    <input class="input" type="text" placeholder="Chercher ">
                  </p>
                  <p class="control">
                    <button class="button">
                      <i class="feather feather-search"></i>
                    </button>
                  </p>
                </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <?php if(isset($_SESSION['log_in']) && ($_SESSION['log_in']==true)): ?>
                <a href="/public/users/logout.php" class="button is-primary"><strong>Déconnexion</strong></a>
                <a class="button is-light">Profile</a>
              <?php else: ?>
                <a href="/public/inscription.php" class="button is-primary"><strong>S'inscrire</strong></a>
                <a href="/public/login.php" class="button is-light">Se connecter</a>
              <?php endif ?>
            </div>
          </div>
        </div>
      </nav>
    </header>
  <section class="section">
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <td>N° article</td>
            <td>Nom</td>
            <td>Catégorie</td>
            <td>Marque</td>
            <td>Photos</td>
            <td>Prix/dispo</td>
            <td> <i class="feather feather-plus"></i> de détails</td>
          </tr>
        </thead>
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          try{
            $conn = new PDO("mysql:host=$servername;port=3307;dbname=testdb", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $reponse = $conn->query('SELECT * FROM articles') or die(print_r($reponse->errorInfo()));
              
              while ($donnees = $reponse->fetch()){
                echo "<tr>";
                echo "<td>" .$donnees['id']. "</td>";
                echo "<td>" .$donnees['nom']. "</td>";
                echo "<td>" .$donnees['categorie']. "</td>";
                echo "<td>" .$donnees['marque']. "</td>";
                echo "<td>";
                echo '<figure class="image is-64x64">';
                echo '<img src="/public/images_chaussures/'.$donnees["img1"].'"></figure>';
                echo '<figure class="image is-64x64">';
                echo '<img src="/public/images_chaussures/'.$donnees["img2"].'"></figure>';
                echo "</td>";
                echo "<td>" .$donnees['prix']."&#x20AC;<br/>".$donnees['dispo']."</td>";
                echo "<td><a href='/public/detail.php/?id=" .$donnees['id']. "'> Voir l'article</a> </td>";
                echo "</tr>";
              }
              $reponse->closeCursor();
              $conn = null;
          }catch(Exception $e){
            die('Erreur : '.$e->getMessage());
          }
        ?>
      </table>  
    </div>
  </section>
  <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>&copy; <?= date('Y') ?> Vente-chaussures</strong>
    </p>
  </div>
</footer>
  </body>
</html>
