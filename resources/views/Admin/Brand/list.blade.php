@extends('Admin.Layouts.app')
@section('content')
<div class="col-12">
	<div class="card">
       <div class="card-body">
       	    <h4 class="card-title">Brand</h4>
       </div>
       <?php //dd($Country); ?>
		 <div class="table-responsive">
		    <table class="table table-hover">
			    <thead>
			        <tr>
			            <th scope="col">#</th>
			            <th scope="col">Title</th>
			            <!-- <th scope="col">Image</th>
			            <th scope="col">Description</th> -->
			            <th scope="col">Action</th>
			        </tr>
			    </thead>
			    @foreach($Brand as $brand)
			   <tbody>
			        <tr>
			            <th scope="row">{{ $brand['id'] }}</th>
			            <td>{{ $brand['name'] }}</td>
			            <td>
			            	<form  method="post" >
	    	   	   				<a href="{{url('/Admin/Brand/delete/' .$brand['id'])}}">
	                                <i class=" mdi mdi-delete-sweep"></i>Delete
	                            </a>
	   	   			        </form>
			            </td>
			        </tr>
			    </tbody>
			    @endforeach
		    </table>
		</div>
    </div>
	<div class="col-sm-12">
	        <a class="btn btn-success" href="{{route('Admin.brand.add')}}">Add Brand</a>
	</div>
</div>
@endsection