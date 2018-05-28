$(document).ready(function() {
  getPcMembre(-1);
  $(".linkMembre").click(function() {
    getPcMembre($(this).attr("id"));
    console.log($(this).attr("id"));
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
