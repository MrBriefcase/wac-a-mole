// var initialization
var btn = document.getElementById('btn');
var disp = document.getElementById('ct');
var count = 0;

// initial randomize
btn.style.left = Math.round(Math.random() * (window.innerWidth - 100)) + 'px';
btn.style.top = Math.round(Math.random() * (window.innerHeight - 100)) + 'px';

// randomize position every 0.7 sec
var scatterInterval = setInterval(function(){
    btn.src = './boy.gif';
    btn.style.left = Math.round(Math.random() * (window.innerWidth - 100)) + 'px';
    btn.style.top = Math.round(Math.random() * (window.innerHeight - 100)) + 'px';
}, 1200);

// btn event listener
btn.addEventListener('click', function(){
    btn.src = './girl.gif';
    count++;
    disp.innerHTML = count;
    
    setTimeout(function(){
        btn.src = './boy.gif';
    }, 200);
});

// debug
console.log('left is: ' + Math.round(Math.random() * 400) + 'px');
console.log(window.innerWidth);






// onload function
function initialSetup() {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // when doc is ready, perform code below
            
            var best_score = JSON.parse(this.response);
            console.log(best_score);
            // Display highscore.
            document.getElementById('high_score').innerHTML = best_score['player']['player_name'] + ' - ' + best_score['highscore']['player_score'];
        }
    }
    
    // GET request to grab the high-score.
    xhttp.open('GET', './GET_highscore.php', true);
    xhttp.send();
}





// END button
document.getElementById('end_game').addEventListener('click', function(){
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // run after php completes successfully
            console.log('updates score');
            
            setTimeout(function() {
                window.location = './last_page.html';
            }, 1000);
        }
    }
    
    var data = new FormData();
    data.append('score', count);
    
    xhttp.open('POST', './POST_end_game.php', true);
    xhttp.send(data);
});