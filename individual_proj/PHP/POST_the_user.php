<?php
    $methodType = $_SERVER['REQUEST_METHOD'];

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($methodType === 'POST') {
        
        $userName = $_POST['username'];
        
        // save the name in session.
        $_SESSION['player_name'] = $userName;
        
        // setup connection.
        $DBHost = 'localhost';
        $port = 3306;
        $dblogin = 'daren941_daren';
        $DBpassword = 'secret';
        $DBname = 'daren941_wac-users';
        
        try {
            $conn = new PDO("mysql:host=$DBHost;port=$port;dbname=$DBname", $dblogin, $DBpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // -> is equivalent to .
            
            // update db here ******************.
            $sql = "INSERT INTO players (player_name, player_score) VALUES ('$userName', 0);";
            $statement = $conn->prepare($sql);
            $statement->execute();
            
            echo 'success! added name!';
        } catch(PDOException $e) {
            $msg = $e->getMessage();
            echo "failed: $msg";
        }
        
    } else {
        echo 'fail: methodType NOT post.';
    }
?>