$(function(){
    
    //Get provinces by country`s ID
    $('select[name="country"]').change(function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"/country/showprovinces",
            data:{id:$(this).val()},
            dataType:"JSON",
            beforeSend:function(){
                
            },
            success:function(data){
                var html ="<option value=''>Selecionar...</option>";
                
                if(data.data.length>0){
                    for(var a=0;a<data.data.length;a++){
                        html +='<option value="'+data.data[a].id_province+'">'+data.data[a].province+'</option>'; 
                    }
                }
                $('#province').html(html);
            },error:function(){
                alert('Error')  
            }
        });

    })
    //Get cities by province`s ID
    $('select[name="province"]').change(function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"/province/showcities",
            data:{id:$(this).val()},
            dataType:"JSON",
            beforeSend:function(){
                
            },
            success:function(data){
                var html ="<option value=''>Selecionar...</option>";
                
                if(data.data.length>0){
                    for(var a=0;a<data.data.length;a++){
                        html +='<option value="'+data.data[a].id_city+'">'+data.data[a].city+'</option>'; 
                    }
                }
                $('#city').html(html);
            },error:function(){
                alert('Error')  
            }
        });

    })
})