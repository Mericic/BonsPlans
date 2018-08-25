var ticking = false;
var data = new Array();

function infiniteScroll() {
    if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 100) {
        getMapData();
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