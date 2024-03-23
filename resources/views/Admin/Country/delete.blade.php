@extends('Admin.Layouts.app')
@section('content')
      <form method="get">
	  	 @csrf
	  	 <button type="submit" >delete </button>
	  </form>
@endsection