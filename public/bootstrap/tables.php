<!DOCTYPE html>
<?php
 // include '../functions.php';

	
if(isset($_GET['question'])){
	$question = $_GET['question'];
}
if(isset($_GET['answer'])){
	$answer = $_GET['answer'];
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
if(isset($_GET['oldquestion'])){
	$oldquestion = $_GET['oldquestion'];
}
if(isset($_GET['oldanswer'])){
	$oldanswer = $_GET['oldanswer'];
}
if(isset($_GET['oldcategory'])){
	$oldcategory = $_GET['oldcategory'];
}
if(isset($_GET['create'])){
	$create = $_GET['create'];
}

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";


	$counter = 0;
	$conn = new PDO("mysql:host=$dbservername;dbname=myDB", $dbusername, $dbpassword);
	$sql1 = "SELECT * FROM qa WHERE answer = '' ";
	$sql2 = "SELECT * FROM qa INNER JOIN category ON category.category_id = qa.category_id";
	if(isset($_GET['question']) && isset($_GET['answer']) && !isset($delete)&& !isset($edit) && !isset($create)){
		$sql = "UPDATE qa SET answer = ? WHERE question = ? AND category = ? AND userid = ?;";
		$temp = $conn->prepare($sql);
		$temp->execute([$answer,$question,$category,$userid]);
	}
	if(isset($_GET['question']) && isset($_GET['category']) && isset($delete)){
		$sql = "DELETE FROM qa WHERE question = ? AND category = ? AND userid = ?;";
		$temp = $conn->prepare($sql);
		$temp->execute([$question,$category,$userid]);
	}
	if(isset($_GET['question']) && isset($_GET['category']) && isset($_GET['answer']) && isset($edit)){
		$sql = "UPDATE qa SET answer = ?, question = ?, category = ? WHERE answer = ? AND question = ? AND category = ?;";
		$temp = $conn->prepare($sql);
		$temp->execute([$answer,$question,$category,$oldanswer,$oldquestion,$oldcategory,]);
	}
	if(isset($_GET['question']) && isset($_GET['category']) &&isset($_GET['answer']) && isset($create)){
		$sql = "INSERT INTO qa (question,category,answer) VALUES(?,?,?)";
		$temp = $conn->prepare($sql);
		$temp->execute([$question,$category,$answer]);
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
	function send(question,btnclass,counter,userid){
		var answer = $('.'+ counter).val();
		if(answer != ""){
			var questionenc = encodeURI(question);
			var param = "question=" + questionenc + "&answer=" + encodeURI(answer) + "&userid=" + userid + "&category=" + btnclass;
			window.open("tables.php?"+param,"_self");
		}
		
	}	
	function deletequestion(question,category,userid){
		var questionenc = encodeURI(question);
		var param = "question=" + questionenc + "&userid=" + userid + "&category=" + category + "&delete=1";
		//window.location="https://google.com";
		window.open("tables.php?"+param,"_self");
	}
	function editquestion(counter,counter2,counter3,oldanswer,oldcategory,oldquestion){
		var question = $("."+counter).val();
		var answer = $("."+	counter3).val();
		var category = $("."+	counter2).val();
		var questionenc = encodeURI(question);
		var answerenc = encodeURI(answer);
		var param = "question=" + questionenc + "&answer=" + answerenc + "&category	=" + category + "&edit=1" + "&oldquestion=" + oldquestion + "&oldanswer=" + oldanswer + "&oldcategory=" + oldcategory;
		mywind = window.open("tables.php?"+param,"_self");
	}
	function create(){
		var question = $("#c1").val();
		var category = $("#c2").val();
		var answer = $("#c3").val();
		var questionenc = encodeURI(question);
		var answerenc = encodeURI(answer);
		var param = "question=" + questionenc + "&answer=" + answerenc + "&category=" + category + "&create=1";
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
				
                <tbody><!--                   <tr>                     <td>Tiger Nixon</td>                     <td>System Architect</td>                     <td>Edinburgh</td>                     <td>61</td>                     <td>2011/04/25</td>                     <td>$320,800</td>                   </tr>                   <tr>                     <td>Garrett Winters</td>                     <td>Accountant</td>                     <td>Tokyo</td>                     <td>63</td>                     <td>2011/07/25</td>                     <td>$170,750</td>                   </tr>                   <tr>                     <td>Ashton Cox</td>                     <td>Junior Technical Author</td>                     <td>San Francisco</td>                     <td>66</td>                     <td>2009/01/12</td>                     <td>$86,000</td>                   </tr>                   <tr>                     <td>Cedric Kelly</td>                     <td>Senior Javascript Developer</td>                     <td>Edinburgh</td>                     <td>22</td>                     <td>2012/03/29</td>                     <td>$433,060</td>                   </tr>                   <tr>                     <td>Airi Satou</td>                     <td>Accountant</td>                     <td>Tokyo</td>                     <td>33</td>                     <td>2008/11/28</td>                     <td>$162,700</td>                   </tr>                   <tr>                     <td>Brielle Williamson</td>                     <td>Integration Specialist</td>                     <td>New York</td>                     <td>61</td>                     <td>2012/12/02</td>                     <td>$372,000</td>                   </tr>                   <tr>                     <td>Herrod Chandler</td>                     <td>Sales Assistant</td>                     <td>San Francisco</td>                     <td>59</td>                     <td>2012/08/06</td>                     <td>$137,500</td>                   </tr>                   <tr>                     <td>Rhona Davidson</td>                     <td>Integration Specialist</td>                     <td>Tokyo</td>                     <td>55</td>                     <td>2010/10/14</td>                     <td>$327,900</td>                   </tr>                   <tr>                     <td>Colleen Hurst</td>                     <td>Javascript Developer</td>                     <td>San Francisco</td>                     <td>39</td>                     <td>2009/09/15</td>                     <td>$205,500</td>                   </tr>                   <tr>                     <td>Sonya Frost</td>                     <td>Software Engineer</td>                     <td>Edinburgh</td>                     <td>23</td>                     <td>2008/12/13</td>                     <td>$103,600</td>                   </tr>                   <tr>                     <td>Jena Gaines</td>                     <td>Office Manager</td>                     <td>London</td>                     <td>30</td>                     <td>2008/12/19</td>                     <td>$90,560</td>                   </tr>                   <tr>                     <td>Quinn Flynn</td>                     <td>Support Lead</td>                     <td>Edinburgh</td>                     <td>22</td>                     <td>2013/03/03</td>                     <td>$342,000</td>                   </tr>                   <tr>                     <td>Charde Marshall</td>                     <td>Regional Director</td>                     <td>San Francisco</td>                     <td>36</td>                     <td>2008/10/16</td>                     <td>$470,600</td>                   </tr>                   <tr>                     <td>Haley Kennedy</td>                     <td>Senior Marketing Designer</td>                     <td>London</td>                     <td>43</td>                     <td>2012/12/18</td>                     <td>$313,500</td>                   </tr>                   <tr>                     <td>Tatyana Fitzpatrick</td>                     <td>Regional Director</td>                     <td>London</td>                     <td>19</td>                     <td>2010/03/17</td>                     <td>$385,750</td>                   </tr>                   <tr>                     <td>Michael Silva</td>                     <td>Marketing Designer</td>                     <td>London</td>                     <td>66</td>                     <td>2012/11/27</td>                     <td>$198,500</td>                   </tr>                   <tr>                     <td>Paul Byrd</td>                     <td>Chief Financial Officer (CFO)</td>                     <td>New York</td>                     <td>64</td>                     <td>2010/06/09</td>                     <td>$725,000</td>                   </tr>                   <tr>                     <td>Gloria Little</td>                     <td>Systems Administrator</td>                     <td>New York</td>                     <td>59</td>                     <td>2009/04/10</td>                     <td>$237,500</td>                   </tr>                   <tr>                     <td>Bradley Greer</td>                     <td>Software Engineer</td>                     <td>London</td>                     <td>41</td>                     <td>2012/10/13</td>                     <td>$132,000</td>                   </tr>                   <tr>                     <td>Dai Rios</td>                     <td>Personnel Lead</td>                     <td>Edinburgh</td>                     <td>35</td>                     <td>2012/09/26</td>                     <td>$217,500</td>                   </tr>                   <tr>                     <td>Jenette Caldwell</td>                     <td>Development Lead</td>                     <td>New York</td>                     <td>30</td>                     <td>2011/09/03</td>                     <td>$345,000</td>                   </tr>                   <tr>                     <td>Yuri Berry</td>                     <td>Chief Marketing Officer (CMO)</td>                     <td>New York</td>                     <td>40</td>                     <td>2009/06/25</td>                     <td>$675,000</td>                   </tr>                   <tr>                     <td>Caesar Vance</td>                     <td>Pre-Sales Support</td>                     <td>New York</td>                     <td>21</td>                     <td>2011/12/12</td>                     <td>$106,450</td>                   </tr>                   <tr>                     <td>Doris Wilder</td>                     <td>Sales Assistant</td>                     <td>Sidney</td>                     <td>23</td>                     <td>2010/09/20</td>                     <td>$85,600</td>                   </tr>                   <tr>                     <td>Angelica Ramos</td>                     <td>Chief Executive Officer (CEO)</td>                     <td>London</td>                     <td>47</td>                     <td>2009/10/09</td>                     <td>$1,200,000</td>                   </tr>                   <tr>                     <td>Gavin Joyce</td>                     <td>Developer</td>                     <td>Edinburgh</td>                     <td>42</td>                     <td>2010/12/22</td>                     <td>$92,575</td>                   </tr>                   <tr>                     <td>Jennifer Chang</td>                     <td>Regional Director</td>                     <td>Singapore</td>                     <td>28</td>                     <td>2010/11/14</td>                     <td>$357,650</td>                   </tr>                   <tr>                     <td>Brenden Wagner</td>                     <td>Software Engineer</td>                     <td>San Francisco</td>                     <td>28</td>                     <td>2011/06/07</td>                     <td>$206,850</td>                   </tr>                   <tr>                     <td>Fiona Green</td>                     <td>Chief Operating Officer (COO)</td>                     <td>San Francisco</td>                     <td>48</td>                     <td>2010/03/11</td>                     <td>$850,000</td>                   </tr>                   <tr>                     <td>Shou Itou</td>                     <td>Regional Marketing</td>                     <td>Tokyo</td>                     <td>20</td>                     <td>2011/08/14</td>                     <td>$163,000</td>                   </tr>                   <tr>                     <td>Michelle House</td>                     <td>Integration Specialist</td>                     <td>Sidney</td>                     <td>37</td>                     <td>2011/06/02</td>                     <td>$95,400</td>                   </tr>                   <tr>                     <td>Suki Burks</td>                     <td>Developer</td>                     <td>London</td>                     <td>53</td>                     <td>2009/10/22</td>                     <td>$114,500</td>                   </tr>                   <tr>                     <td>Prescott Bartlett</td>                     <td>Technical Author</td>                     <td>London</td>                     <td>27</td>                     <td>2011/05/07</td>                     <td>$145,000</td>                   </tr>                   <tr>                     <td>Gavin Cortez</td>                     <td>Team Leader</td>                     <td>San Francisco</td>                     <td>22</td>                     <td>2008/10/26</td>                     <td>$235,500</td>                   </tr>                   <tr>                     <td>Martena Mccray</td>                     <td>Post-Sales support</td>                     <td>Edinburgh</td>                     <td>46</td>                     <td>2011/03/09</td>                     <td>$324,050</td>                   </tr>                   <tr>                     <td>Unity Butler</td>                     <td>Marketing Designer</td>                     <td>San Francisco</td>                     <td>47</td>                     <td>2009/12/09</td>                     <td>$85,675</td>                   </tr>                   <tr>                     <td>Howard Hatfield</td>                     <td>Office Manager</td>                     <td>San Francisco</td>                     <td>51</td>                     <td>2008/12/16</td>                     <td>$164,500</td>                   </tr>                   <tr>                     <td>Hope Fuentes</td>                     <td>Secretary</td>                     <td>San Francisco</td>                     <td>41</td>                     <td>2010/02/12</td>                     <td>$109,850</td>                   </tr>                   <tr>                     <td>Vivian Harrell</td>                     <td>Financial Controller</td>                     <td>San Francisco</td>                     <td>62</td>                     <td>2009/02/14</td>                     <td>$452,500</td>                   </tr>                   <tr>                     <td>Timothy Mooney</td>                     <td>Office Manager</td>                     <td>London</td>                     <td>37</td>                     <td>2008/12/11</td>                     <td>$136,200</td>                   </tr>                   <tr>                     <td>Jackson Bradshaw</td>                     <td>Director</td>                     <td>New York</td>                     <td>65</td>                     <td>2008/09/26</td>                     <td>$645,750</td>                   </tr>                   <tr>                     <td>Olivia Liang</td>                     <td>Support Engineer</td>                     <td>Singapore</td>                     <td>64</td>                     <td>2011/02/03</td>                     <td>$234,500</td>                   </tr>                   <tr>                     <td>Bruno Nash</td>                     <td>Software Engineer</td>                     <td>London</td>                     <td>38</td>                     <td>2011/05/03</td>                     <td>$163,500</td>                   </tr>                   <tr>                     <td>Sakura Yamamoto</td>                     <td>Support Engineer</td>                     <td>Tokyo</td>                     <td>37</td>                     <td>2009/08/19</td>                     <td>$139,575</td>                   </tr>                   <tr>                     <td>Thor Walton</td>                     <td>Developer</td>                     <td>New York</td>                     <td>61</td>                     <td>2013/08/11</td>                     <td>$98,540</td>                   </tr>                   <tr>                     <td>Finn Camacho</td>                     <td>Support Engineer</td>                     <td>San Francisco</td>                     <td>47</td>                     <td>2009/07/07</td>                     <td>$87,500</td>                   </tr>                   <tr>                     <td>Serge Baldwin</td>                     <td>Data Coordinator</td>                     <td>Singapore</td>                     <td>64</td>                     <td>2012/04/09</td>                     <td>$138,575</td>                   </tr>                   <tr>                     <td>Zenaida Frank</td>                     <td>Software Engineer</td>                     <td>New York</td>                     <td>63</td>                     <td>2010/01/04</td>                     <td>$125,250</td>                   </tr>                   <tr>                     <td>Zorita Serrano</td>                     <td>Software Engineer</td>                     <td>San Francisco</td>                     <td>56</td>                     <td>2012/06/01</td>                     <td>$115,000</td>                   </tr>                   <tr>                     <td>Jennifer Acosta</td>                     <td>Junior Javascript Developer</td>                     <td>Edinburgh</td>                     <td>43</td>                     <td>2013/02/01</td>                     <td>$75,650</td>                   </tr>                   <tr>                     <td>Cara Stevens</td>                     <td>Sales Assistant</td>                     <td>New York</td>                     <td>46</td>                     <td>2011/12/06</td>                     <td>$145,600</td>                   </tr>                   <tr>                     <td>Hermione Butler</td>                     <td>Regional Director</td>                     <td>London</td>                     <td>47</td>                     <td>2011/03/21</td>                     <td>$356,250</td>                   </tr>                   <tr>                     <td>Lael Greer</td>                     <td>Systems Administrator</td>                     <td>London</td>                     <td>21</td>                     <td>2009/02/27</td>                     <td>$103,500</td>                   </tr>                   <tr>                     <td>Jonas Alexander</td>                     <td>Developer</td>                     <td>San Francisco</td>                     <td>30</td>                     <td>2010/07/14</td>                     <td>$86,500</td>                   </tr>                   <tr>                     <td>Shad Decker</td>                     <td>Regional Director</td>                     <td>Edinburgh</td>                     <td>51</td>                     <td>2008/11/13</td>                     <td>$183,000</td>                   </tr>                   <tr>                     <td>Michael Bruce</td>                     <td>Javascript Developer</td>                     <td>Singapore</td>                     <td>29</td>                     <td>2011/06/27</td>                     <td>$183,000</td>                   </tr>                   <tr>                     <td>Donna Snider</td>                     <td>Customer Support</td>                     <td>New York</td>                     <td>27</td>                     <td>2011/01/25</td>                     <td>$112,000</td>                   </tr>!-->
        <?php     
	$counter2 = 100;
	$counter3 = 200;
	foreach ($conn->query($sql2) as $item	){
		echo "<tr> 	";	
		echo "<td>";
		echo "<textarea style='float:left;' class='form-control' class='".$counter."' type ='text' >".$item['question']."</textarea>";
		echo "</td>";
		echo "<td>";
		echo "<textarea style='float:left;' class='form-control' class='".$counter2."' type ='text'>".$item['name']."</textarea>";
		echo "</td>";
		echo "<td>";
		echo "<textarea style='float:left;' class='form-control' class='".$counter3."' type ='text' >".$item['answer']."</textarea>";
		echo "</td>";
		echo "<td>";
		echo $item['helpful'];
		echo "</td>";
		echo "<td>";
		echo $item['nothelpful'];
		echo "</td>";
		echo "<td>";
		$onclickparamdelete = "deletequestion('".$item['question']."','".$item['name']."','".$item['userid']."')";
		$onclickparamedit = "editquestion('".$counter."','".$counter2."','".$counter3."','".$item['answer']."','".$item['name']."','".$item['question']."')";
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
	echo "<table style=''>";
	echo "<tr> 	";	
	echo "<td style='margin-right:25px'>";
	echo "<input placeholder='Question' style='float:left;' class='form-control' id='c1' type ='text' value=''>";
	echo "</td>";
	echo "<td>";
	echo "<input placeholder='Answer' style='float:left;' class='form-control' id='c2' type ='text' value=''>";
	echo "</td>";
	echo "<td>";
	echo "<input placeholder='Category' id='c3' style='float:left;' class='form-control' type ='text' value=''>";
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
