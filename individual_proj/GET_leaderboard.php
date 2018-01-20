<?php
    $methodType = $_SERVER['REQUEST_METHOD'];

    if ($methodType === 'GET') {
        
        // setup connection.
        $DBHost = 'localhost';
        $port = 3306;
        $dblogin = 'daren941_daren';
        $DBpassword = 'tryinToGetMyPass?GetOuttaHere!';
        $DBname = 'daren941_wac-users';
        
        try {
            $conn = new PDO("mysql:host=$DBHost;port=$port;dbname=$DBname", $dblogin, $DBpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // -> is equivalent to .
            
            // setup appropriate query here.
            $sql = "SELECT *
                    FROM players
                    ORDER BY player_score DESC;";
            $statement = $conn->prepare($sql);
            $statement->execute();
            // fetch and find highest score.
            $scores = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            $myTable = "<tr>
                            <th>PLAYER</th>
                            <th>SCORE</th>
                        </tr>
                        ";
            
            foreach($scores as $row) {
                $myTable = $myTable . "<tr>";
                foreach($row as $data) {
                    $myTable = $myTable . "<td>$data</td>";
                }
                $myTable = $myTable . "</tr>";
            }
            
            echo json_encode($myTable, JSON_FORCE_OBJECT);
            
//            echo 'success! grabbed highscore!';
        } catch(PDOException $e) {
            $msg = $e->getMessage();
            echo "failed: $msg";
        }
    } else {
        echo 'failed: methodType NOT get';
    }
?>