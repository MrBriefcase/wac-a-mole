document.getElementById('play_btn').addEventListener('click', function(){
    
    var xhttp = new XMLHttpRequest();
    
    // executed after request is done.
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // when doc is ready, perform code below
            
            document.getElementById('debug').innerHTML = 'Get Ready!';
            // redirect to game page.
            setTimeout(function(){
                window.location = '../HTML/game.html';
            }, 4000);
            // debug message.
            console.log(this.responseText);
        }
    }
    
    var player_nm = document.getElementById('player_nm').value;
    var nameInput = new FormData();
    nameInput.append('username', player_nm);
    
    xhttp.open('POST', '../PHP/POST_the_user.php', true);
    xhttp.send(nameInput);
    
});