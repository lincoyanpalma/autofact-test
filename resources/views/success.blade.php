@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ __('Cuestionario') }}</div>

                <div class="card-body">
                    <div class="h2">Hemos recibido tus respuestas</div>
                    <div class="alert alert-success" role="alert">
                        ¡Gracias por reponder!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
