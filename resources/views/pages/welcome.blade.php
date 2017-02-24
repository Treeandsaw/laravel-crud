@extends('main')

  @section('stylesheets')

  @endsection

  @section('title', ' | Home')

  @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Hello World</h1>
                    <p>Laravel 5.4 
                    <br>Description</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">

              @foreach($posts as $post)

              <div class="post">
                @if($post->image != null)
                <img src="{{ asset('images/'.$post->image) }}" class="featured-image img-responsive">
                @endif
                <h2>{{ $post->title }}</h2>
                <div class="lead">{!! substr(strip_tags($post->body), 0, 150) !!} {{ strlen(strip_tags($post->body)) > 150 ? "..." : "" }}</div>
                <div>
                  @foreach($post->tags as $tag)
                    <span class="label label-danger"><a href="{{ route('tags.search', $tag->id) }}" class="taglink">{{ $tag->name }}</a></span>
                  @endforeach
                </div>
                <p>{{ $post->author }} | <a href="{{ route('categories.search', $post->category->id) }}" class="nolink">{{ $post->category->name }}</a></p>
                <p>{{ date('M j, Y', strtotime($post->created_at)) }}</p>
                <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary btn-md">Read More</a>
              </div>
              <hr>

              @endforeach

            </div>

            <div class="col-md-3 col-md-offset-1">
              <div class="row well">
                <h2>Recent Posts</h2>
                
                @foreach($recents as $recent)
                  <p><span class="glyphicon glyphicon-paperclip"></span> <a href="{{ url('blog/'.$recent->slug) }}" class="nolink">{{ $recent->title }}</a></p>
                @endforeach
              </div>
              <div class="row well">
                <h2>Categories</h2>
                @foreach($categories as $category)
                  <p><span class="glyphicon glyphicon-pushpin"></span> <a href="{{ route('categories.search', $category->id) }}" class="nolink"> {{ $category->name }}</a></p>
                @endforeach
              </div>
            </div>
        </div>

        <div class="text-center">
          {!! $posts->links(); !!}
        </div>
  @endsection

  @section('scripts')

  @endsection