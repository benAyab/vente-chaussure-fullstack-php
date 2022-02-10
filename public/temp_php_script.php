$req = $bdd->prepare(’INSERT INTO jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires) VALUES(:nom, :possesseur, :console, :prix, , :nbre_joueurs_max, :commentaires)’); 
$req->execute(array( ’nom’ => $nom, ’possesseur’ => $possesseur, ’console’ => $console, ’prix’ => $prix, ’nbre_joueurs_max’ => $nbre_joueurs_max, ’commentaires’ => $commentaires ));




 if( password_verify($pwd, $foundUser["password"]) ){
                    ob_clean();
                    header_remove();
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(200);

                    $_SESSION["username"] = $foundUser["pseudo"];
                    $_SESSION["email"] = $foundUser["email"];
                    $_SESSION["log_in"] = true;

                    $resp = new class{};
                    $resp->hasError = false;
                    $resp->message = "Vous êtes connectés !";
                    header("Location: http://vente-chaussures/", true, 301);
                    echo json_encode($resp);
                    exit();
                }else{
                  //Is not registered
                    // remove any string that could create an invalid JSON, such as PHP Notice, Warning, logs...
                    ob_clean();
                    // this will clean up any previously added headers, to start clean
                    header_remove();
                    //Append Cotent-Type header
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(200);

                    $resp = new class{};
                    $resp->hasError = true;
                    $resp->message = "Mot de passe incorrect";
                    echo json_encode($resp);
                    exit();
                }
               