<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    All Categoty <b>  </b>
      </h2> 
    </x-slot>

    <div class="py-12">            
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
@endif

                        <div class="card-header">All Categoty</div>
                    <!-- </div>
                </div> -->

            <table class="table">
  <thead>
    <tr>
      <th scope="col">SL NO</th>
      <th scope="col">Category name</th>
      <th scope="col">User</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <!-- @php($i=1) -->
    @foreach($categories as $category  )
    <tbody>
  <tr>
      <!-- <th scope="row"> {{$i++}}</th> -->
      <th scope="row"> {{$categories->firstItem()+$loop->index}}</th>
          <td>{{ $category -> category_name }}</td>
          <td>{{ $category -> user->name}}</td>        
          <td>
          @if($category -> created_at == NULL)
          <span class="text-danger">No Date Set</span>
          @else    
          {{ Carbon\Carbon::parse($category -> created_at) -> diffForHumans() }}
        @endif

        <td>
            <a href="{{ url('category/edit/'.$category->id)  }}" class="btn btn-info">Edit</a>
            <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
        </td>

        </td>
  </tr>
  
  @endforeach
</tbody>
</table>
{{$categories->links()}}

            </div>
        </div>


        <div class="col-md-4">
                    <div class="card">
                    <!-- @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@endif -->

                        <div class="card-header">add Categoty</div>

                        <div class="card-body">

                        <form action="{{ route('store.category') }} " method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail">category name</label>
                                <input name="category_name" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                        </div>
                        
        </div>
    </div>

        </div>




        <!-- Trash Part -->


        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                   
                        <div class="card-header">Trash List</div>
                    <!-- </div>
                </div> -->

            <table class="table">
  <thead>
    <tr>
      <th scope="col">SL NO</th>
      <th scope="col">Category name</th>
      <th scope="col">User</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <!-- @php($i=1) -->
    @foreach($trachCat as $category  )
    <tbody>
  <tr>
      <!-- <th scope="row"> {{$i++}}</th> -->
      <th scope="row"> {{$categories->firstItem()+$loop->index}}</th>
          <td>{{ $category -> category_name }}</td>
          <td>{{ $category -> user->name}}</td>        
          <td>
          @if($category -> created_at == NULL)
          <span class="text-danger">No Date Set</span>
          @else    
          {{ Carbon\Carbon::parse($category -> created_at) -> diffForHumans() }}
        @endif

        <td>
            <a href="{{ url('category/restore/'.$category->id)  }}" class="btn btn-info">Restore</a>
            <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger">P Delete</a>
        </td>

        </td>
  </tr>
  
  @endforeach
</tbody>
</table>
{{$trachCat->links()}}

            </div>
        </div>


        <div class="col-md-4">
                    <!-- End Trach -->
                        
        </div>
                        
        </div>
    </div>
</div>
</div>

    </div>
</x-app-layout>
