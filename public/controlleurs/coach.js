$("input[type='checkbox'][name='Adding[]']").change(function(){
    var id = $(this).val();
    var type;
    if(this.checked){
        type = true;
    }else{type=false;}

    $.ajax({
        type: "POST",
        data: {
            id:id,
            type: type
        },
        url: "http://localhost/coach/projet",
        success: function(msg){
         $('#theAlert').html(msg);
        }
     });
     
});


$(".avenecement").click(function(){
    var id = $(this).val();
    $.ajax({
        type: "POST",
        data:{id:id},
        url:"http://localhost/coach/mesprojets",
        success:function(msg){
            $("#firstdata").after(msg);
        }
    });
});