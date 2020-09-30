


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
                
                if(data.person !==''){
                   
                    $('input[name="studentName"]').val(data.person.firstname 
                        + ' '+ data.person.lastname);
                }else{
                    $('input[name="studentName"]').val('');
                }
               
                if(data.student.length>0){
                    $('input[name="idS"]').val(data.student[0].id_student);
                }else{
                    $('input[name="idS"]').val('');
                }
                
            },error:function(){
                console.log()  
            }
        });

    })

    //Get provinces by country`s ID
    $('form[name="search"]').submit(function(e){
        e.preventDefault();

        var data = $('input[name="searchStudent"]').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"/student/getStudentByNif",
            data:{id:data},
            dataType:"JSON",
            beforeSend:function(){
                
            },
            success:function(data){
                var html ="<option value=''>Selecionar...</option>";
                
                if(data.person.length >0){
                   
                    $('input[name="studentName"]').val(data.person[0].firstname 
                        + ' '+ data.person[0].lastname);
                }else{
                    $('input[name="studentName"]').val('');
                }
               
                if(data.student !==''){
                    $('input[name="idS"]').val(data.student.id_student);
                }else{
                    $('input[name="idS"]').val('');
                }
                
            },error:function(){
                console.log(); 
            }
        });

    })
  
})