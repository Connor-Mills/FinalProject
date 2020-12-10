<?php
require "connect.php";
if (!session_id()) session_start();
if (!$_SESSION['regmanager']){
    header("Location:/");
    die();
}
?>

<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Employee Home Screen</title>
	<style id="applicationStylesheet" type="text/css">
		body{
			background-image: url("http://487wbool.adversary.gg/pictures/mcdowells-coming-to-america-fa.png");
			background-size: cover;
		}
		.navbar-custom {
			background-color: rgb(253 199 60);

			border-bottom-color: black;
		}
		.disabled {
			margin: auto;
			width: 50%;

			padding: 10px;

		}
        .container-fluid{
        background-color: rgb(211,211,211);
        }
		table {
		text-align: center;
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        color: black;
        background-color: Grey;
         }
        td, th {
         border: 1px solid #dddddd;
         text-align: left;
         padding: 8px;
         }




	</style>
</head>

<script>
  async function get_name_by_id(user_id) {
  var name = await $.get(
      "http://487wbool.adversary.gg/login",
      { get_name_by_id: "true", id: user_id },

      function(response) {
        return JSON.parse(response);
      }
    ).promise().then(name => document.getElementById("welcome").innerHTML = "Welcome " + JSON.parse(name).first_name + '!');
  }
</script>

<body>
<nav class="navbar navbar-custom">
	<div class="col-1">
		<a href="http://487wbool.adversary.gg/"><img src="http://487wbool.adversary.gg/pictures/mcdowells--home-of-the-big-mic.png" alt="mcdowells--home-of-the-big-mic@2x.png"></a>
	</div>
	<div class="center">
    <h1 id="welcome">
    <?php
      echo '<script "type=text/javascript">',
      'get_name_by_id('.substr($_COOKIE['auth_level'], 1).');',
      '</script>!';
     ?>
     </h1>
     </div>
     <div class="col-sm-1">
            <button id="scheduleManagers" class="btn btn-outline-dark btn-lg" data-toggle="modal" onclick="location.href='http://487wbool.adversary.gg/RegManagerScheduler.php'" >Schedule Managers</button>
     </div>
	<div class="col-sm-1">
		<button onclick=logout_button() id="logOutButton" class="btn btn-outline-dark btn-lg" data-toggle="modal"
				data-target="#calendarModel">LogOut
		</button>
		<script>
			function logout_button() {
				document.cookie = "auth_level =; Path=/; Expires Thu, 01 Jan 1970 00:00:01 GMT;";
				document.cookie = "PHPSESSID =; Path=/; Expires Thu, 01 Jan 1970 00:00:01 GMT;";
				location.reload();
			}
		</script>
	</div>

</nav>

<div class="container-xl bg-white">
    <h2> Employees: </h2>
        <table class="table-dark">
        <thead>
            <tr>
            <th scope="col">Employee First Name</th>
            <th scope="col">Employee Last Name</th>
            <th scope="col">Employee ID </th>
            </tr>
        </thead>

        <tbody>


      <?php
        $sql = "SELECT employee_id, first_name, last_name FROM employees";
        $result = $conn->query($sql);
        $test = array();
        while ($row = $result->fetch_assoc())
        {
        array_push($test, $row);
        }

         foreach($test as $employee) { ?>
         <tr>
             <td>
               <?php echo $employee['first_name']; ?>
             </td>
             <td>
               <?php echo $employee['last_name']; ?>
             </td>
             <td>
               <?php echo $employee['employee_id']; ?>
             </td>

             </tr>
             <?php
             }
         ?>
        </tbody>


        </table>
    </div>
<div class="container-xl bg-white">
        <h2> Store Location: </h2>
            <table class="table-dark">
                 <thead>
                      <tr>
                      <th scope="col">Location</th>
                     </tr>
                 </thead>


                <tbody>
                <?php
                        $sql = "SELECT store_location FROM store";
                        $result = $conn->query($sql);
                        $test = array();
                        while ($row = $result->fetch_assoc())
                        {
                        array_push($test, $row);
                        }

                         foreach($test as $employee) { ?>
                         <tr>
                             <td>
                               <?php echo $employee['store_location']; ?>
                             </td>

                             </tr>
                             <?php
                             }
                         ?>
                        </tbody>
                        </table>
                        <button type="button" class="btn btn-outline-dark btn-lg" id="submitBtn" data-toggle="modal" data-target="#req_time_off" style= "background-color: #D3D3D3;">Enter a new store location</button>
     </div>

            <div class="modal fade" id="req_time_off" role="dialog">
             <div class="modal-dialog">
              <!-- Modal content-->
               <div class="modal-content">
               <div class="modal-header">
               <h3 class="modal-title">New Location</h3>
                 </div>
                      <div class="modal-body">
                        <div class="form-group">
                           <label>Address:</label>
                              <input type="text"  id="Address" class="form-control" placeholder="Address" >
                         </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal" onclick="create_new_location()">Submit</button>
                         <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                     </div>
                 </div>
                </div>
               </div>
</div>
<script>
    function create_new_location() {

        let address = $("#Address").val();
        console.log(address)
        $.get(
            "http://487wbool.adversary.gg/query",
            { store_insert: "true", store_location: address},
            function(response) { console.log(response); });
    }
</script>
</body>
</html>