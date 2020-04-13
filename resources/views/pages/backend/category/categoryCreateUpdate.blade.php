@extends('layouts.backend')

@section('siteTitle')
    Categories
@endsection

@section('adminTitle')
    Categories
@endsection

@section('content')

<div class="col">

    <div class="col-6">
        <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="text" class="form-control" placeholder="Enter Category Name" name="name" value="{{ isset($category) ? $category->name : '' }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Add' }}</button>
            </div>
            
          </form>

    </div>

    

</div>


@endsection