$(document).ready(function() {
  getPcMembre(-1);
  getTache(-1);
  $(".linkMembre").click(function() {
    getPcMembre($(this).attr("id"));
  });
  $("select[name='lot']").change(function() {
    getTache($(this).val());
  });
});

function getPcMembre(id) {
  $.ajax({
    url: "../Controller/pcEquipe.php",
    type: "GET",
    data: "id=" + id,
    dataType: "html",
    error: function(request, error) {
      console.log("Erreur lors du chargement des données");
    },
    success: function(html) {
      $("#graphe").html(html);
    }
  });
}

function getTache(id) {
  $.ajax({
    url: "../Controller/get_tache.php",
    type: "GET",
    data: "id=" + id,
    dataType: "html",
    error: function(request, error) {
      console.log("Erreur : responseText: " + request.responseText);
    },
    success: function(html) {
      $("select[name='tache']").empty();
      $("select[name='tache']").append(html);
    }
  });
}
