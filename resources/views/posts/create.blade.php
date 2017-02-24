@extends('main')

@section('title', ' | New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<!-- This looks stupid(js in stylesheets) but this is the best way -->
	<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
  	
  	<script>
  		tinymce.init({
  			// selector:'textarea',
  			plugins: 'code'
  		});
  	</script>
	

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>

			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
			    
				{{ Form::label('title', 'Title :') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '256')) }} <br>
  
				{{ Form::label('featured_image', 'Upload Featured Image:') }}
				{{ Form::file('featured_image') }} <br>

				{{ Form::label('body', 'Body :') }}
				{{ Form::textarea('body', null, ['class' => 'form-control input-lg']) }}


				{{ Form::label('submit', ' ') }}
				{{ Form::submit('Create New Post', array('class' => 'btn btn-success btn-lg btn-block form-spacing-top')) }}

			{!! Form::close() !!}

		</div>
	</div>

@endsection

@section('scripts')

	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.full.min.js') !!}
	<script type="text/javascript">
		$(".select2-multiple").select2();
	</script>

@endsection