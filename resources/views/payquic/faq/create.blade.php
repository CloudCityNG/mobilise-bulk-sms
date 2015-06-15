@extends('payquic.layouts.master')

@section('content')


    <div class="col-lg-8 left-side">
        <h2 class="title">Add new FAQ</h2>
        @include('payquic.layouts.partials.errors')
        {!! Form::open(['route'=>'faq.store','autocomplete'=>'off']) !!}

            <div class="form-group">
                {!! Form::label('question', 'Question: ') !!}
                {!! Form::text('question', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('answer', 'Answer: ') !!}
                {!! Form::textarea('answer', null, ['id'=>'answer_box','class'=>'form-control','rows'=>5]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('position', 'Position: ') !!}
                {!! Form::select('position', $position, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('visibility', 'Visibility: ') !!}
                {!! Form::select('visibility', [0=>"Dont't show", 1 => 'Show'], 1, ['class'=>'form-control']) !!} Visibility
            </div>
            
            <div class="form-group">
                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>



@stop