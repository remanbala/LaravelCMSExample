@extends('layouts.backend')

@section('siteTitle')
    Posts
@endsection

@section('adminTitle')
    Posts
@endsection

@section('content')

<div class="col">

    <div class="d-flex justify-content-end">
        <a href="{{ route('post.create') }}" class="btn btn-primary mb-3" role="button" aria-pressed="true">Create New Post</a>
        <a href="{{ route('trashed-posts.index') }}" class="btn btn-danger mb-3 ml-3" role="button" aria-pressed="true">Trashed Post</a>
      </div>

    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>

        <div class="card-body">
            @if ($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/'.$post->image) }}" width="120px" height="60px">
                                
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>
                                {{ $post->category['name'] }}
                            </td>
                            
                                @if ($post->trashed())
                                <td>
                                    <form action="{{ route('restore-posts', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <button class="btn btn-info">Restore</button>
                                    </form>
                                    
                                </td>
                                @else
                                <td>
                                    <form action="{{ route('post.edit', $post->id) }}" method="get">
                                        @csrf
                                    <button class="btn btn-info">Edit</button>
                                    </form>
                                    
                                </td>
                                
                                @endif
                                
                            
                            <td>
                                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        {{ $post->trashed() ? 'Delete' : 'Trash'}}
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">No Post</h3>
            @endif
           
        </div>
    </div>


</div>


@endsection

