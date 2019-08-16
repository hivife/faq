@extends('layout.app')
@section('content')
<script>
		function editcategory(){
		$(document).ready(function(){
			var question = $("#1").val()
			var questionenc = encodeURI(question);
			mywind = window.open("/edit/category/@if(isset($category['category_id'])) {{$category['category_id']}} @else 0 @endif/"+questionenc,"_self");
		});
		}
</script>
         <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <h2>Edit Category</h2></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
				
                  <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Private</th>
                    <th></th>
                  </tr>
                </thead>
				<tbody>
					<tr>
						
							
						<td><textarea id='1' class='form-control' ' type ='text'>{{ $category['name'] }}</textarea></td>
						<td>{{ $category['category_id'] }}</td>
						<td>{{ $category['private'] }}</td>
						<td>
						<button onclick='editcategory()' class='btn btn-primary' style='margin-top:5px'>Edit</button>
						</td>
						
					</tr>
				
				</tbody>
			</table>
            </div>
          </div>
        </div>
@endsection