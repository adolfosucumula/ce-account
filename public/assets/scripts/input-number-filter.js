
$(function(){

    $('input[name="tele"]').change(function(e){
        e.preventDefault();
        if($(this).val() < 0){
            $(this).val(0)
        }
    })
    $('input[name="tele"]').keyup(function(e){
        e.preventDefault();
        if($(this).val() < 0){
            $(this).val(0)
        }
    })
    $('input[name="cell"]').change(function(e){
        e.preventDefault();
        if($(this).val() < 0){
            $(this).val(0)
        }
    })
    $('input[name="cell"]').keyup(function(e){
        e.preventDefault();
        if($(this).val() < 0){
            $(this).val(0)
        }
    })
    

})