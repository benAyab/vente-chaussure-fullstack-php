<?php
	session_start();

    if(isset($_SESSION['log_in']) && ($_SESSION['log_in']==true)){
        echo "<h2> Commande validée </h2>";
        echo '<a href="/"> <h2> OK </h2></a>';
    }else{
        header("Location: /public/login.php");
    }
?>