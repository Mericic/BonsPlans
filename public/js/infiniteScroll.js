var ticking = false;
var data = new Array();

document.getElementById('chercher').addEventListener('click', function(data) {
    var adresse = document.getElementById('adresse').value;
    var select = document.getElementById('categorie');
    var categories = select.options[select.selectedIndex].value;
    select = document.getElementById('range');
    var range = select.options[select.selectedIndex].value;
    data = [ adresse, categories, range ];
    console.log(data.toString());
    return (data);
});

function infiniteScroll() {
    if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 100) {
        /*array = { lastId : (document.getElementById('container').lastElementChild.id),  };
        $.ajax({
            type: 'POST',
            url: "infinite.php", 
            data: lastId, 
            datatype: 'text',
            success: function(result){
                var array = JSON.parse(result);
                var i = -1;
                while (array[++i]) {
                    let img = document.createElement('img');
                    img.src = 'http://localhost/infinitetest' + array[i]['imgpath'];
                    img.id = array[i]['id'];
                    document.getElementById('container').appendChild(img);
                }
            }
        });*/
        let list = document.getElementById('list');
        var i = 0;
        while (i++ < 15) {
            let newDiv = document.createElement('div');
            newDiv.className = 'newDiv';
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