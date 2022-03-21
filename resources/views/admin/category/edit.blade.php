<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Category <b>  </b>
      </h2> 
    </x-slot>

    <div class="py-12">            
        <div class="container">
            <div class="row">


        <div class="col-md-8">
                    <div class="card">
                    <!-- @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@endif -->

                        <div class="card-header">Edit Categoty</div>

                        <div class="card-body">

                        <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail">Update Category Name</label>
                                <input name="category_name" type="text" value="{{$categories->category_name}}" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                        </div>
                        
        </div>
    </div>
        

        </div>
    </div>
</x-app-layout>
