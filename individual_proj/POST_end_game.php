<?php
    $methodType = $_SERVER['REQUEST_METHOD'];

    if ($methodType === 'POST') {

        
        // setup connection.
        $DBHost = 'localhost';
        $port = 3306;
        $dblogin = 'daren941_daren';
        $DBpassword = 'tryinToGetMyPass?GetOuttaHere!';
        $DBname = 'daren941_wac-users';
        
        $score = $_POST['score'];
        
        try {
            $conn = new PDO("mysql:host=$DBHost;port=$port;dbname=$DBname", $dblogin, $DBpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // -> is equivalent to .
            
            // select all.
            $sql = "SELECT * FROM players;";
            $statement = $conn->prepare($sql);
            $statement->execute();
            
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            $ct = sizeof($rows) - 1;
            // This is the last playername.
            $currPlayer = $rows[$ct]['player_name'];
            
            // update player row.
            $sql = "UPDATE players
                    SET player_score=$score
                    WHERE player_name='$currPlayer';";
            $statement = $conn->prepare($sql);
            $statement->execute();
                        
        } catch(PDOException $e) {
            $msg = $e->getMessage();
            echo "failed: $msg";
        }
        
    } else {
        echo 'fail: methodType NOT post.';
    }
?>