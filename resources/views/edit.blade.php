@extends('layout.app')
@section('content')

<script>
		function editquestion(){
		$(document).ready(function(){
			var question = $("#1").val()
			var answer = $("#2").val()
			var e = document.getElementById("category");
			var category = e.options[e.selectedIndex].value;
			var questionenc = encodeURI(question);
			var answerenc = encodeURI(answer);
			var param = "question=" + questionenc + "&answer=" + answerenc + "&category_id	=" + category  + "&question_id=" + {{$question['id']}};
			mywind = window.open("/edit/{{$question['id']}}/"+answerenc+"/"+questionenc+"/"+category+"","_self");
		});
		}
</script>
         <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <h2>Edit Question</h2></div>
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
				<tbody>
					<tr>
						
							
						<td><textarea id='1' class='form-control' ' type ='text'>{{ $question['question'] }}</textarea></td>
						<td><textarea id='2' class='form-control' ' type ='text'>{{ $question['answer'] }}</textarea></td>
						<td><select id='category'>
						@foreach($category as $item)
						@if($question['category_id'] == $item['category_id'])
								<option value="{{$item['category_id']}}" selected>{{$item['name']}}</option>
							@else
								<option value="{{$item['category_id']}}">{{$item['name']}}</option>
							@endif
						@endforeach	</select></td>
						<td>{{ $question['helpful'] }}</td>
						<td>{{ $question['nothelpful'] }}</td>
						<td>{{ $question['private'] }}</td>
						<td>
						<button onclick='editquestion()' class='btn btn-primary' style='margin-top:5px'>Edit</button>
						</td>
						
					</tr>
				
				</tbody>
			</table>
            </div>
          </div>
        </div>
@endsection