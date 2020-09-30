$(function(){
  
    $('form[name="login"]').submit(function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"/user/signin",
            data:$(this).serialize(),
            dataType:"JSON",
            beforeSend:function(){
              $('.error').hide(300);
            },
            success:function(data){
                
                if(data.rs===1){
                  window.location.href = "/admin";
                }else{
                  $('#inputPassword').val('').focus();
                  $('.error').show(300);
                  $('.error').text(data.sms);
                }
            },error:function(){
                alert('Error')  
            }
        });

    })
})