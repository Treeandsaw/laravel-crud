@extends('main')

@section('title', ' | Delete Comment')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Delete this Comment?</h1>
			<div class="well">
				<p><strong>Name:</strong> {{ $comment->name }}</p>
				<p><strong>Email:</strong> {{ $comment->email }}</p>
				<p><strong>Comment:</strong> {{ $comment->comment }}</p>
			</div>

			{{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete']) }}

				{{ Form::submit('YES Delete', ['class' => 'btn btn-danger btn-block']) }}

			{{ Form::close() }}
		</div>
	</div>	

@endsection