<?php
    session_start();

    $values = array($_POST["user_email"], $_POST["user_password"]);

    if( allSet($values) && isNotVoid($values) ){
        //Data base credentials
        $db_servername = "localhost";
        $db_username = "root";
        $db_password = "";

        //Incoming user data
        $email = $_POST["user_email"];
        $pwd = $_POST["user_password"];

        try{
            $conn = new PDO("mysql:host=$db_servername;port=3307;dbname=testdb", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //On va chercher dans la db s'il n ya compte avec ce mail 
            // 
            $sql1 = "SELECT * FROM clients WHERE email = ?";
            $req = $conn->prepare($sql1);
            $req->execute(array($email)) || die(print_r($conn->errorInfo()));
      
            //Dans tous les cas, nous avons un resultat
          if( ($foundUser = $req->fetch(PDO::FETCH_ASSOC)) ){
              // The user already exists
              if( password_verify($pwd, $foundUser["password"]) ){
                    ob_clean();
                    header_remove();
                   

                    $_SESSION["username"] = $foundUser["pseudo"];
                    $_SESSION["email"] = $foundUser["email"];
                    $_SESSION["log_in"] = true;

                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(200);
                    $resp = new class{};
                    $resp->hasError = false;
                    $resp->message = "Vous êtes connectés !";
                    
                    //header("Location: http://vente-chaussures/");
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
               
            }else{
                //En cas d'erreur interne
                ob_clean();
                header_remove();
                header('Content-Type: application/json; charset=utf-8');
                http_response_code(200);

                $resp = new class{};
                $resp->hasError = true;
                $resp->message = "Compte introuvable";
                
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
            $resp->message = "Une erreur interne est survenue, reéssayez plus tard. Détail: ".$e->getMessage();
            http_response_code(500);
            echo json_encode($resp);
            exit();
        }

    }else{
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