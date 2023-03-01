@extends('adminlte::page')

@section('title', 'Información de usuario')

@section('content_header')
<div class="form-row">
    <div class="col-md-6"></div>
    <div class="col-md-6 col-xl-12">
        <h5 style="text-align: right; margin-right: 30px; ">Fecha: @php
            echo date('d/m/Y');
        @endphp</h5>
    </div>
</div>
    <h1>Información del usuario</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="border-bottom text-center pb-4">
                        <h3>{{ ucwords($user->user_name) }}</h3>
                        <img src="{{ asset('storage/profile_pics/' . $user->profile_pic) }}" style="height: 200px; width: 200px; border-radius: 20%;">
                        <div class="d-flex justify-content-between">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 pl-lg-5">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Información del Usuario</h4>
                        </div>
                    </div>
                    <div class="profile-feed">
                        <div class="d-flex align-items-start profile-feed-item">

                            <div class="form-group col-md-6">
                                <strong><i class="fas fa-sort-numeric-up mr-1"></i> Email</strong>
                                <p class="text-muted">
                                    {{ $user->email }}
                                </p>
                                <hr>
                                <strong><i class="fas fa-chart-pie mr-1"></i> Fecha de Nacimiento:</strong>
                                <p class="text-muted">
                                    {{ \Carbon\Carbon::parse($user->dob)->format('d/m/Y') }}
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('users.index') }}" class="btn btn-primary float-right  m-1">Regresar</a>
        </div>
    </div>

    @include('footer')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>


@stop
