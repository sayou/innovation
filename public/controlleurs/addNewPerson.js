$(document).ready(function(){
    $("#addNewPerson").click(function(){
		var idGenerateur = Math.floor((Math.random()*999)+1);
        $("#addNewHere").append("<div class='row' id='"+idGenerateur+"'><div class='col-sm-5'><div class='form-group'><input type='text' name='membreNomPrenom[]' class='form-control' placeholder='nom & prénom'></div></div><div class='col-sm-5'><div class='form-group'><input type='date' name='membreDateNaissance[]' class='form-control' placeholder='Date de naissance'></div></div><div class='col-sm-5'><div class='form-group'><input type='text' name='membreEtablissement[]' class='form-control' placeholder='Etablissement'></div></div>   		<div class='col-sm-5'><div class='form-group'><input type='text' name='membreNiveauDeFormation[]' class='form-control' placeholder='Niveau de formation/études'></div></div><div class='col-sm-2'><div class='form-group'> <input type='button' onclick='deletePerson("+idGenerateur+")' class='btn btn-danger' value='Remove'/> </div></div><div class='col-sm-12'><hr/></div></div>");
    });


});



function deletePerson(id) {
	$("#"+id).remove();
}

jQuery.validator.addMethod("verifyEmail", function(value, element) {

  var email = $("#verifyEmail").val();
  $.ajax({
    type: "POST",
    data: {email:email},
    url: "http://localhost/verifyEmail",
    success: function(msg){
      response = (msg == 'no') ? false : true;
    }
  });
  return response;

}, "Email déjà existe");

$( "#inscriptionForm" ).validate({
  rules: {
    monIdee: {
      required: true,
      maxlength: 250
    },
	descriptionProbleme: {
      required: true
    },
    descriptionSolution: {
      required: true
    },
    cible: {
      required: true
    },
    moyensTechniqueEtFinancier: {
      required: true
    },
    changement: {
      required: true
    },
    valeurSociale: {
      required: true
    },
    valeurEconomique: {
      required: true
    },
    ressourcesHumaines: {
      required: true
    },
    activites: {
      required: true
    },
    leadNomPrenom: {
      required: true,
      maxlength: 50
    },
    leadAdresseMail:{
      verifyEmail : true
      },
    leadTel: {
      required: true,
      maxlength: 10,
      digits: true
    },
    leadEtablissement: {
      required: true,
      maxlength: 100
    },
    leadNiveauDeFormation: {
      required: true,
      maxlength: 250
    },
    leadExperienceProfessionelles: {
      required: true
    },
    leadMotivation: {
      required: true
    },
    'membreNomPrenom[]': {
      required: true,
      maxlength: 50
    },
    'membreEtablissement[]': {
      required: true,
      maxlength: 100
    },
    'membreNiveauDeFormation[]': {
      required: true,
      maxlength: 100
    },
    motDePasse: {
      required: true,
      maxlength: 20
    },
    motDePasseDeux: {
      required: true,
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



