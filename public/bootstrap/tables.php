<!DOCTYPE html>
<?php
 // include '../functions.php';


if(isset($_GET['question_id'])){
	$question_id = $_GET['question_id'];
}
if(isset($_GET['userid'])){
	$userid = $_GET['userid'];
}
else{
	$userid = 0;
}
if(isset($_GET['category'])){
	$category = $_GET['category'];
}
if(isset($_GET['delete'])){
	$delete = $_GET['delete'];
}
if(isset($_GET['edit'])){
	$edit = $_GET['edit'];
}
if(isset($_GET['question'])){
	$question = $_GET['question'];
}
if(isset($_GET['answer'])){
	$answer = $_GET['answer'];
}
if(isset($_GET['category_id'])){
	$category_id = $_GET['category_id'];
}
if(isset($_GET['create'])){
	$create = $_GET['create'];
}

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";


	$counter = 0;
	try{
		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
	}
	
	catch(Exception $e){
		die("Database Connection Failed: " . $e->getMessage());
	}
	$sql1 = "SELECT * FROM qa WHERE answer = '' ";
	$sql2 = "SELECT * FROM qa INNER JOIN category ON category.category_id = qa.category_id";
	$sql3 = "SELECT name,category_id FROM category";
	if(isset($_GET['question']) && isset($_GET['answer']) && !isset($delete)&& !isset($edit) && !isset($create)){
		$sql = "UPDATE qa SET answer = ? WHERE question = ? AND category = ? AND userid = ?;";
		$temp = $conn->prepare($sql);
		$temp->execute([$answer,$question,$category,$userid]);
	}
	if(isset($_GET['question_id']) && isset($delete)){
		$sql = "DELETE FROM qa WHERE question_id = :id";
		$temp = $conn->prepare($sql);
		$temp->execute(array('id' => $question_id));
	}
	if(isset($_GET['question']) && isset($_GET['category']) && isset($_GET['answer']) && isset($_GET['question_id']) && isset($edit)){
		//$sql1 = "SELECT id FROM category WHERE name = :name";
		//$temp = $conn->prepare($sql);
		//$temp->execute(array("name" => $category));
		$sql = "UPDATE qa SET answer = ?, question = ?, category_id = (SELECT category_id FROM category WHERE name = ?) WHERE question_id = ?";
		$temp = $conn->prepare($sql);
		$temp->execute([$answer,$question,$category,$question_id]);
	}
	if(isset($_GET['question']) && isset($_GET['category_id']) &&isset($_GET['answer']) && isset($create)){
		$sql = "INSERT INTO qa (question,category_id,answer) VALUES(?,?,?)";
		$temp = $conn->prepare($sql);
		$temp->execute([$question,$category_id,$answer]);
	}
	?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FAQ Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
	<script type="text/javascript">
	function post(path, parameters) {
		var form = $('<form></form>');

		form.attr("method", "post");
		form.attr("action", path);

		$.each(parameters, function(key, value) {
			var field = $('<input></input>');

			field.attr("type", "hidden");
			field.attr("name", key);
			field.attr("value", value);

			form.append(field);
		});

		// The form needs to be a part of the document in
		// order for us to be able to submit it.
		$(document.body).append(form);
		form.submit();
	}
	function send(question,btnclass,counter,userid){
		var answer = $('.'+ counter).val();
		if(answer != ""){
			var questionenc = encodeURI(question);
			var param = "question=" + questionenc + "&answer=" + encodeURI(answer) + "&userid=" + userid + "&category=" + btnclass;
			window.open("tables.php?"+param,"_self");
		}
		
	}	
	function deletequestion(question_id){
		var param = "question_id=" + question_id + "&delete=1";
		window.location="https://google.com";
		window.open("tables.php?"+param,"_self");

	}
	function editquestion(counter,counter2,counter3,question_id){
		$(document).ready(function(){
			var question = $("#"+counter).val()
			var answer = $("#"+counter2).val()
			var category = $("#"+counter3).val()
			var questionenc = encodeURI(question);
			var answerenc = encodeURI(answer);
			var categoryenc = encodeURI(category);
			var param = "question=" + questionenc + "&answer=" + answerenc + "&category	=" + category + "&edit=1" + "&question_id=" + question_id;
			mywind = window.open("tables.php?"+param,"_self");
		});
	}
	function create(){
		var question = $("#c1").val();
		var e = document.getElementById("c3");
		var category = e.options[e.selectedIndex].id;
		var answer = $("#c2").val();
		var questionenc = encodeURI(question);
		var answerenc = encodeURI(answer);
		var param = "question=" + questionenc + "&answer=" + answerenc + "&category_id=" + category + "&create=1";
		window.open("tables.php?"+param,"_self");
	}
	</script>	
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="tables.php">Home</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
	
      <li class="nav-item active">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Edit Questions</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">



        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Edit Questions</div>
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
                    <th></th>
                  </tr>
                </thead>
				
                <tbody>
	<?php     
	//create edit table
	$counter2 = 100;
	$counter3 = 200;
	foreach ($conn->query($sql2) as $item	){
		echo "<tr> 	";	
		echo "<td>";
		echo "<textarea style='float:left;' class='form-control' id='".$counter."' type ='text' >".$item['question']."</textarea>";
		echo "</td>";
		echo "<td>";
		echo "<textarea style='float:left;' class='form-control' id='".$counter2."' type ='text'>".$item['answer']."</textarea>";
		echo "</td>";
		echo "<td>";
		echo "<textarea style='float:left;' class='form-control' id='".$counter3."' type ='text' >".$item['name']."</textarea>";
		echo "</td>";
		echo "<td>";
		echo $item['helpful'];
		echo "</td>";
		echo "<td>";
		echo $item['nothelpful'];
		echo "</td>";
		echo "<td>";
		$onclickparamdelete = "	('".$item['question_id']."')";
		$onclickparamedit = "editquestion('".$counter."','".$counter2."','".$counter3."','".$item['question_id']."')";
		echo "<button class='btn btn-primary' onclick=\"".$onclickparamedit."\">edit</button> ";
		echo "<button class='btn btn-primary' onclick=\"".$onclickparamdelete."\">delete</button> ";
		echo "</td>";
		echo "<br>";
		echo "</tr>";
		$counter++;
		$counter2++;
		$counter3++;
	}
	echo "</table>";
	//create question
	echo "<table style=''>";
	echo "<tr> 	";	
	echo "<td style='margin-right:25px'>";
	echo "<textarea placeholder='Question' style='float:left;' class='form-control' id='c1' type ='text' value=''></textarea>";
	echo "</td>";
	echo "<td>";
	echo "<textarea placeholder='Answer' style='float:left;' class='form-control' id='c2' type ='text' value=''></textarea>";
	echo "</td>";
	echo "<td>";
	
	//category
	echo "<div class='form-group'>   <label for='sel1'>Select list:</label>  ";
	echo "  <select class='form-control' id='c3'>";
	foreach($conn->query($sql3) as $item){
		echo "<option id='".$item['category_id']."'>".$item['name']."</option>";
	}
	echo "</select>";
	echo "</div>";
	echo "</td>";
	echo "<td>";
	echo "<button class='btn btn-primary' style='margin-left:32px'	onclick='create()'>create</button> ";
	echo "</td>";
	echo "</table>";	

?>
			   </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

       
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Alif Sarmoya 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
