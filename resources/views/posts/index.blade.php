@extends('main')

@section('title', ' | All Blogs')

@section('content')

	<div class="row" style="padding: 20px">
		<div class="col-md-10">
			<h1>All posts</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-lg btn-lg btn-primary btn-h1-spacing">Create New Blog</a>
		</div> 
	</div> 
	<div class="row">
		<div class="col-md-12">
			@if(count($posts)==0)
			<div>
				<p>There is no post yet.</p>
				<p>Please make an account first, and create new post.</p>
				<a href="/register">Make an account.</a>
				<br><br>
				<img src="photo/index.png" alt="">
				<p>Tree&Saw is my online-shopping mall.</p>
				<p>Please buy something for me.</p>
				<p>Thanks a lot.</p>
				<a href="http://www.treeandsaw.com" target="_blank">Visit Tree&Saw</a> 
				<br><br><br>
			</div>
			<div style="text-align: right">
				<p>Written by treeboy.</p>	
				<p>Feb. 22 2017 from Bakersfield, CA</p>
			</div>
			@endif
					
			<table class="table">
			@foreach ($posts as $post) 
				<tr>
					<td>{{ $post->id }}</td>
					<td>
					    @if($post->image != null)
					    	<a href="{{ route('posts.show', $post->id) }}">
					    		<img src="{{ asset('images/'.$post->image) }}" width="100px">	
					    	</a>                	
		                @endif
					</td>
					<td><h2>{{ $post->title }}</h2></td>
					<td>{{ $post->author }}</td>
					<td>{{ date('M j, Y' , strtotime($post->created_at))}}</td> 
				</tr>
			@endforeach
			</table>
			<hr>
		</div> 
	</div>
	<div class="row">   
		<div class="col-md-10"> 
		</div>
		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-lg btn-lg btn-primary btn-h1-spacing">Create New Blog</a>
		</div>
	</div> 
@endsection