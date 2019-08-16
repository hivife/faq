@extends('layout.app')
@section('content')


         <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <h2>Edit Questions<a href="/admin/edit/0"><button style='margin-left:20px' class='btn btn-primary'>Create</button></a></h2></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
				
                  <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Category</th>
                    <th>Helpful</th>
                    <th>Not Helpful</th>
					<th>private</th>
                    <th></th>
                  </tr>
                </thead>
				<tbody>@foreach($questions as $item)
					<tr>
						
						
						<td>{{ $item['question'] }}</td>
						<td>{{ $item['answer'] }}</td>
						@foreach($category as $item2)
							@if($item2['category_id'] == $item['category_id'])
								<td>{{ $item2['name'] }}</td>
							@endif
						@endforeach	
						<td>{{ $item['helpful'] }}</td>
						<td>{{ $item['nothelpful'] }}</td>
						<td>{{ $item['private'] }}</td>
						<td><a href="/admin/delete/{{$item['id']}}"<button class='btn btn-primary'>Delete</button></a>
						<a href="/admin/edit/{{$item['id']}}"><button class='btn btn-primary' style='margin-top:5px'>Edit</button></a>
						@if($item['private']==1)<a href="/admin/publish/{{$item['id']}}"><button class='btn btn-primary' style='margin-top:5px'>Publish</button></a>
						@else <a href="/admin/private/{{$item['id']}}"><button class='btn btn-primary' style='margin-top:5px'>Make Private</button></a>
						@endif</td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
            </div>
          </div>
        </div>
 
@endsection