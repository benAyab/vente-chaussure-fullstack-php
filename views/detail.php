<?php
    echo '<table class="table">';
        echo "<tr>";
            echo "<td>";
                echo '<figure class="image is-128x128">';
                echo '<img src="/public/images_chaussures/'.$article["img1"].'"></figure>';
                echo '<figure class="image is-128x128">';
                echo '<img src="/public/images_chaussures/'.$article["img2"].'"></figure>';
            echo "</td>";
            echo "<td>"; 
                echo "<strong>".$article['nom']. ": </strong>";
                echo "<strong>".$article['prix']."&#x20AC; </strong><br/>";
                echo "<strong>Disponible: </strong>" .$article['dispo']."<br/><br/>";
                echo "<strong> Caractéristiques: </strong><br/>";
                echo "<strong>Catégorie: </strong>" .$article['categorie']. "<br/>";
                echo "<strong>Marque: </strong>" .$article['marque']. "<br/>";
                echo "<strong>Pointure: </strong>" .$article['pointure']. "<br/>";
                echo "<strong>Couleur: </strong>" .$article['couleur']. "<br/>";
            echo "</td>";
            echo "<td>";
            echo "</td>";
        echo "</tr>";
        echo '<tr>  <td></td> <td></td> <td><a href="/public/commande.php" class="button is-primary"><strong>Commander</strong></a> </td></tr>';
        echo "<tr><td>";
        echo "<h4> Détails </h4>";
        echo $article['abstract']."<br/>";
        echo "</td></tr>";
    echo "</table>";