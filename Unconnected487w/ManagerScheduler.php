<?php
require 'query.php';
if (!session_id()) session_start();
if (!$_SESSION['manager']){
    //header("Location:/");
    //die();
}
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>McDowells, home of the burger</title>
    <!-- Button for log in & header -->
    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <style>
        body{
            background-image: url("http://487wbool.adversary.gg/pictures/mcdowells-coming-to-america-fa.png");
            background-size: cover;
        }
        .navbar-custom {
            background-color: rgb(253 199 60);
            border-bottom: 4px solid;
            border-bottom-color: black;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-custom">
    <div class="col-1">
        <img src="http://487wbool.adversary.gg/pictures/mcdowells--home-of-the-big-mic.png" alt="mcdowells--home-of-the-big-mic@2x.png" onclick="location.href='http://487wbool.adversary.gg/'">
    </div>
    <div class ="col">
        <a href="http://487wbool.adversary.gg/employee.php"><button id="scheduleRequestsButton" class="btn btn-outline-dark btn-lg">Home</button></a>
    </div>
    <div class="col-sm-1">
        <button onclick=logout_button() id="logOutButton" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#calendarModel">LogOut </button>
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
      <label for="employee">Choose an employee</label>
      <select name="employee" id="employee" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
      <?php
        $employees = getEmployees();
        foreach($employees as $employee){
            echo "<option>{$employee['employee_id']} : {$employee['first_name']} {$employee['last_name']}</option>";
        }
      ?>
      </select>
<table class="table">
      <thead>
        <tr>
          <th scope="col">Employee Schedule</th>
          <th scope="col">Start Time</th>
          <th scope="col">End Time</th>
          <th scope="col">Location</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">
          <div class="bootstrap-iso">
           <div class="container-fluid">
            <div class="row">
             <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- Form code begins -->
              <form method="post">
                <div class="form-group"> <!-- Date input -->
                  <label class="control-label" for="date">Date</label>
                  <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                </div>
                <div class="form-group"> <!-- Submit button -->
                  <button class="btn btn-primary " name="submit" type="submit" onclick="create_new_schedule()">Submit</button>
                </div>
               </form>
               <!-- Form code ends -->

              </div>
            </div>
           </div>
          </div>
          <script>
              $(document).ready(function(){
                var date_input=$('input[name="date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                  format: 'mm/dd/yyyy',
                  container: container,
                  todayHighlight: true,
                  autoclose: true,
                };
                date_input.datepicker(options);
              })
          </script>
          </th>
          <td ><input id="start"></input></td>
          <td ><input id="end"></input></th>
          <td>
              <select id="location">
              <?php
                 $stores = storeSelectAll();
                 foreach($stores as $store){
                      echo "<option>{$store['store_id']} : {$store['store_location']}</option>";
                   }
                 ?>
          </th>
        </tr>
      </tbody>
    </table>
</div>
<script>
    function create_new_schedule() {
        let employee_id = $("#employee").val().split(" : ");
        let store_id =  $("#location").val().split(" : ");
        let start_time = $("#start").val();
        let stop_time = $("#end").val();
        let work_day = $("#date").val();

        work_day_arr = work_day.split('/');
        work_day_formatted = work_day_arr[2] + '-' + work_day_arr[1] + '-' + work_day_arr[0];
        $.get(
            "http://487wbool.adversary.gg/query",
            { schedule_insert: "true", employee_id : employee_id[0], store_id : store_id[0], start_time : start_time, stop_time : stop_time, work_day: work_day_formatted, position : "E"},
            function(response) { console.log(response); });
    }
</script>
</body>

</html>
