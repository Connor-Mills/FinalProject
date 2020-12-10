<?php
require "connect.php";

function loginCheck($username, $password){
    global $conn;

    $sql = "SELECT employee_id, type FROM login WHERE username = '{$username}' AND password = '{$password}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());

}

if (htmlspecialchars($_GET["login_check"])) {
    $username           =   $_GET["username"];
    $password           =   $_GET["password"];
    loginCheck($username, $password);
}

function getNameByID($id){
  global $conn;

  $sql = "SELECT first_name FROM employees WHERE employee_id = '{$id}'";
  $result = $conn->query($sql);
  echo json_encode($result->fetch_assoc());
}

if (htmlspecialchars($_GET["get_name_by_id"])) {
    $id = $_GET["id"];
    getNameByID($id);
}
?>
