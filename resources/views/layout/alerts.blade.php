@if(count($errors))
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
<li><strong>{{$error}}</strong></li>
    @endforeach
</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif