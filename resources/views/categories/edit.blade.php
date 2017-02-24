@extends('main')

@section('title', ' | Edit Category')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="well">
				{{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) }}
				
				{{ Form::label('name', 'Name :') }}
				{{ Form::text('name', null, ['class' => 'form-control']) }}

				{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block form-spacing-top']) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>

@endsection