@extends('layouts.backend')

@section('siteTitle')
    Tags
@endsection

@section('adminTitle')
    Tags
@endsection

@section('content')


    <div class="col">

      <div class="d-flex justify-content-end">
        <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3" role="button" aria-pressed="true">Create Tag</a>
      </div>
      @if ($tag->count() > 0)
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Tag Name</th>
           
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($tag as $tagItem)
                
            <tr>
                
                <td>{{ $tagItem->name }}</td>
                
                <td>
                    {{-- <form action="{{ route('tags.edit', $tagItem->id) }}" method="GET">
                        @csrf
                     
                        <button class="btn btn-info">Edit</button>
                    </form> --}}

                    <a href="{{ route('tags.edit', $tagItem->id) }}" class="btn btn-info">Edit</a>
                  

                    <button class="btn btn-danger" onclick="handleDelete({{ $tagItem->id }})" >Delete</button>
                </td>
                
              </tr>
            
            @endforeach
          
        </tbody>
      </table>
      @else
          <h3 class="text-center pt-3">No Tags</h3>
      @endif
         
        
    </div>
  
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="" method="POST" id="deletetagItemForm">
            
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
               Are you sure you want to delete this tag?
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
      var form = document.getElementById('deletetagItemForm')
      form.action = '/tags/' + id
      $('#deleteModal').modal('show'); 
    }
  </script>
    
@endsection