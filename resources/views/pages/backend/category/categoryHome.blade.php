@extends('layouts.backend')

@section('siteTitle')
    Categories
@endsection

@section('adminTitle')
    Categories
@endsection

@section('content')


    <div class="col">

      <div class="d-flex justify-content-end">
        <a href="{{ route('category.create') }}" class="btn btn-primary mb-3" role="button" aria-pressed="true">Create Category</a>
      </div>
      @if ($cat->count() > 0)
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Category Name</th>
            <th scope="col">Post Count</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($cat as $category)
                
            <tr>
                
                <td>{{ $category->name }}</td>
                <td>
                    {{ $category->post->count() }}
                </td>
                <td>
                    {{-- <form action="{{ route('category.edit', $category->id) }}" method="GET">
                        @csrf
                     
                        <button class="btn btn-info">Edit</button>
                    </form> --}}

                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info">Edit</a>
                  

                    <button class="btn btn-danger" onclick="handleDelete({{ $category->id }})" >Delete</button>
                </td>
                
              </tr>
            
            @endforeach
          
        </tbody>
      </table>
      @else
          <h3 class="text-center pt-3">No Categories</h3>
      @endif
         
        
    </div>
  
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="" method="POST" id="deleteCategoryForm">
            
            @csrf 
            @method('DELETE')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               Are you sure you want to delete this category?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
              </div>
            </div>
          </form>
        </div>
      </div>



@endsection


@section('script')
<script>
    function handleDelete(id){
      var form = document.getElementById('deleteCategoryForm')
      form.action = '/category/' + id
      $('#deleteModal').modal('show'); 
    }
  </script>
    
@endsection