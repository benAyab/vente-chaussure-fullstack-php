<?php
    session_start();

    $values = array($_POST["user_name"], $_POST["user_email"], $_POST["user_password"]);

    if( allSet($values) && isNotVoid($values) ){

        //Data base credentials
        $db_servername = "localhost";
        $db_username = "root";
        $db_password = "";

        //Incoming user data
        $nom = $_POST["user_name"];
        $email = $_POST["user_email"];
        $pwd = $_POST["user_password"];

        try{
                $conn = new PDO("mysql:host=$db_servername;port=3307;dbname=testdb", $db_username, $db_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //On va chercher dans la db s'il n ya compte avec ce mail 
                // 
                $sql1 = "SELECT COUNT(*) AS totalUser FROM clients WHERE email = ?";
                $req = $conn->prepare($sql1);
                $req->execute( array($email) ) || die(print_r($conn->errorInfo()));
          
                //Dans tous les cas, nous avons un resultat
              if( ($foundUser = $req->fetch(PDO::FETCH_ASSOC)) !== false){
                  // The user already exists
                  if( ((int)$foundUser["totalUser"]) > 0){
                        ob_clean();
                        header_remove();
                        header('Content-Type: application/json; charset=utf-8');
                        http_response_code(200);

                        $resp = new class{};
                        $resp->hasError = true;
                        $resp->message = "Cet email est déjà présent";

                        echo json_encode($resp);
                        exit();
                    }else{
                      //Is not registered

                      //On hashe le password et on sauvegarde le haché
                        $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT);

                        $sql2 = "INSERT INTO clients(email, password, pseudo) VALUES(?, ?, ?)";
                        $req = $conn->prepare($sql2);
                        $req->execute([$email, $hashed_pwd, $nom]) || die(print_r($conn->errorInfo()));

                        $_SESSION["username"] = $nom;
                        $_SESSION["email"] = $email;
                        $_SESSION["log_in"] = true;

                        // remove any string that could create an invalid JSON 
                        // such as PHP Notice, Warning, logs...
                        ob_clean();
                        // this will clean up any previously added headers, to start clean
                        header_remove();
                        //Append Cotent-Type header
                        header('Content-Type: application/json; charset=utf-8');
                        http_response_code(200);

                        $resp = new class{};
                        $resp->hasError = false;
                        $resp->message = "Compte créé avec succès !";
                        header("Location: http://vente-chaussures/");
                        echo json_encode($resp);
                        exit();
                    }
                   
                }else{
                    //En cas d'erreur interne
                    ob_clean();
                    header_remove();
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(500);

                    $resp = new class{};
                    $resp->hasError = true;
                    $resp->message = "Une erreur interne est survenue, reéssayez plus tard";
                    
                    echo json_encode($resp);
                    exit();
                }
                $req->closeCursor();
            }catch(Exception $e){
                //En cas d'erreur interne
                ob_clean();
                header_remove();
                header('Content-Type: application/json; charset=utf-8');

                $resp = new class{};
                $resp->hasError = true;
                $resp->message = "Une erreur interne est survenue, reéssayez plus tard. ";
                http_response_code(500);
                echo json_encode($resp);
                exit();
            }
    }else{
        //En cas d'erreur interne
        ob_clean();
        header_remove();
        header('Content-Type: application/json; charset=utf-8');

        $resp = new class{};
        $resp->hasError = true;
        $resp->message = "Les données envoyées ne sont pas valides";
        http_response_code(200);
        echo json_encode($resp);
        exit();
    }




    //Fonction pour vérifier l'existence de valeur et paramètres
    function allSet($array = array()){
        foreach($array as $ar){
            if(! isset($ar)){
                return false;
            }
        }
        return true;
    }

   function isNotVoid($array = array()){
        foreach($array as $ar){
            if( $ar === ""){
                return false;
            }
        }
        return true;
    }
?>