@extends('main')

@section('title', " | $category->name Category")

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $category->name }} Category <small>{{ $category->posts()->count() }}
                @if ($category->posts()->count() == 1)
                    Post
                @else Posts
                @endif
            </small></h1>
        </div>
        <div class="col-md-2 col-md-offset-2">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-block pull-right form-spacing-top">Edit</a>
        </div>
    </div>

    <div>
        <div class="col-md-12">
            <table class="table lead">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm btn-block pull-right">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection