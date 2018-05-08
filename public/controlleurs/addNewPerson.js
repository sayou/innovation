$(document).ready(function(){
    $("#addNewPerson").click(function(){
        $("#addNewHere").append("<div class='col-sm-5'><div class='form-group'><input type='text' name='firstname' class='required form-control' placeholder='prénom'></div></div>");
   		$("#addNewHere").append("<div class='col-sm-5'><div class='form-group'><input type='text' name='lastname' class='required form-control' placeholder='nom'></div></div>");
   		$("#addNewHere").append("<div class='col-sm-2'><div class='form-group'> <input type='button' class='btn btn-danger' value='Remove'/> </div></div>");
    });
});


//	zone.append("<div class='col-sm-5'><div class='form-group'><input type='text' name='firstname' class='required form-control' placeholder='prénom'></div></div>");









