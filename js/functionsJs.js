function submitObjectData(idForm,idResponse,object){
    jQuery.ajax({
        method:  $("#"+idForm).attr("method"),
        url:     $("#"+idForm).attr("action"),
        data:object,
        async:false,
        cache:false,
        success:function(response){
            $('#'+idResponse).fadeOut("slow", function(){
                $('#'+idResponse).fadeIn("slow").html(response);
            })
            
        }
    })
}
function sendValueForOption(id,idResponse){
    var valorOption = $('#'+id.id).val();
    jQuery.ajax({
        url:$('#'+id.id).attr("link"),
        cache:false,
        data:{"idUsuario":idResponse,"optionValue":valorOption},
        success:function(response)
            {
                $('#cebra'+idResponse).html(response);
            }
    })
};


