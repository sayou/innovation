$(document).ready(function(){
    $("#addNewPerson").click(function(){
		var idGenerateur = Math.floor((Math.random()*999)+1);
        $("#addNewHere").append("<div class='row' id='"+idGenerateur+"'><div class='col-sm-5'><div class='form-group'><input type='text' name='membreNomPrenom[]' class='form-control' placeholder='nom & prénom'></div></div><div class='col-sm-5'><div class='form-group'><input type='date' name='membreDateNaissance[]' class='form-control' placeholder='Date de naissance'></div></div><div class='col-sm-5'><div class='form-group'><input type='text' name='membreEtablissement[]' class='form-control' placeholder='Etablissement'></div></div>   		<div class='col-sm-5'><div class='form-group'><input type='text' name='membreNiveauDeFormation[]' class='form-control' placeholder='Niveau de formation/études'></div></div><div class='col-sm-2'><div class='form-group'> <input type='button' onclick='deletePerson("+idGenerateur+")' class='btn btn-danger' value='Remove'/> </div></div><div class='col-sm-12'><hr/></div></div>");
    });
});



function deletePerson(id) {
	$("#"+id).remove();
}