@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estadísticas') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        @if(!Auth::user()->admin)
                            <div class="alert alert-secondary" role="alert">
                                Ups! no puedes estar aquí
                            </div>
                        @else

                            @if(count($last_answers) > 0)
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Pregunta</th>
                                        <th scope="col">Respuesta</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($last_answers as $answer)
                                        <tr>
                                            <th scope="row">{{$answer->user->name}}</th>
                                            <td>{{$answer->question->text}}</td>
                                            <td>{{$answer->answer}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

                            <p>.</p>

                            <hr class="my-4">

                            <div>
                                <canvas id="pieChart" style="max-width: 500px;"></canvas>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="application/javascript">
        $(document).ready(function() {
            var ctx = $("#pieChart");
            var myLineChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Si", "No", "Mas o Menos"],
                    datasets: [{
                        data: [1200, 1700, 800],
                        backgroundColor: ["rgba(255, 0, 0, 0.5)", "rgba(100, 255, 0, 0.5)", "rgba(200, 50, 255, 0.5)"]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Todas las respuestas'
                    }
                }
            });
        });
    </script>
@endsection
