@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
<div class="form-row">
    <div class="col-md-6"></div>
    <div class="col-md-6 col-xl-12">
        <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
            echo date('d/m/Y');
        @endphp</h5>
    </div>
</div>
    <h1>Editar Usuario</h1>
@stop


@section('content')
    <div class="card">

        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="user_name">Useruser_name: </label>
                    <input type="text" name="user_name" id="user_name" value="{{ old('user_name', $user->user_name) }}" class="form-control" autofocus aria-describedby="helpId">
                    @if ($errors->has('user_name'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('user_name') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="dob">Fecha de nacimiento: </label>
                    @php
                        $dob = $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '';
                    @endphp
                    <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $dob) }}">
                    @if ($errors->has('dob'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('dob') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico: </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required aria-describedby="helpId">
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('email') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="profile_pic">Foto de perfil:</label>
                    <input type="file" name="profile_pic" id="profile_pic" class="form-control" onchange="previewImage(event)">
                    @if ($errors->has('profile_pic'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('profile_pic') }}</span>
                        </div>
                    @endif
                    @if ($user->profile_pic)
                        <img id="current_profile_pic" src="{{ asset('storage/profile_pics/' . $user->profile_pic) }}" alt="{{ $user->name }}" class="mt-2 img-thumbnail" style="max-height: 100px; max-width: 100px;">
                    @else
                        <img id="current_profile_pic" src="#" alt="Imagen actual" class="mt-2 img-thumbnail" style="max-height: 100px; max-width: 100px; display: none;">
                    @endif
                    <img id="preview" src="#" alt="Vista previa" class="mt-2 img-thumbnail" style="max-height: 100px; max-width: 100px; display: none;">
                    <br>
                </div>
                <button type="submit" class="btn btn-success mr-2">Actualizar</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
    
    @include('footer')

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@stop

@section('js')
<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');
        var current_profile_pic = document.getElementById('current_profile_pic');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                current_profile_pic.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@stop
