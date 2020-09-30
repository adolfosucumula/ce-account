

$(function(){
    
    //Get provinces by country`s ID
    $('input[name="searchStudent"]').keyup(function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"/student/searchBy",
            data:{id:$(this).val()},
            dataType:"JSON",
            beforeSend:function(){
                
            },
            success:function(data){
                var html ="<option value=''>Selecionar...</option>";
                
                if(data.person.length>0){
                   
                    $('input[name="studentName"]').val(data.person[0].firstname + ' '+ data.person[0].lastname);
                }else{
                    $('input[name="studentName"]').val('');
                }
               
                if(data.student.id_student>0){
                    $('input[name="idS"]').val(data.student.id_student);
                }else{
                    $('input[name="idS"]').val('');
                }
                
            },error:function(){
                alert('Error')  
            }
        });

    })
  
})