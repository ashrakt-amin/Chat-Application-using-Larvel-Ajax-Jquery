<!DOCTYPE html>
<html lang="en">
<head>
  <title>chat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="text-center">
 
  <h1>{{Auth::user()->name}}</h1>

 
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
        <div id="chat" style="border:solid 1px black ; height:200px ;max-height:200px;overflow-y:scroll" >
        
        </div>
        <div class="form-group">
         
          <input  value="{{Auth::user()->id}}" id="user" name="user_id" type="hidden" >
          <textarea id="message" name="text" class="form-control" placeholder="enter your message"></textarea> 
          <button id="send" class="btn btn-primary" type="button">send</button>  
       </div>
      </div>
      <div class="col-md-4"> 
        @foreach($users as $user)
        <div class="alert alert-danger">
          <li style="list-style:none"><label>
         <input  value="{{$user->id}}" onchange="setUser(this)" type="radio" name="user" >{{$user->name}}
          </label></li>
        </div>
        @endforeach
      </div>

  </div>
 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var to_user =0 ;
    $("#send").on('click',function(){
        let message = $("#message").val();
        let user = $("#user").val();

        // console.log (user);
      
        if(message.length < 2 || to_user == 0){
            alert("message must be more than 2");
            return ;
        }

        $.ajax({
            url:"{{url('message/add')}}",
            type:'post',
            data: {
                 "_token": "{{ csrf_token() }}",
                 user_id:user,to_user:to_user,message:message,
                 },
            dataType:'json',
            success:function(data){
              $("#message").html("");
                console.log(data);
                if(data.status == true){
                    $("#chat")
                  .append("<div class='alert alert-success'>"+data.data.message+"</div>");
                  $("#message").val("");
                }else{
                    alert("error when send your message");
                }
                  
            }

        });
    })
    function setUser(e){
      to_user =e.value ;
      readChat();

    }
    setInterval(function(){
      readChat();
    },3000);

    function readChat(){
      // console.log("{{Auth()->user()->api_token}}");
      $.ajax({
            url:"{{url('messages/user')}}/"+to_user,
            type:'get',
            dataType:'json',
           
            success:function(data){
              $("#chat").html("");

                if(data.status == true){
                  data.data.forEach(function(message){
                    if(message.user_id.id == "{{Auth()->user()->id}}" ){
                    $("#chat").append("<div class='d-flex flex-row bd-highlight mb-3'><div class='p-2 bd-highlight bg-primary text-white' style='width:300px'>"+message.user_id.name +" : "+message.message+"</div></div>");
                    }else {
                     
                    $("#chat").append("<div class='d-flex flex-row-reverse bd-highlight mb-3'><div class='p-2 bd-highlight bg-dark text-white' style='width:300px'>"+message.user_id.name +" : "+message.message+"</div></div>");
                    }
                  
                  })
                 

                }else{
                    alert("error when send your message");
                }
                  
            }

        });
    }
</script>
</body>
</html>