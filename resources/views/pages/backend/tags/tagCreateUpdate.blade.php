@extends('layouts.backend')

@section('siteTitle')
    Tags
@endsection

@section('adminTitle')
    Tags
@endsection

@section('content')

<div class="col">

    <div class="col-6">
        <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
            @csrf
            @if (isset($tag))
                @method('PUT')
            @endif
            <div class="form-group">
              <label for="name">Tag Name</label>
              <input type="text" class="form-control" placeholder="Enter Tag Name" name="name" value="{{ isset($tag) ? $tag->name : '' }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ isset($tag) ? 'Update' : 'Add' }}</button>
            </div>
            
          </form>

    </div>

    

</div>


@endsection