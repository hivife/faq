@extends('layout.app')
@section('content')
         <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <h2>Edit Categories<a href="/admin/category/edit/0"><button style='margin-left:20px' class='btn btn-primary'>Create</button></a></h2></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
				
                  <tr>

                    <th>Category</th>
                    <th>Category ID</th>
					<th>private</th>
                    <th></th>	
                  </tr>
                </thead>
				<tbody>@foreach($category as $item)
					<tr>
						<td>{{ $item['name'] }}</td>
						<td>{{ $item['category_id'] }}</td>
						<td>{{ $item['private'] }}</td>
						<td><a href="/admin/category/delete/{{$item['category_id']}}"<button style='margin-top:5px' class='btn btn-primary'>Delete</button></a>
						<a href="/admin/category/edit/{{$item['category_id']}}"><button class='btn btn-primary' style='margin-top:5px'>Edit</button></a>
						@if($item['private']==1)<a href="/admin/category/publish/{{$item['category_id']}}"><button class='btn btn-primary' style='margin-top:5px'>Publish</button></a>
						@else <a href="/admin/category/private/{{$item['category_id']}}"><button class='btn btn-primary' style='margin-top:5px'>Make Private</button></a>
						@endif</td>
						
					</tr>
					@endforeach
				</tbody>
				
				</table>
            </div>
          </div>
        </div>
@endsection