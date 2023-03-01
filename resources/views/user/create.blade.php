@extends('adminlte::page')
@section('title', 'Registrar Usuario')

@section('content_header')
<div class="form-row">
    <div class="col-md-6"></div>
    <div class="col-md-6 col-xl-12">
        <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
            echo date('d/m/Y');
        @endphp</h5>
    </div>
</div>
    <h1>Registrar Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_name">Nombre: </label>
                <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" class="form-control"
                    tabindex="1" autofocus required>
                @if ($errors->has('user_name'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('user_name') }}</span>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="dob">Fecha de nacimiento: </label>
                <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}" required>
                @if ($errors->has('dob'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('dob') }}</span>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico: </label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('email') }}</span>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="profile_pic">Foto de perfil: </label>
                <input type="file" name="profile_pic" id="profile_pic" value="{{ old('profile_pic') }}" class="form-control" tabindex="3" required onchange="previewImage()">
                @if ($errors->has('profile_pic'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('profile_pic') }}</span>
                    </div>
                @endif
            </div>
            
            <img id="preview" src="#" style="height: 100px; width: 100px; display: none;">
            <br>
            
            <button type="submit" class="btn btn-success mr-2">Registrar</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
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
    function previewImage() {
        const fileInput = document.getElementById('profile_pic');
        const preview = document.getElementById('preview');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
@stop
