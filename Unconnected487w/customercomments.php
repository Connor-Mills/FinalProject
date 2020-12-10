<?php
if (!session_id()) session_start();
require "connect.php";
//ini_set('display_errors', 1);
if (!$_SESSION['employee'] && !$_SESSION['manager']){
    header("Location:/");
    die();
}
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
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
	<title>Customer Comments</title>
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
	<div class ="col">
		<a href="http://487wbool.adversary.gg/employee.php"><button id="scheduleRequestsButton" class="btn btn-outline-dark btn-lg">Home</button></a>
		<div class="modal fade" id="myPassword" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Enter your credentials  </h3>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="usr">Username</label>
							<input type="text" class="form-control" id="usr" name="username">
						</div>
						<div class="form-group">
							<label for="oldp">Old Password:</label>
							<input type="text" class="form-control" id="oldp" name="password">
						</div>
						<div class="form-group">
							<label for="newp">New Password:</label>
							<input type="password" class="form-control" id="newp" name="password">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="newPassword" onclick="password_click()">Change Password</button>
						<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
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

<!-- test -->

<div class="container-xl bg-white" >
	<table class="table">
      <thead>
        <tr>
          <th scope="col">Comment ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Store ID</th>
          <th scope="col">Comments </th>

        </tr>
      </thead>
      <tbody>
<?php
  $id = substr($_COOKIE["auth_level"], 1);
  $sql = "SELECT * FROM customer_card";
  $result = $conn->query($sql);
  $schedule = array();
  while ($row = $result->fetch_assoc()) {
    array_push($schedule, $row);
  }
//  debug_to_console($schedule);

  foreach($schedule as $dat) { ?>
    <tr>
    <td>
        <?php echo $dat['comment_id'];?>
    </td>
    <td>
        <?php echo $dat['first_name']; ?>
    </td>
    <td>
        <?php echo $dat['last_name']; ?>
    </td>
    <td>
        <?php echo $dat['store_id']; ?>
    </td>
    <td>
        <?php echo $dat['comments']; ?>
     </td>
    </tr>
    <?php
  }
?>

      </tbody>
    </table>
</div>

<!-- test -->

</body>
</html>