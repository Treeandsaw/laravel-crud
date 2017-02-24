@extends('main')

    @section('stylesheets')

    @endsection

    @section('title', ' | Contact')

    @section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Contact Me</h1>

                <hr>
                
                <form method="post" action="{{ url('contact') }}">
                {{ Form::open(['url' => 'contact', 'method' => 'post']) }}
                    <div class="form-group">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::textarea('subject', null, ['class' => 'form-control', 'placeholder' => 'Subject', 'rows' => '5']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::submit('Send Message', ['class' => 'btn btn-success']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    @endsection

    @section('scripts')

    @endsection