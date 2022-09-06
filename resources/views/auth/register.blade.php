<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="text-center">
  <h1>Register</h1>
 
</div>
<div class="container">
  <div class="row">
  @include('layout.alerts')

    <div class="col-md-12">
     <form class="form" action="{{url('store')}}" method="post">
      {{csrf_field()}}

      <div class="form-group mb-3">
       <label>name</label>
       <input type="text" class="form-control" placeholder="enter name" name="name" value="{{old('name')}}">
      </div>

      <div class="form-group mb-3">
       <label>email</label>
       <input type="email" class="form-control" placeholder="enter email" name="email" value="{{old('email')}}">
      </div>

      <div class="form-group mb-3">
       <label>password</label>
       <input type="password" class="form-control" placeholder="enter password" name="password" value="{{old('password')}}">
      </div>

      <div class="form-group mb-3">
       <label>password confirmation</label>
       <input type="password" class="form-control" placeholder="enter password confirmation" name="password_confirmation" value="{{old('password-confirmation')}}">
      </div>

      <div class="form-group mb-3">
        <button type="submit" class="btn btn-primary" >register</button>
      </div>
     </form>
    </div>
  </div>
 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>