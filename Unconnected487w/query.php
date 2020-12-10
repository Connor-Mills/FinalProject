<?php
require "connect.php";
/*

        TO QUICKLY MOVE THROUGH THE FILE SEARCH FOR THE # SYMBOL, WILL TAKE YOU TO NEXT TABLE SECTION
                                                    8 sections

*/


/*
    ALL EMPLOYEE CALLS
*/
/*  #1
     CAN NOT BE NULL: ALL VARIABLES
     EMPLOYEE ID ALREADY TAKEN CARE OF ON INSERT NO PARAM NEEDED
*/
function employeeInsert($first_name, $last_name, $birth_date, $position, $hire_date, $store)
{   //done
    global $conn;

    $sql = "INSERT INTO employees (employee_id, first_name, last_name, birth_date, position, hire_date, store)
        VALUES (NULL, '{$first_name}', '{$last_name}', '{$birth_date}', '{$position}', '{$hire_date}', {$store})";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (htmlspecialchars($_GET["employee_insert"])) {       //insert into employee table
    $first_name = $_GET["first_name"];
    $last_name = $_GET["last_name"];
    $birth_date = $_GET["birth_date"];
    $position = $_GET["position"];
    $hire_date = $_GET["hire_date"];
    $store      = $_GET["store"];


    employeeInsert($first_name, $last_name, $birth_date, $position, $hire_date, $store);
}


function employeeDelete($employeeID)
{
    global $conn;
    $sql = "DELETE FROM employees WHERE employee_id = '{$employeeID}';";
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo 0;
    }
}

if (htmlspecialchars($_GET["employee_delete"])) {       //delete row from employee table by employee_id
    $employee_id = $_GET["employee_id"];
    employeeDelete($employee_id);
}


function employeeUpdate($employee_id, $first_name, $last_name, $birth_date, $position, $hire_date, $store)
{
    global $conn;
    $sql = "UPDATE employees SET first_name = '{$first_name}', last_name = '{$last_name}', birth_date = '{$birth_date}', position = '{$position}', hire_date = '{$hire_date}', store '{$store}' WHERE employee_id = '{$employee_id}';";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (htmlspecialchars($_GET["employee_update"])) {           //update row in employee table by employee_id
    $employee_id = $_GET["employee_id"];
    $first_name = $_GET["first_name"];
    $last_name = $_GET["last_name"];
    $birth_date = $_GET["birth_date"];
    $position = $_GET["position"];
    $hire_date = $_GET["hire_date"];

    employeeUpdate($employee_id, $first_name, $last_name, $birth_date, $position, $hire_date);
}


//selects
function employeeSelectAll()
{ //done
    global $conn;

    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo json_encode($row) . "<br>";
        }
    } else {
        echo "0 results <br>";
    }
}

//checks html link for employee calls
if (htmlspecialchars($_GET["employee_select"])) {           //select entire employee table
    employeeSelectAll();
}

function getEmployees()
{ //done
    global $conn;

    $sql = "SELECT employee_id, first_name, last_name, position FROM employees";
    $result = $conn->query($sql);

    $test = array();

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if($row['position'] == "E"){
            array_push($test, $row);
        }
    }
    return $test;
}

//checks html link for employee calls
if (htmlspecialchars($_GET["get_employee"])) {           //select entire employee table
    getEmployee();
}

function getManagers()
{ //done
    global $conn;

    $sql = "SELECT employee_id, first_name, last_name, position FROM employees";
    $result = $conn->query($sql);

    $test = array();

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if($row['position'] == "M"){
            array_push($test, $row);
        }
    }
    return $test;
}

//checks html link for employee calls
if (htmlspecialchars($_GET["get_managers"])) {           //select entire employee table
    getManagers();
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

function getEmployeeByStore($store){
    global $conn;
    $sql = "SELECT * FROM employees WHERE store = '{$store}'";
    $result = $conn -> query($sql);
    echo json_encode($result->fetch_assoc());
}

if (htmlspecialchars($_GET["get_employee_by_store"])){
    $id = $_GET["id"];
    getEmployeeByStore($store);
}

/*
**********************LOGIN TABLE CALLS************************************
*/
/*  #2
     CAN NOT BE NULL: ALL VARIABLES
*/

function loginInsert($employeeID, $username, $password, $type)
{
    global $conn;
    $sql = "INSERT INTO login (employee_id, user_name, password, type)
            VALUES ('{employee_id}', '{$username}', '{$password}', '{type}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (htmlspecialchars($_GET["login_insert"])) {          //inserts into login table
    $employeeID = $_GET["employee_id"];
    $username = $_GET["last_name"];
    $password = $_GET["birth_date"];
    $type = $_GET["type"];

    loginInsert($employeeID, $username, $password, $type);
}


function loginDelete($employee_id)
{
    global $conn;

    $sql = "DELETE FROM login WHERE username = '{employee_id}'";
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo 0;
    }
}

if (htmlspecialchars($_GET["login_delete"])) {      //delete row in login table by username
    $username = $_GET["$username"];
    loginDelete($username);
}


function loginUpdate($employeeID, $username, $password, $type)
{
    global $conn;

    $sql = "UPDATE login SET  username = '{$username}', password = '{$password}', type = '{type}' WHERE employee_id = '{$employeeID}'";
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo 0;
    }

}

if (htmlspecialchars($_GET["login_update"])) {          //updates row in login table by employee_id
    $employee_id = $_GET["employee_id"];
    $username = $_GET["username"];
    $password = $_GET["password"];
    $type = $_GET["type"];

    loginUpdate($employee_id, $username, $password, $type);
}


function loginPasswordUpdate($username, $password)
{
    global $conn;

    $sql = "UPDATE login SET password = '{$password}' WHERE username = '{$username}'";
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo 0;
    }

}

if (htmlspecialchars($_GET["password_update"])) {           //updates password in login table
    $username = $_GET["username"];
    $password = $_GET["password"];

    loginPasswordUpdate($username, $password);


}


function loginCheck($username, $password)
{
    global $conn;

    $sql = "SELECT employee_id, type FROM login WHERE username = '{$username}' AND password = '{$password}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());

}

if (htmlspecialchars($_GET["login_check"])) {           //checks validity of password
    $username = $_GET["username"];
    $password = $_GET["password"];
    loginCheck($username, $password);
}

/*  #3
**********************STORE CALLS************************************
*/
/*
     CAN NOT BE NULL: ALL VARIABLES
*/
function storeInsert($store_location)
{
    global $conn;
    $sql = "INSERT INTO store (store_id, store_location)
            VALUES (NULL, '{$store_location}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br> {$store_location}";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (htmlspecialchars($_GET["store_insert"])) {
    $store_location = $_GET["store_location"];
    storeInsert(NULL, $store_location);
}

function storeDelete($store_id)
{
    global $conn;
    $sql = "DELETE FROM store WHERE store_id = '{$store_id}'";
    if ($conn->query($sql) === TRUE) {
        echo "deleted <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

if (htmlspecialchars($_GET["store_delete"])) {          //delete from store table by store_id
    $store_id = $_GET["store_id"];

    storeDelete($store_id);
}

function storeSelectById($store_id)
{
    global $conn;
    $sql = "SELECT * FROM store WHERE store_id = '{$store_id}'";
    if ($conn->query($sql) === TRUE) {
        $result = $conn->query($sql);

        $test = array();

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($test, $row);
        }
        return $test;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (htmlspecialchars($_GET["store_selectbyid"])) {          //select rows from store table by store_id

    storeSelectById($store_id);
}

function storeSelectAll()
{
    global $conn;
    $sql = "SELECT * FROM store";
    $result = $conn->query($sql);

    $test = array();

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        array_push($test, $row);
    }
    return $test;
}

if (htmlspecialchars($_GET["store_selectall"])) {           //select all from store table

    storeSelectAll();
}
/*  #4
**********************SCHEDULE CALLS************************************
*/
/*
     CAN NOT BE NULL: ALL VARIABLES
*/
//INSERT
function scheduleInsert($employee_id, $store_id, $start_time, $stop_time, $work_day, $position)
{
    global $conn;
    $sql = "INSERT INTO schedule (employee_id, position, store_id, start_time, stop_time, work_day)
            VALUES ({$employee_id},'{$position}' ,{$store_id}, '{$start_time}', '{$stop_time}', '{$work_day}')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (htmlspecialchars($_GET["schedule_insert"])) {           //insert into schedule table
    $employee_id = $_GET["employee_id"];
    $store_id = $_GET["store_id"];
    $start_time = $_GET["start_time"];
    $stop_time = $_GET["stop_time"];
    $work_day = $_GET["work_day"];
    $position = $_GET["position"];

    scheduleInsert(intval($employee_id), intval($store_id), $start_time, $stop_time, $work_day, $position);
}


//SELECTS

function scheduleSelectAll()
{      //get entire table
    global $conn;

    $sql = "SELECT * FROM schedule";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}

if (htmlspecialchars($_GET["schedule_selectall"])) {        //select all rows from schedule table
    scheduleSelectAll();
}



function scheduleSelectByPosition($position)
{      //get all rows with position
    global $conn;

    $sql = "SELECT * FROM schedule WHERE position = '{$position}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}

if (htmlspecialchars($_GET["schedule_selectbypos"])) {          //select rows from schedule by position
    $position = $_GET["position"];

    scheduleSelectByPosition($position);
}




function scheduleSelectByStore($store_id)
{      //get all rows with store number
    global $conn;

    $sql = "SELECT * FROM schedule WHERE store_id = '{store_id}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}

if (htmlspecialchars($_GET["schedule_selectybystore"])) {           //select rows from schedule by store_id
    $store_id = $_GET["store_id"];

    scheduleSelectByStore($store_id);
}




function scheduleSelectByDay($work_day)
{      //get all rows for day
    global $conn;

    $sql = "SELECT * FROM schedule WHERE work_day = '{$work_day}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}

if (htmlspecialchars($_GET["schedule_selectbyday"])) {         //select rows from schedule by day
    $work_day = $_GET["work_day"];

    scheduleSelectByDay($work_day);
}



function scheduleSelectEmployee($employee_id)
{      //get row for employee id
    global $conn;

    $sql = "SELECT * FROM schedule WHERE employee_id = '{employee_id}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["schedule_selectemployee"])) {      //select row from schedule table by employee_id
    $employee_id = $_GET["employee_id"];

    scheduleSelectEmployee($employee_id);
}
//DELETE
function scheduleDelete($employee_id){
    global $conn;

    $sql = "DELETE FROM schedule WHERE employee_id = '{employee_id}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["schedule_deletebyid"])) {         //select rows from schedule by day
    $employee_id = $_GET["employee_id"];

    scheduleDelete($employee_id);
}

function scheduleDeleteByEmployeeDay($employee_id, $work_day){
    global $conn;

    $sql = "DELETE FROM schedule WHERE employee_id = '{employee_id}' AND work_day = '{work_day}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["schedule_deletebyempday"])) {         //select rows from schedule by day
    $employee_id = $_GET["employee_id"];
    $work_day    = $_GET{"work_day"};

    scheduleDeleteByEmployeeDay($employee_id, $work_day);
}

function scheduleDeleteByDay($day){
    global $conn;

    $sql = "DELETE FROM schedule WHERE work_day = '{work_day}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["schedule_deletebyday"])) {         //select rows from schedule by day
    $work_day    = $_GET{"work_day"};

    scheduleDeleteByDay($work_day);
}


/*  #5
**********************TIME OFF REQUEST CALLS************************************
*/
/*      #
     CAN NOT BE NULL: APPROVED, EMPLOYEE_ID, DAY
*/

function time_off_requestsInsert($employeeID, $start_date, $end_date, $approved)
{
    global $conn;
    $sql = "INSERT INTO time_off_requests (request_id, employee_id, start_date, end_date, approved)
            VALUES ( NULL, '{employee_id}', '{start_date}', '{end_date}', '{approved}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (htmlspecialchars($_GET["timeoffrequests_Insert"])) {        //insert into time_off_requests table
    $employeeID = $_GET["employee_id"];
    $start_date = $_GET["start_date"];
    $end_date = $_GET["end_date"];
    $approved = $GET["approved"];

    time_off_requestsInsert($employeeID, $start_date, $end_date, $approved);
}

//Deletes
function time_off_requestsDeleteByReq($request_id){
    global $conn;

    $sql = "DELETE FROM time_off_requests WHERE request_id = '{request_id}'";
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo 0;
    }
}

if (htmlspecialchars($_GET["timeoffrequests_deletebyreq"])) {           //delete from time_off_requests by request_id
    $request_id = $_GET["request_id"];


    time_off_requestsDeleteByReq($request_id);
}


function time_off_requestsDeleteEmpDay($employeeID, $day)
{
    global $conn;

    $sql = "DELETE FROM time_off_requests WHERE employee_id = '{$employeeID}' AND day = '{$day}'";
    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo 0;
    }
}

if (htmlspecialchars($_GET["timeoffrequests_deleteempday"])) {      //delete from time_off_requests by employee_id and start day
    $employeeID = $_GET["employeeID"];
    $start_date = $_GET["start_date"];

    time_off_requestsDeleteByReq($employee_id, $day);
}


//SELECTS
function time_off_requestsSelectAll()
{      //get entire table
    global $conn;

    $sql = "SELECT * FROM time_off_requests";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["timeoffrequests_selectall"])) {     //select entire time_off_requests table

    time_off_requestsSelectAll();
}

function time_off_requestsSelectById($request_id)
{              //get entire row of request_id
    global $conn;

    $sql = "SELECT * FROM time_off_requests WHERE request_id = '{$request_id}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["timeoffrequests_selectbyid"])) {            //select all from time_off_requests by request_id
    $request_id = $_GET["request_id"];

    time_off_requestsSelectById($request_id);
}

function time_off_requestsSelectByEmployee($employee_id)
{       //get entire row by employee_id
    global $conn;

    $sql = "SELECT * FROM time_off_requests WHERE employee_id = '{$employee_id}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["timeoffrequests_selectbyemp"])) {           //select all from time_off_requests by employee_id
    $employee_id = $_GET["employee_id"];

    time_off_requestsSelectByEmployee($employee_id);
}

function time_off_requestsSelectByDay($day)
{                //get entire row by day
    global $conn;

    $sql = "SELECT * FROM time_off_requests WHERE day = '{day}'";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
}
if (htmlspecialchars($_GET["timeoffrequests_selectbystartday"])) {       //select from time_off_requests by day
    $start_date = $_GET["start_date"];

    time_off_requestsDeleteByReq($start_date);
}



/*
***********************AVAILABILITY***********************************************
*/

function availabilityInsert($employee_id, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday)
{
    global $conn;
    $sql = "INSERT INTO availability(employee_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday)
            VALUES ('{employee_id}', '{monday}', '{tuesday}', '{wednesday}', '{thursday}', '{friday}', '{saturday}', '{sunday}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (htmlspecialchars($_GET["availability_insert"])) {       //insert into customer_card table
    $employee_id = $_GET["employee_id"];
    $monday = $_GET["monday"];
    $tuesday = $_GET["tuesday"];
    $wednesday = $_GET["wednesday"];
    $thursday = $_GET["thursday"];
    $friday = $_GET["friday"];
    $saturday = $_GET["saturday"];
    $sunday = $_GET["sunday"];
    availabilityInsert($employee_id, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
}

function availabilitySelectAll()
{
    global $conn;
    $sql = "SELECT * FROM availability";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (htmlspecialchars($_GET["availability_selectall"])) {       //select from time_off_requests by day

    availabilitySelectAll();
}

function availabilitySelectbyEmp($employee_id)
{
    global $conn;
    $sql = "SELECT * FROM availability WHERE employee_id = '{employee_id}'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (htmlspecialchars($_GET["availability_selectall"])) {       //select from time_off_requests by day
    $employee_id = $_GET["employee_id"];
    availabilitySelectbyEmp($employee_id);
}

function availabilityUpdate($employee_id, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday)
{
    global $conn;
    $sql = "UPDATE availability SET  monday = '{monday}', tuesday = '{tuesday}', wednesday = '{wednesday}', thursday = '{thursday}', friday = '{friday}', saturday = '{saturday}', sunday = '{sunday}' WHERE employee_id = '{employee_id}'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (htmlspecialchars($_GET["availability_update"])) {       //select from time_off_requests by day
    $employee_id = $_GET["employee_id"];
    $monday  = $_GET["monday"];
    $tuesday = $_GET["tuesday"];
    $wednesday = $_GET["wednesday"];
    $thursday = $_GET["thursday"];
    $friday = $_GET["friday"];
    $saturday = $_GET["saturday"];
    $sunday = $_GET["sunday"];
    availabilityUpdate($employee_id, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
}


/*  #7
**********************CUSTOMER CARD TABLE CALLS************************************
*/
/*
     CAN NOT BE NULL: store_id, comments
     comment_id is auto-incremented and is taken care of on insert

*/

function customer_cardInsert($comment_id, $first_name, $last_name, $store_id, $comments)
{
    global $conn;
    $sql = "INSERT INTO customer_card (comment_id, first_name, last_name, store_id, comments)
            VALUES (NULL, '{$first_name}', '{$last_name}', {$store_id}, '{$comments}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (htmlspecialchars($_GET["customercard_insert"])) {       //insert into customer_card table
    $first_name = $_GET["first_name"];
    $last_name = $_GET["last_name"];
    $store_id = $_GET["store_id"];
    $comments = $_GET["comments"];
    customer_cardInsert(NULL, $first_name, $last_name, $store_id, $comments);
}

function customer_cardSelectById($comment_id){
    global $conn;
    $sql = "SELECT * FROM customer_card";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (htmlspecialchars($_GET["customercard_selectbyid"])) {       //select all data by comment_id
    $comment_id = $_GET["comment_id"];

    customer_cardSelectById($comment_id);
}

function customer_cardView(){
    global $conn;
    $sql = "SELECT comment_id, first_name, last_name, store_id FROM customer_card";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
if (htmlspecialchars($_GET["customercard_view"])) {     //this is best choice for table view of user
    customer_cardView();
}

function customer_cardDelete($comment_id){
    global $conn;
    $sql = "DELETE FROM customer_card WHERE customer_id = '{comment_id}'";

    if ($conn->query($sql) === TRUE) {
        echo "Deleted <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (htmlspecialchars($_GET["customercard_deletebyid"])) {     //this is best choice for table view of user
    $comment_id = $_GET["comment_id"];
    customer_cardDelete($comment_id);
}
/* #
            REQUESTS
*/
function requestInsert($employee_id, $location, $salary){
    global $conn;
    $sql = "INSERT INTO requests (employee_id, location, salary)
                VALUES ('{employee_id}', '{location}', '{salary}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
if(htmlspecialchars($_GET["request_insert"])){
    $employee_id = $_GET["employee_id"];
    $location = $_GET["location"];
    $salary = $_GET["salary"];
    requestInsertInsert($employee_id, $location, $salary);
}

function requestDeletebyEmp($employee_id){
    global $conn;
    $sql = "DELETE FROM requests WHERE employee_id = '{employee_id}'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
if(htmlspecialchars($_GET["request_deletebyemp"])){
    $employee_id = $_GET["employee_id"];
    requestDeletebyEmp($employee_id);
}

function requestUpdate($employee_id, $location, $salary){
    global $conn;
    $sql = "UPDATE employees SET location = '{location}', salary = '{salary}' WHERE employee_id = '{$employee_id}'";
    if ($conn->query($sql) === TRUE) {
        echo "Updated <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if(htmlspecialchars($_GET["request_update"])){
    $employee_id = $_GET["employee_id"];
    $location = $_GET["location"];
    $salary = $_GET["salary"];
    requestUpdate($employee_id, $location, $salary);
}

/*  #8
**********************INVOICE CALLS************************************
*/
/*
     CAN NOT BE NULL: ALL VARIABLES
*/


function invoice($invoice_number, $created, $title, $body)
{
    global $conn;
    $sql = "INSERT INTO customer_card (invoice_id, created, title, body)
        VALUES ('{invoice_id}', '{created}', '{title}', '{body}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
function insertLocation($employee_id, $location){
    global $conn;
    $sql = "INSERT INTO locationRequest (employee_id, location)
        VALUES ('{employee_id}', '{location}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
if(htmlspecialchars($_GET["locationrequest_insert"])){
    $employee_id = $_GET["employee_id"];
    $location = $_GET["location"];
    insertLocation($employee_id, $location);
}

function insertScheduleRequest($employee_id, $location){
    global $conn;
    $sql = "INSERT INTO locationRequest (employee_id, daterange, monday, tuesday, wednesday, thursday, friday, saturday, sunday, approved)
        VALUES ('{employee_id}','{daterange}' ,'{monday}', '{tuesday}', '{wednesday}', '{thursday}', '{friday}', '{saturday}', '{sunday}', '{approved}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
if(htmlspecialchars($_GET["schedulerequest_insert"])){
    $employee_id = $_GET["employee_id"];
    $daterange = $_GET["daterange"];
    $monday = $_GET["monday"];
    $tuesday = $_GET["tuesday"];
    $wednesday = $_GET["wednesday"];
    $thursday = $_GET["thursday"];
    $friday = $_GET["friday"];
    $saturday = $_GET["saturday"];
    $sunday    = $_GET["sunday"];
    insertScheduleRequest($employee_id, $daterange, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
}
function updateRequest($request_id, $action){
    $sql = "UPDATE time_off_requests SET approved = '{action}' WHERE request_id = '{request_id}'";
    if ($conn->query($sql) === TRUE) {
            echo "New record created successfully <br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

}
if(htmlspecialchars($_GET["update_request"])){
    $request_id = $_GET["request_id"];
    $action = $_GET["action"];
    updateRequest($request_id, $action);

}


