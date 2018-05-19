

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