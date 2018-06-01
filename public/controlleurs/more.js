

function verify(id){
    var attr = $("#textShow"+id).css("display");
    if(attr == "none"){
        $("#icon"+id).removeClass("icofont icofont-hand-drawn-down").addClass('icofont icofont-hand-drawn-up');
        $("#textShow"+id).show(1000);
    }else{
        $("#icon"+id).removeClass("icofont icofont-hand-drawn-up").addClass('icofont icofont-hand-drawn-down');
        $("#textShow"+id).hide(1000);
    }
}


function verifySelected(id){
    var attr = $("#textShowID"+id).css("display");
    if(attr == "none"){
        $("#iconSelected"+id).removeClass("icofont icofont-hand-drawn-down").addClass('icofont icofont-hand-drawn-up');
        $("#textShowID"+id).show(1000);
    }else{
        $("#iconSelected"+id).removeClass("icofont icofont-hand-drawn-up").addClass('icofont icofont-hand-drawn-down');
        $("#textShowID"+id).hide(1000);
    }
}

function details(id){
    //alert(id);

    $.ajax({
        type: "POST",
        data: {
            id:id
        },
        url: "https://aracpi.com/innovation/admin/coachJury",
        success: function(msg){
         $('#theInfo').html(msg);
        }
     });
}