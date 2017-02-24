@extends('main')

@section('title', ' | Categories')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{ $category->id }}</td>
						<td><a href="{{ route('categories.show', $category->id) }}" class="nolink">{{ $category->name }}</a></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-3 col-md-offset-1">
			<div class="well">
				{{ Form::open(['route' => 'categories.store']) }}
				<h2>New Category</h2>

				{{ Form::label('name', 'Name :') }}
				{{ Form::text('name', null, ['class' => 'form-control']) }}

				{{ Form::submit('Add Category', ['class' => 'btn btn-success btn-block login-spacing-top']) }}
			</div>
		</div>
	</div>

@endsection