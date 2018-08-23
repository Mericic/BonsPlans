var ticking = false;
var data = new Array();

function infiniteScroll() {
    if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 100) {
        let list = document.getElementById('row');
        var i = 0;
        while (i++ < 15) {
            let newDiv = document.createElement('div');
            newDiv.className = 'col-11 col-md-7 newDiv';
            newDiv.id = 'content' + i;
            list.appendChild(newDiv);
        }
    }	    
}


/* La variable ticking et la methode requestAnimationFrame permettent d'empecher
    que le script soit appele 10 fois par mouvement de molette */
    
window.addEventListener('scroll', function(e) {
    if (!ticking) {
        window.requestAnimationFrame(function() {
            infiniteScroll();
            ticking = false;
        });
    }
    ticking = true;
});