@extends('layouts.app')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
	{{ $message }}
</div>

@endif

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Employee Data</b></div>
			<p>Type something in the input field to search the table for name, emails , departments, roles :</p>  
			<input id="myInput" type="text" placeholder="Search..">
			<br><br>
			<div class="col col-md-6">
				<a href="{{ route('employees.create') }}" class="btn btn-success btn-sm float-end">Add</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Department</th>
				<th>Role</th>
				<th>Action</th>
			</tr>
			@if(count($data) > 0)
<tbody id="myTable">
				@foreach($data as $row)

					<tr>
						<td><img src="{{ asset('images/' . $row->employee_image) }}" width="75" /></td>
						<td>{{ $row->employee_name }}</td>
						<td>{{ $row->employee_email }}</td>
						<td>{{ $row->employee_gender }}</td>
						<td>{{ $row->employee_department }}</td>
						<td>{{ $row->employee_role }}</td>
						<td>
							<form method="post" action="{{ route('employees.destroy', $row->id) }}">
								@csrf
								@method('DELETE')
								<a href="{{ route('employees.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
								<a href="{{ route('employees.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
								<input type="submit" class="btn btn-danger btn-sm" value="Delete" />
							</form>
							
						</td>
					</tr>

				@endforeach
				</tbody>
			@else
				<tr>
					<td colspan="5" class="text-center">No Data Found</td>
				</tr>
			@endif
		</table>
		{!! $data->links() !!}
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection
