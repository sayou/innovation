$(document).ready(function(){
    $("#addNewPerson").click(function(){
		var idGenerateur = Math.floor((Math.random()*999)+1);
        $("#addNewHere").append("<div class='row' id='"+idGenerateur+"'><div class='col-sm-5'><div class='form-group'><input type='text' name='membreNomPrenom[]' class='form-control' placeholder='nom & prénom'></div></div><div class='col-sm-5'><div class='form-group'><input type='date' name='membreDateNaissance[]' class='form-control' placeholder='Date de naissance'></div></div><div class='col-sm-5'><div class='form-group'><input type='text' name='membreEtablissement[]' class='form-control' placeholder='Etablissement'></div></div>   		<div class='col-sm-5'><div class='form-group'><input type='text' name='membreNiveauDeFormation[]' class='form-control' placeholder='Niveau de formation/études'></div></div><div class='col-sm-2'><div class='form-group'> <input type='button' onclick='deletePerson("+idGenerateur+")' class='btn btn-danger' value='Remove'/> </div></div><div class='col-sm-12'><hr/></div></div>");
    });
});



function deletePerson(id) {
	$("#"+id).remove();
}



$( "#inscriptionForm" ).validate({
  rules: {
    monIdee: {
      required: true,
      minlength:6,
      maxlength: 250
    },
	descriptionProbleme: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    descriptionSolution: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    cible: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    moyensTechniqueEtFinancier: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    changement: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    valeurSociale: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    valeurEconomique: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    ressourcesHumaines: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    activites: {
      required: true,
      minlength:10,
      maxlength: 250
    },
    leadNomPrenom: {
      required: true,
      minlength:6,
      maxlength: 50
    },
    leadTel: {
      required: true,
      minlength:10,
      maxlength: 10,
      digits: true
    },
    leadEtablissement: {
      required: true,
      minlength:6,
      maxlength: 100
    },
    leadNiveauDeFormation: {
      required: true,
      minlength:6,
      maxlength: 100
    },
    leadExperienceProfessionelles: {
      required: true,
      minlength:6,
      maxlength: 100
    },
    leadMotivation: {
      required: true,
      minlength:6,
      maxlength: 100
    },
    'membreNomPrenom[]': {
      required: true,
      minlength:6,
      maxlength: 50
    },
    'membreEtablissement[]': {
      required: true,
      minlength:6,
      maxlength: 100
    },
    'membreNiveauDeFormation[]': {
      required: true,
      minlength:6,
      maxlength: 100
    },
    motDePasse: {
      required: true,
      minlength:8,
      maxlength: 20
    },
    motDePasseDeux: {
      required: true,
      minlength:8,
      maxlength: 20,
      equalTo:"#motDePasse"
    },
    leadDateNaissance: {
      required: true,
      date : true,
      maxDate : true
    },
    'membreDateNaissance[]': {
      required: true,
      date : true,
      maxDate : true
    }
  }
});



$.validator.addMethod("maxDate", function(value, element){
	var curYear = (new Date()).getFullYear();
	var min = curYear - 50;
	var max = curYear - 16;
	var inputDate = new Date(value);

	if(inputDate.getFullYear() > min && inputDate.getFullYear() < max )
		return true;
	return false;
}, "Merci de saisir une date valide !");



