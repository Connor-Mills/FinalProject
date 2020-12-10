<?php
  switch($_COOKIE["auth_level"][0]) {
    case 'M':
      if (!session_id())
      session_start();
      $_SESSION['manager'] = true;

      header('Location: http://487wbool.adversary.gg/manager', true, 301);
      exit();

      break;
    case 'E':
      if (!session_id())
      session_start();
      $_SESSION['employee'] = true;

      header('Location: http://487wbool.adversary.gg/employee', true, 301);
      exit();

      break;
    case 'R':
          if (!session_id())
          session_start();
          $_SESSION['regmanager'] = true;

          header('Location: http://487wbool.adversary.gg/regmanager', true, 301);
          exit();

          break;
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
  </style>
</head>
<body>
<nav class="navbar navbar-custom">
  <div class="col-1">
    <a href="http://487wbool.adversary.gg/"><img src="http://487wbool.adversary.gg/pictures/mcdowells--home-of-the-big-mic.png" alt="mcdowells--home-of-the-big-mic@2x.png"></a>
  </div>
  <h3>"Its not what your restaurant can do for you, <br/> It's what you can do for your restaurant" - Cleo G. McDowell (1968)</h3>
      <button id="feedbackButton" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#feedbackModal">Contact us!</button>
      <div class="modal fade" id="feedbackModal" role="dialog">
          <div class="modal-dialog">
              <div class = "modal-content">
                  <div class="modal-header">
                      <h3 class="modal-title">Contact us!</h3>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="name">Your Name</label>
                          <input type="text" class="form-control" id="customer_firstname" name="cust_name">
                      </div>
                      <div class="form-group">
                          <label for="email">Last Name</label>
                          <input type="text" class="form-control" id="customer_lastname" name="cust_last_name">
                      </div>
                      <div class="form-group">
                          <label for="feedback">Enter feedback</label>
                          <textarea rows="4" cols="50" id="customer_feedback" name="cust_email"></textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="contact_submit()"id="submit_feedback_button">Submit</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
  <div class ="col-1">
    <button id="LogInButton" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#myModal">Login</button>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Enter your credentials</h3>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="usr">Username:</label>
              <input type="text" class="form-control" id="usr" name="username">
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" id="pwd" name="password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="login_button" onclick="login_click()">Log In</button>
            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- /Modal -->
    </div>

</nav>
<script>

  // $(document).ready(function () {
  //     createCookie("height", $(window).height(), "10");
  // });

  function createCookie(name, value, days) {
      var expires;
      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
      }
      else {
          expires = "";
      }
      document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
  }

  function login_click() {
      let usr = $("#usr").val();
      let pwd = $("#pwd").val();
      $.get(
          "http://487wbool.adversary.gg/login",
          { login_check: "true", username: usr, password: pwd },
          function(response) {
              var user = JSON.parse(response);
              console.log(user)
              if (!user) return;

              createCookie("auth_level", user.type + user.employee_id, "1");
              $.get(
                      "http://487wbool.adversary.gg/login",
                      { get_name_by_id: "true", id: user.employee_id },

                      function(response) {
                        var name = JSON.parse(response);
                        console.log(name)


                        createCookie("name", name.first_name);
                        location.reload()
                        }
                    )
          }
      )
  }

 function contact_submit(){
 let firstname = $("#customer_firstname").val();
 let lastname = $("#customer_lastname").val();
 let feedback = $("#customer_feedback").val();
let store_id = 1;
 $.get("http://487wbool.adversary.gg/query",
 {customercard_insert:"true", first_name:firstname, last_name:lastname, store_id:store_id, comments:feedback},
 function(response){console.log(response);}
 );
 }
</script>
</body>
</html>


