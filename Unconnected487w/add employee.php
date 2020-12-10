<?php
if (!session_id()) session_start();
if (!$_SESSION['manager']){
    header("Location:/");
    die();
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
    <title>Management Account Creation</title>
    <!-- Button for log in & header -->
    <style>
        body {
            background-image: url("http://487wbool.adversary.gg/pictures/mcdowells-coming-to-america-fa.png");
            background-size: cover;
        }

        .navbar-custom {
            background-color: rgb(253 199 60);
            border-bottom: 4px solid;
            border-bottom-color: black;
        }

        .disabled {
            margin: auto;
            width: 50%;

            padding: 10px;

        }

        .btn1 {
            text-align: center;
            margin-top: 100px;
            border: 1px solid;
            background-color: white;
            color: black;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-custom">
    <div class="col-1">
        <img src="http://487wbool.adversary.gg/pictures/mcdowells--home-of-the-big-mic.png"
             alt="mcdowells--home-of-the-big-mic@2x.png"
             onclick="location.href='http://487wbool.adversary.gg/'"
             onmouseover=""
             style="cursor: pointer;"
             >
    </div>
    <div class="col">
        <a href="http://487wbool.adversary.gg/"><button id="scheduleRequestsButton" class="btn btn-outline-dark btn-lg">Manager Home</button></a>

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
        <div class="col-1"></div>
        <div class="col-10">
            <div class="bg-white">
                <form>
                    <label for="inputDisabledEx2" class="disabled">Employee First Name:</label>
                    <input type="text" id="fname" class="form-control" placeholder="First Name">

                    <label for="inputDisabledEx3" class="disabled">Employee Last Name:</label>
                    <input type="text" id="lname" class="form-control" placeholder="Last Name">

                     <label for="inputDisabledEx3" class="disabled" >Store Number:</label>
                     <input type="text" id="storeid" class="form-control" placeholder="Store Number">

                    <label for="inputDisabledEx3" class="disabled" >Employee Birth Date:</label>
                    <input type="text" id="birthdate" class="form-control" placeholder="Birth Date (YYYY-MM-DD)" pattern="\d{4}-\d{1,2}-\d{1,2}">

                    <label for="inputDisabledEx3" class="disabled" >Employee Hire Date:</label>
                    <input type="text" id="hiredate" class="form-control" placeholder="Birth Date (YYYY-MM-DD)" pattern="\d{4}-\d{1,2}-\d{1,2}">

                    <br>
                    <h4>Administrative Section:</h4>
                    <h7>*Username Format is: FirstnameLastname</h7>
                    <br>
                    <h7>*Password Format is: admin12! </h7>
                    <br>
                    <br>

                    <label for="inputDisabledEx5" class="disabled">Employee Username:</label>
                    <input type="text" id="username" class="form-control" placeholder="Employee Username">

                    <label for="inputDisabledEx6" class="disabled">Employee Password:</label>
                    <input type="password" id="password" class="form-control" placeholder="Password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
                    <small id="passwordSub" class="form-text text-muted">Password must be minimum 8 characters, at least one, letter, and one special character(@$!%*#?&)</small>

                    <br>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="ManagerCheckBox" onchange="document.getElementById('ManagerAccountCreateBtn').disabled = !this.checked;">
                        <label class="form-check-label" for="ManagerCheckBox">I have read and agree to McDowells Terms &
                            Conditions</label>
                    </div>
                    <button type="button" class="btn btn-primary" id="ManagerAccountCreateBtn" onclick="create_new_account_click()" disabled>Create New Employee</button>
                </form>
                <script>
                    function create_new_account_click() {
                        let fname = $("#fname").val();
                        let lname = $("#lname").val();
                        let store_id = $("#storeid").val();
                        let birthDate = $("#birthdate").val();
                        let hireDate = $("#hiredate").val();
                        let employeeUsername = $("#username").val();
                        let employeePassword = $("#password").val();

                        $.get(
                          "http://487wbool.adversary.gg/query",
                          { employee_insert: "true", first_name: fname, last_name: lname, birth_date: birthDate, position: 'E', hire_date: hireDate, store: store_id }, // args dictionary, e.g. { arg1: value1, arg2: value2 }
                          function(response) { console.log(response); }
                        )

                    }
                </script>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>
</body>
</html>