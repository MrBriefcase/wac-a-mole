<?php
    $methodType = $_SERVER['REQUEST_METHOD'];

    if ($methodType === 'GET') {
        
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
            
            // setup appropriate query here.
            $sql = "SELECT player_score FROM players;";
            $statement = $conn->prepare($sql);
            $statement->execute();
            // fetch and find highest score.
            $scores = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // grab player_names.
            $sql = "SELECT player_name FROM players;";
            $statement = $conn->prepare($sql);
            $statement->execute();
            // fetch them.
            $names = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            
            $highest = 0;
            foreach($scores as $i => $score) {
                if ($score > $highest) {
                    $highest = $score;
                    $player = $names[$i];
                }
            }
            
            $data = array('highscore' => $highest,
                         'player' => $player);
            echo json_encode($data, JSON_FORCE_OBJECT);
            
//            echo 'success! grabbed highscore!';
        } catch(PDOException $e) {
            $msg = $e->getMessage();
            echo "failed: $msg";
        }
    } else {
        echo 'failed: methodType NOT get';
    }
?>