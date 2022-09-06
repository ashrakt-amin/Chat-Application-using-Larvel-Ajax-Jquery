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
  <h1>login page</h1>
 
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    @include('layout.alerts')

     <form class="form" action="{{url('auth')}}" method="post">
      {{csrf_field()}}

      <div class="form-group mb-3">
       <label>email</label>
       <input type="email" class="form-control" placeholder="enter email" name="email" value="{{old('email')}}">
      </div>

      <div class="form-group mb-3">
       <label>password</label>
       <input type="password" class="form-control" placeholder="enter password" name="password" value="{{old('password')}}">
      </div>

     
      <div class="form-group mb-3">
        <button type="submit" class="btn btn-primary">login</button>
      </div>
     </form>
    </div>
  </div>
 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>