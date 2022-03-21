<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Brand <b>  </b>
      </h2> 
    </x-slot>
    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
@endif

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

                        <div class="card-header">Edit Brand</div>

                        <div class="card-body">

                        <form action="{{ url('brand/update/'.$brands->id) }}" method="POST"  enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="old_image" value="{{$brands->brand_image}}">

                            <div class="form-group">
                                <label for="exampleInputEmail">Update Brand Name</label>
                                <input name="brand_name" type="text" value="{{$brands->brand_name}}" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Update Brand Image</label>
                                <input name="brand_image" type="file" value="{{$brands->brand_image}}" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <img src="{{asset($brands->brand_image)}}" style="width:400px; height:200px;">
                            </div>


                            <button type="submit" class="btn btn-primary">Update Brand</button>
                        </form>
                        </div>
                        
        </div>
    </div>
        

        </div>
    </div>
</x-app-layout>
