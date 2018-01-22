// onload for leaderboard
function createBoard() {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // when doc is ready, perform code below
            
            var leaderboard = JSON.parse(this.response);
            console.log(leaderboard);
            // Display highscore.
            document.getElementById('tbl').innerHTML = leaderboard;
        }
    }
    
    // GET request to grab the high-score.
    xhttp.open('GET', '../PHP/GET_leaderboard.php', true);
    xhttp.send();
}