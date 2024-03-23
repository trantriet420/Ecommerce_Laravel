@extends('Admin.Layouts.app')
@section('content')
    
<div class="col-12">
	<div class="card">
       <div class="card-body">
       	    <h4 class="card-title">Blog</h4>
       </div>
       <?php //dd($Country); ?>
		 <div class="table-responsive">
		    <table class="table table-hover">
			    <thead>
			        <tr>
			            <th scope="col">#</th>
			            <th scope="col">Title</th>
			            <th scope="col">Image</th>
			            <th scope="col">Description</th>
			            <th scope="col">Content</th>
			            <th scope="col">Action</th>
			            <th scope="col"></th>
			        </tr>
			    </thead>
			    <?php //dd($blog); ?>
			   <tbody>
                    @foreach($blog as $Blog)
			        <tr>
			            <th scope="row">{{$Blog['id']}}</th>
			            <td>{{$Blog['name']}}</td>
			            <td>{{$Blog['image']}}</td>
			            <td>{{$Blog['desciption']}}</td>
			            <td>{{$Blog['content']}}</td>
			            <td>
			            	<form  method="post" >
	    	   	   				<a href="{{url('/Admin/Blog/update/' .$Blog['id'])}}">
	                                <i class="m-r-10 mdi mdi-find-replace"></i>Edit
	                            </a>
	   	   			        </form>
			            
			            	<form  method="post" >
	    	   	   				<a href="{{url('/Admin/Blog/delete/' .$Blog['id'])}}">
	                                <i class=" mdi mdi-delete-sweep"></i>Delete
	                            </a>
	   	   			        </form>
			            </td>
			         </tr>
			        @endforeach  
			    </tbody>
		    </table>
		</div>
    </div>
	<div class="col-sm-12">
	        <a class="btn btn-success" href="{{route('Admin.Blog.add')}}">Add Blog</a>
	</div>
</div>    
@endsection