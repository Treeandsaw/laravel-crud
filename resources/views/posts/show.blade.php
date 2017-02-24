@extends('main')

@section('title', ' | Post')

@section('content')


	<script type="text/javascript">  
		<!--
		    function toggle_visibility(id) {
		       var e = document.getElementById(id);
		       if(e.style.display == 'block') 
		          e.style.display = 'none';
		       else
		          e.style.display = 'block';
		    }
		//-->
	</script>

	<div class="row">
		<div class="col-md-12">
			<div class="well"> 
				<div class="row">
					<div class="col-sm-6">
						<dl class="dl-horizontal">
							<dd><img src="/avatars/{{ $avata }}" style="width:150px; height: 150px; border-radius: 50%"></dd>							
						</dl>
						<dl class="dl-horizontal">
							<dt>Author:</dt>
					        <dd>{{ $post->author }} </dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Created At:</dt>
							<dd>{{ date('M j, Y' , strtotime($post->created_at)) }}</dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Last Updated At:</dt>
							<dd>{{ date('M j, Y' , strtotime($post->updated_at)) }}</dd>
						</dl> 
					</div>
					<div class="col-sm-6">
						{!! Html::linkroute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
						<br>
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete' ]) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
						<br>
						{!! Html::linkroute('posts.show', 'All Posts', null, array('class' => 'btn btn-default btn-block')) !!}
						<br>
						{!! Html::linkroute('posts.create', 'Write New Post', null, array('class' => 'btn btn-info btn-block')) !!}
					</div>
				</div> 
			</div>
		</div>
		<div class="col-md-12">
			@if($post->image != null)
                <center><img src="{{ asset('images/'.$post->image) }}" class="featured-image img-responsive"></center>
                @endif
			<h1>{{ $post->title }}</h1>
			<hr>
			<h4><img src="/avatars/{{ $avata }}" style="width:32px; height: 32px; border-radius: 50%"> {{ $post->author }}
				&nbsp; &nbsp; &nbsp; &nbsp; 
				{{ date('M j, Y' , strtotime($post->created_at)) }}
			</h4>

			<hr>
			<div class="lead">{!! $post->body !!}</div>  
			<div style="text-align: center;"><br><br><img src="/avatars/{{ $avata }}" style="width:150px; height: 150px; border-radius: 50%;">
			<br><br></div>
			<div>
				
			</div>

			<div class="row form-spacing-top">
				<div id="comment-form" class="col-md-12">
					<div class="lead">Add Comment</div>
					{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'post']) }}
						<div class="row">

							@if( !$auth )

							<div class="col-md-6">
		 						{{ Form::label('name', "Name :") }}
								{{ Form::text('name', null, ['class' => 'form-control']) }} 
							</div>

							@endif

							<div class="col-md-12 form-spacing-top">  
								{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
							</div>
							<div class="col-md-12">
								{{ Form::submit('Post Comment', ['class' => 'btn btn-info btn-block form-spacing-top']) }}
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>	 

			<div id="backend-comments" style="margin-top: 50px;">
				<h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>

				<table class='table'> 
					<tr>
						<th class="active">No.</th>
						<th class="active">Name</th> 
						<th class="active">Comment</th>
						<th class="active" width="160px"></th>
					</tr> 
					@foreach ($post->comments as $comment)
					<tr>
						<td class="info">{{ $comment->id }}.</td> 
						<td class="info">{{ $comment->name }}</td> 
						<td class="info">{{ $comment->comment }}</td>
						<td class="info">
							<a onclick="toggle_visibility({{ $comment->id }});" class="btn btn-primary btn-xs">Reply</a>
							<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-success btn-xs">Edit</a>
							<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Remove</a>
						</td>
					</tr>  
					@foreach ($replies as $reply)
					@if($comment->id==$reply->comment_id)
					<tr>
						<td>   </td>
						<td class="warning"> {{ $reply->name }} </td>
						<td class="warning"> {{ $reply->Reply }} </td>
						<td class="warning"> {{ $reply->created_at }} </td> 
					</tr> 
					@endif
					@endforeach 
					<tr>
						<td></td>
						<td></td>
						<td colspan="2">
							<div id="{{ $comment->id }}" style="display: none;">
								<div id="comment-form">
									<div class="lead">ㄴ Add Reply </div>
									{{ Form::open(['route' => ['reply.store', $post->id], 'method' => 'post']) }}
										<div class="row"> 
								            {{ Form::hidden('comment_id', $comment->id, ['class' => 'form-control']) }}

											@if( !$auth )

											<div class="col-md-6">
						 						{{ Form::label('name', "Name :") }}
												{{ Form::text('name', null, ['class' => 'form-control']) }}  
											</div>

											@endif

											<div class="col-md-12 form-spacing-top">
												{{ Form::textarea('Reply', null, ['class' => 'form-control', 'rows' => '5']) }}
											</div>
											<div class="col-md-12">
												{{ Form::submit('Post Reply', ['class' => 'btn btn-warning btn-block form-spacing-top']) }}
											</div>
										</div>
									{{ Form::close() }}
								</div> 
							</div>
						</td>
					</tr>
					@endforeach 
				</table>
			</div>
		</div>  

	</div>

	

@endsection