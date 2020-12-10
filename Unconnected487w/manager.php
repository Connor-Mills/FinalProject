<?php
require "connect.php";
if (!session_id()) session_start();
if (!$_SESSION['manager']){
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
	<title>Manager Home Screen</title>
	<style id="applicationStylesheet" type="text/css">
		body{
			background-image: url("http://487wbool.adversary.gg/pictures/mcdowells-coming-to-america-fa.png");
			background-size: cover;
		}
		.navbar-custom {
			background-color: rgb(253 199 60);

			border-bottom-color: black;
		}
		.center{
		    float:left;
		    padding: 5px;
		}
		.disabled {
			margin: auto;
			width: 50%;

			padding: 10px;

		}
		.dropbtn {
          background-color: #4CAF50;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }

        .dropdown {
          position: relative;
          display: block;
        }

        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
          display: block;
        }

        .dropdown:hover .dropbtn {
          background-color: #3e8e41;
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
    		<h1 id="welcome"><?php
            				  echo '<script "type=text/javascript">',
                        'get_name_by_id('.substr($_COOKIE['auth_level'], 1).');',
                        '</script>!';
            				 ?></h1>
            				 </div>
	<div class ="col">
	<div class="center">
	    <div class="dropdown">

		    <button id="scheduleRequestsButton" class="btn btn-outline-dark btn-lg">Scheduling Requests</button>
            <div class ="dropdown-content" style= "background-color:Transparent;">
            <button type="button" class="btn btn-outline-dark btn-lg" id="submitBtn" data-toggle="modal" data-target="#req_time_off" style= "background-color:#FDC73C;width: 215px;">Time Off</button>
            <button type="button" class="btn btn-outline-dark btn-lg" id="submitBtn" data-toggle="modal" data-target="#req_sched"  style= "background-color:#FDC73C;width: 215px;">Change Availability</button>
            <button type="button" class="btn btn-outline-dark btn-lg" id="submitBtn" data-toggle="modal" data-target="#req_location"  style= "background-color:#FDC73C;width: 215px;">Location Change</button>
            </div>
		</div>
		</div>
		<div class="center">
		<a href="http://487wbool.adversary.gg/schedule.php"><button id="calendarButton" class="btn btn-outline-dark btn-lg">Calendar</button></a>
		</div>
		<div class="center">
		<button id="changePassword" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#myPassword">Change Password</button>
        <a href="http://487wbool.adversary.gg/schedulingrequests.php"><button id="ScheduleRequestsButton" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#ScheduleRequestsModel">Employee Scheduling Requests</button></a>
        <a href="http://487wbool.adversary.gg/customercomments.php"><button id="inboxButton" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#inboxModel">Customer Feedback </button></a>
        <button id="addEmployee" class="btn btn-outline-dark btn-lg" onclick="location.href='http://487wbool.adversary.gg/add%20employee'">Add Employee</button>
        <button id="ScheduleEmployees" class="btn btn-outline-dark btn-lg" onclick="location.href='http://487wbool.adversary.gg/ManagerScheduler.php'">Schedule Employees</button>

		</div>

		<div class="modal fade" id="myUsername" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Enter your credentials  </h3>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="oldu">Old Username:</label>
							<input type="text" class="form-control" id="oldu" name="username">
						</div>
						<div class="form-group">
							<label for="newu">new Username:</label>
							<input type="password" class="form-control" id="newu" name="password">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="newUsername" onclick="password_click()">Change Username </button>
						<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
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
<div class="container-fluid">
	<div class="row">
		<div class ="col-10">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-10">
                                <div>
                                    <form>
                                            <div class="modal fade" id="req_time_off" role="dialog">
                                              <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h3 class="modal-title">Request Time Off</h3>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="inputDisabledEx3" class="disabled" >Start Date:</label>
                                                        <input type="text" id="birthdate" class="form-control" placeholder="Start Date (YYYY-MM-DD)" pattern="\d{4}-\d{1,2}-\d{1,2}">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="pwd">End Date:</label>
                                                      <input type="text" id="hiredate" class="form-control" placeholder="End Date (YYYY-MM-DD)" pattern="\d{4}-\d{1,2}-\d{1,2}">
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Submit</button>
                                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <br>

                                                <div class="modal fade" id="req_sched" role="dialog">
                                                  <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title">Request Availability Change</h3>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="Mon_Check">
                                                            <label class="form-check-label" for="Mon_Check">Monday</label>
                                                            <br>
                                                            <input type="radio" id="monday_radio_any" name="monday_radio" checked>
                                                            <label class="form-check-label" for="monday_radio_any"> Any Availability </label>
                                                            <br>
                                                            <input type="radio" id="monday_radio_time" name="monday_radio">
                                                            <label for="monday_radio_time">
                                                            <input type ="text" class="test" id="mon_time_start" class="form-control" placeholder="Start time" for="monday_radio_time">
                                                            <input type ="text" class="test" id="mon_time_end" class="form-control" placeholder="End time" for="monday_radio_time">
                                                            </label>
                                                            <br>

                                                        <input type="checkbox" class="form-check-input" id="Tues_Check">
                                                        <label class="form-check-label" for="Tues_Check">Tuesday</label>
                                                        <br>
                                                        <input type="radio" id="tuesday_radio" name="tuesday_radio" checked>
                                                        <label class="form-check-label" for="tuesday_radio"> Any Availability </label>
                                                        <br>
                                                        <input type="radio" id="tuesday_radio_time" name="tuesday_radio">
                                                        <label for="tuesday_radio_time">
                                                        <input type ="text" class="test" id="Tues_time_start" class="form-control" placeholder="Start time">
                                                        <input type ="text" class="test" id="Tues_time_end" class="form-control" placeholder="End time">
                                                        </label>
                                                        <br>


                                                        <input type="checkbox" class="form-check-input" id="Wed_Check">
                                                        <label class="form-check-label" for="Wed_Check">Wednesday</label>
                                                        <br>
                                                        <input type="radio" id="wednesday_radio" name="wednesday_radio" checked>
                                                        <label class="form-check-label" for="wednesday_radio" > Any Availability </label>
                                                        <br>
                                                        <input type="radio" id="wednesday_radio_time" name="wednesday_radio">
                                                        <label for="wednesday_radio_time">
                                                        <input type ="text" class="test" id="Wed_time_start" class="form-control" placeholder="Start time">
                                                        <input type ="text" class="test" id="Wed_time_end" class="form-control" placeholder="End time">
                                                        </label>
                                                        <br>

                                                        <input type="checkbox" class="form-check-input" id="Thur_Check">
                                                        <label class="form-check-label" for="Thur_Check">Thursday</label>
                                                        <br>
                                                        <input type="radio" id="thursday_radio" name="thursday_radio" checked>
                                                        <label class="form-check-label" for="thursday_radio" > Any Availability </label>
                                                        <br>
                                                        <input type="radio" id="thursday_radio_time" name="thursday_radio">
                                                        <label for="thursday_radio_time">
                                                        <input type ="text" class="test" id="Thurs_time_start" class="form-control" placeholder="Start time">
                                                        <input type ="text" class="test" id="Thurs_time_end" class="form-control" placeholder="End time">
                                                        </label>
                                                        <br>

                                                        <input type="checkbox" class="form-check-input" id="Fri_Check">
                                                        <label class="form-check-label" for="Fri_Check">Friday</label>
                                                        <br>
                                                        <input type="radio" id="friday_radio" name="friday_radio" checked>
                                                        <label class="form-check-label" for="friday_radio" > Any Availability </label>
                                                        <br>
                                                        <input type="radio" id="friday_radio_time" name="friday_radio">
                                                        <label for="friday_radio_time">
                                                        <input type ="text" class="test" id="Fri_time_start" class="form-control" placeholder="Start time">
                                                        <input type ="text" class="test" id="Fri_time_end" class="form-control" placeholder="End time">
                                                        </label>
                                                        <br>

                                                        <input type="checkbox" class="form-check-input" id="Sat_Check">
                                                        <label class="form-check-label" for="Sat_Check">Saturday</label>
                                                        <br>
                                                        <input type="radio" id="saturday_radio" name="saturday_radio" checked>
                                                        <label class="form-check-label" for="saturday_radio" > Any Availability </label>
                                                        <br>
                                                        <input type="radio" id="saturday_radio_time" name="saturday_radio">
                                                        <label for="saturday_radio_time">
                                                        <input type ="text" class="test" id="Sat_time_start" class="form-control" placeholder="Start time">
                                                        <input type ="text" class="test" id="Sat_time_end" class="form-control" placeholder="End time">
                                                        </label>
                                                        <br>

                                                        <input type="checkbox" class="form-check-input" id="Sun_Check">
                                                        <label class="form-check-label" for="Sun_Check">Sunday</label>
                                                        <br>
                                                        <input type="radio" id="sunday_radio" name="sunday_radio" checked>
                                                        <label class="form-check-label" for="sunday_radio" > Any Availability </label>
                                                        <br>
                                                        <input type="radio" id="sunday_radio_time" name="sunday_radio">
                                                        <label for="sunday_radio_time">
                                                        <input type ="text" class="test" id="Sun_time_start" class="form-control" placeholder="Start time">
                                                        <input type ="text" class="test" id="Sun_time_end" class="form-control" placeholder="End time">
                                                        </label>
                                                        </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-dark" id="req_submit" data-dismiss="modal">Submit</button>
                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <br>

                                                    <div class="modal fade" id="req_location" role="dialog">
                                                      <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h3 class="modal-title">Request Location Change</h3>
                                                          </div>
                                                          <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="radio" id="location_radio_washington" name="sunday_radio">
                                                                <label class="form-check-label" for="location_radio_washington" > Washington Street </label>
                                                            </div>

                                                            <div class="form-group">
                                                              <input type="radio" id="location_radio_main" name="sunday_radio">
                                                              <label class="form-check-label" for="location_radio_main" > Main Street</label>
                                                            </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-dark" onclick = "updateLocation" data-dismiss="modal">Submit</button>
                                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                    </form>
                                </div>
                            </div>
			</div>
		<div class="col-1"></div>
	</div>
</div>
<script>
    function password_click() {
        let username = $("#usr").val();
        let password = $("#newp").val();

        $.get(
          "http://487wbool.adversary.gg/query",
          { password_update: "true", username: username, password: password}, // args dictionary, e.g. { arg1: value1, arg2: value2 }
          function(response) { console.log(response); }
        )

    }

    //function for updating availability
     function request_click() {
            let employee_id = 1;//$_COOKIE['auth_level'];
            let mondaytime = $("#mon_time_start").val() + "-" + $("#mon_time_end").val();
            let tuesdaytime = $("#Tues_time_start").val() + "-" + $("#Tues_time_end").val();
            let wednesdaytime = $("#Wed_time_start").val() + "-" + $("#Wed_time_end").val();
            let thursdaytime = $("#Thurs_time_start").val() + "-" + $("#Thurs_time_end").val();
            let fridaytime = $("#Fri_time_start").val() + "-"+ $("#Fri_time_end").val();
            let saturdaytime = $("#Sat_time_start").val() + "-" + $("#Sat_time_end").val();
            let sundaytime = $("#Sun_time_start").val() + "-" + $("#Sun_time_end").val();
            console.log(mondaytime);

            $.get(
                      "http://487wbool.adversary.gg/query",
                      { availability_update: "true", employee_id: employee_id, monday:mondaytime, tuesday:tuesdaytime , wednesday:wednesdaytime, thursday:thursdaytime, friday:fridaytime saturday:saturdaytime, sunday:sundaytime}, // args dictionary, e.g. { arg1: value1, arg2: value2 }
                      function(response) { console.log(response); }
                    );

            }

     $(document).on('click', '#req_submit', request_click);

        function insertLocation(){
        let location = 1;//something
        let employee_id = 1;//$_COOKIE['auth_level']
        $.get(
          "http://487wbool.adversary.gg/query",
          { locationrequest_insert: "true", employee_id: employee_id, location: location}, // args dictionary, e.g. { arg1: value1, arg2: value2 }
          function(response) { console.log(response); }
        );
        }
</script>
</body>
