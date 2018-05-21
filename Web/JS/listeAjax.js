$(document).ready(function(){
    
    var currentURL = window.location.pathname.toLowerCase();
    
    var listeURL = {
        "cours" : "/informathique/controller/cours.php", 
        "entrainement" : "/informathique/controller/entrainement.php", 
        "evaluation" : "/informathique/controller/evaluation.php"
    };
    
    if(currentURL===listeURL["cours"] || currentURL===listeURL["entrainement"] || currentURL===listeURL["evaluation"]) getModule($("#form_listeAjax select[name='semestre']").val());
    
    $("#form_listeAjax select[name='semestre']").change(function(){
        getModule($(this).val());
    });
    
    $("#form_listeAjax select[name='module']").change(function(){
        if(currentURL===listeURL["evaluation"]) getChapitre2($(this).val());
        else getChapitre($(this).val());   
    });
    
    $("#form_listeAjax select[name='chapitre']").change(function(){
        if(currentURL===listeURL["cours"]) {
            getCours($(this).val());
        }
        else if(currentURL===listeURL["entrainement"]) getExos($(this).val());
    });
});