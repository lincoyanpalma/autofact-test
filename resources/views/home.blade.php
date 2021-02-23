@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cuestionario') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(count($last_answers) > 0)
                            <small>Tus últimas respuestas:</small>
                            <ul>
                                @foreach($last_answers as $answer)
                                    <li>{{$answer->question->text}}: <b>{{$answer->answer}}</b></li>
                                @endforeach
                            </ul>
                        @endif

                        @if(count($questions) === 0)
                            <div class="alert alert-secondary" role="alert">
                                No tenemos más preguntas para ti por el momento.
                            </div>

                        @else
                            <form action="{{ route('send_survey') }}" method="POST">
                                @foreach($questions as $question)

                                <div class="form-group">

                                    <label for="input-{{$question->id}}">{{$question->text}}</label>

                                    @if($question->answer_type->type === 'options')
                                        <select class="form-control" name="input-{{$question->id}}" id="input-{{$question->id}}">
                                            @foreach($question->answer_type->options as $option)
                                                <option value="{{$option}}">{{$option}}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @if($question->answer_type->type === 'free_text')
                                        <textarea class="form-control" name="input-{{$question->id}}" id="input-{{$question->id}}" rows="3"></textarea>
                                    @endif

                                </div>

                                @endforeach

                                <button type="submit" class="btn btn-primary">Enviar</button>
                                @csrf
                            </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
