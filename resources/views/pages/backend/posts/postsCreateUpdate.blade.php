@extends('layouts.backend')

@section('siteTitle')
    Posts
@endsection

@section('adminTitle')
    Posts
@endsection

@section('content')

<div class="col">


    <div class="card card-default">

        <div class="card-header">
            {{ isset($posts) ? 'Edit Post' : 'Create Post' }}
        </div>

        <div class="card-body">

            <form action="{{ isset($posts) ? route('post.update', $posts->id) : route('post.store')  }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($posts))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($posts) ? $posts->title : '' }}">
                </div>
            
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($posts) ? $posts->description : ''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                   
                    <input id="content" type="hidden" name="content" value="{{ isset($posts) ? $posts->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            @if (isset($posts))
                                @if($category->id == $posts->category_id)
                                selected
                                @endif
                            @endif
                            
                            >
                        {{ $category->name }}
                        </option>
                        @endforeach
                        
                    </select>
                </div>

                @if ($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Tags</label>
                    
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            @if (isset($posts))
                                @if($posts->hasTag($tag->id))
                                selected
                                @endif
                            @endif
                            > 
                        
                       
                            {{ $tag->name }}
                        </option>

                        @endforeach
                    </select>
                    
                    
                </div>
                @endif
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($posts) ? $posts->published_at : '' }}">
                </div>

               

                @if (isset($posts))
                <div class="form-group">
                    <img src="{{ asset('storage/'.$posts->image) }}" width="120px" height="60px">
                </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                    
                
                
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        {{ isset($posts) ? 'Update Post' : 'Create Post'}}
                    </button>
                </div>

               
                </form>

        </div>

    </div>

    



</div>


@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime:true
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection