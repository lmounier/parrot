function centerObject(){
    
    var obj = $(".center");
    var windowHeight = $(window).innerHeight();
    var marginTopAbsolu = (windowHeight/2) - (obj.innerHeight()/2);
    var marginTop = marginTopAbsolu - obj.position().top;
    
    if(marginTop<50) marginTop = 50;
    
    obj.css({ "margin-top" : marginTop+"px" });
}

function switchObject(obj1,obj2){
    obj1.hide();
    obj2.show();
}

/***********************/
/*      LISTE AJAX     */
/***********************/
var URL = window.location.pathname.toLowerCase();

function getModule(id){
    $.ajax({
            url      : "get_cours.php",
            type     : "GET",
            data     : "id="+id+"&typeEnvoye=semestre&typeRecu=module",
            dataType : "json",
            error    : function(request, error) {
                console.log("Erreur : responseText: "+request.responseText);
            },
            success  : function(data){
                $("select[name='module']").empty();
                $(data).each(function(){
                    $("select[name='module']").append("<option value="+$(this)[0].idModule+">"+$(this)[0].nomModule);
                });
                getChapitre(data[0].idModule);
            }
    });     
}

function getChapitre(id){
    $.ajax({
            url      : "get_cours.php",
            type     : "GET",
            data     : "id="+id+"&typeEnvoye=module&typeRecu=chapitre",
            dataType : "json",
            error    : function(request, error) {
                console.log("Erreur : responseText: "+request.responseText);
            },
            success  : function(data){
                $("select[name='chapitre']").empty();
                $(data).each(function(){
                    $("select[name='chapitre']").append("<option value="+$(this)[0].idChapitre+">"+$(this)[0].nomChapitre);
                });
                if(URL=="/informathique/controller/entrainement.php") getExos(data[0].idChapitre);
                else if(URL=="/informathique/controller/cours.php") getCours(data[0].idChapitre);
            }
    }); 
}

function getCours(id){
    $.ajax({
            url      : "get_cours.php",
            type     : "GET",
            data     : "id="+id+"&typeEnvoye=chapitre&typeRecu=cours",
            dataType : "json",
            error    : function(request, error) {
                console.log("Erreur : responseText: "+request.responseText);
            },
            success  : function(data){
                $("#content_cours").empty();
                $(data).each(function(){
                    $("#content_cours").append("<iframe src='../"+$(this)[0].nomCours+"'></iframe>");
                });
            }
    }); 
}

function getExos(id){
    $.ajax({
            url      : "get_cours.php",
            type     : "GET",
            data     : "id="+id+"&typeEnvoye=chapitre&typeRecu=exercice",
            dataType : "json",
            error    : function(request, error) {
                console.log("Erreur : responseText: "+request.responseText);
            },
            success  : function(data){
                var noExo = 1;
                $("#content_exos").empty();
                $(data).each(function(){
                    $("#content_exos").append("<li><a href='exercice.php?id="+$(this)[0].idExo+"'> Exercice n°"+noExo+" : "+$(this)[0].nomExo+"</a></li>");
                    noExo++;
                });
            }
    }); 
}

function getChapitre2(id){
    $.ajax({
            url      : "get_cours.php",
            type     : "GET",
            data     : "id="+id+"&typeEnvoye=module&typeRecu=chapitre",
            dataType : "json",
            error    : function(request, error) {
                console.log("Erreur : responseText: "+request.responseText);
            },
            success  : function(data){
                 var noChap = 1;
                $("#content_chapitre").empty();
                $(data).each(function(){
                    $("#content_chapitre").append("<INPUT type='checkbox' name='chapitre[]' value="+$(this)[0].idChapitre+"> Chapitre n°"+noChap+" : "+$(this)[0].nomChapitre);
                    noChap++;
                });
            }
    }); 
}

