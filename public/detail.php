<?php 
    session_start();
    include_once('../views/header.php');
?>
<body>
    <section class="section">
        <div class="content is-large">
            <?php
            if(isset($_GET['id']) && ((int)$_GET['id']) >= 1){
                $servername = "localhost";
                $username = "root";
                $password = "";
                try{
                  $conn = new PDO("mysql:host=$servername;port=3307;dbname=testdb", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
                    $req = $conn->prepare('SELECT * FROM articles WHERE id = ?');
                    $req->execute(array($_GET['id'])) || die(print_r($conn->errorInfo()));
                
                    if( ($article = $req->fetch(PDO::FETCH_ASSOC)) !== false){
                        include_once('../views/detail.php');
                    }
                      $req->closeCursor();
                      $conn = null;
                  }catch(Exception $e){
                    die(print_r('Erreur : '.$e->getMessage()));
                  }
            }else{
                echo "<h2> Oups une erreur s'est produite </h2>";
            }
            ?>
        </div>
    </section>
</body>
</html>