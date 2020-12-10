DROP DATABASE IF EXISTS BoolDB;
CREATE DATABASE IF NOT EXISTS BoolDB;
USE BoolDB;

SELECT 'CREATING DATABASE STRUCTURE' AS 'INFO';

DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS store;
DROP TABLE IF EXISTS schedule;
DROP TABLE IF EXISTS login;
DROP TABLE IF EXISTS invoice;
DROP TABLE IF EXISTS customer_card;
DROP TABLE IF EXISTS time_off_requests;
DROP TABLE IF EXISTS requests;
DROP TABLE IF EXISTS availability;
DROP TABLE IF EXISTS locationRequest;
DROP TABLE IF EXISTS scheduleRequest;

/*TABLE WITH EMPLOYEE INFORMATION*/
CREATE TABLE employees
(
    employee_id INT         NOT NULL AUTO_INCREMENT, /*one instance of each int*/
    first_name  VARCHAR(14) NOT NULL,
    last_name   VARCHAR(16) NOT NULL,
    birth_date  DATE        NOT NULL,
    position    CHAR(1)     NOT NULL, /*E FOR EMPLOYEE, M FOR MANGER, R FOR REGIONAL MANAGER*/
    hire_date   DATE        NOT NULL,
    store       INT         NOT NULL,
    PRIMARY KEY (employee_id),
    FOREIGN KEY (store) REFERENCES store(store_id)
);

/*TABLE FOR STORE LOCATION AND IDENTIFICATION*/
CREATE TABLE store
(
    store_id   INT         NOT NULL AUTO_INCREMENT, /*one instance of each int*/
    store_location VARCHAR(40) NOT NULL, /*one instance of each location*/
    PRIMARY KEY (store_id, store_location),
    UNIQUE KEY (store_id, store_location)
);

/*TABLE FOR LOGIN INFORMATION FOR ACCOUNTS*/
CREATE TABLE login
(
    employee_id INT         NOT NULL, /*account employee ID, only one instance per int*/
    username    VARCHAR(50) NOT NULL, /*account username, only one instance per username*/
    password    VARCHAR(50) NOT NULL, /*account password*/
    type        CHAR(1)     NOT NULL, /*E FOR EMPLOYEE, M FOR MANAGER, R FOR REGIONAL MANAGER*/
    PRIMARY KEY (username, employee_id),
    FOREIGN KEY (employee_id) REFERENCES employees (employee_id),
    FOREIGN KEY (type) REFERENCES employees (position)
);

/*TABLE FOR ALL EMPLOYEE AND STORE SCHEDULE INFORMATION*/
CREATE TABLE schedule
(
    employee_id  INT     NOT NULL, /*employee's id*/
    position     CHAR(1) NOT NULL, /*E FOR EMPLOYEE, M FOR MANAGER, R FOR REGIONAL MANAGER*/
    store_id     INT     NOT NULL, /*one instance of each int*/
    start_time   TIME    NOT NULL,
    stop_time    TIME    NOT NULL,
    work_day     DATE    NOT NULL, /*date*/
    FOREIGN KEY (employee_id) REFERENCES employees (employee_id),
    FOREIGN KEY (store_id) REFERENCES store (store_id)

);

/*TABLE FOR REQUESTS OF EMPLOYEES FOR TIME OFF*/
CREATE TABLE time_off_requests
(
    request_id  INT NOT NULL AUTO_INCREMENT,
    employee_id INT NOT NULL,
    start_date  DATE    NOT NULL,
    end_date    DATE    NOT NULL,
    approved    CHAR(1) NOT NULL,
    PRIMARY KEY (request_id),
    FOREIGN KEY (employee_id) REFERENCES employees (employee_id)

);

CREATE TABLE availability(
                             employee_id     INT NOT NULL,
                             monday          VARCHAR(30),
                             tuesday         VARCHAR(30),
                             wednesday       VARCHAR(30),
                             thursday        VARCHAR(30),
                             friday          VARCHAR(30),
                             saturday        VARCHAR(30),
                             sunday          VARCHAR(30),
                             PRIMARY KEY (employee_id),
                             FOREIGN KEY (employee_id) REFERENCES employees(employee_id)

);

/*TABLE FOR CUSTOMER COMMENTS TO BE KEPT*/
CREATE TABLE customer_card
(
    comment_id   INT           NOT NULL AUTO_INCREMENT, /*one instance of each int*/
    first_name   VARCHAR(50), /*first name of customer*/
    last_name    VARCHAR(50), /*last name of customer*/
    store_id INT           ,
    comments     VARCHAR(1000) NOT NULL,
    PRIMARY KEY (comment_id),
    FOREIGN KEY (store_id) REFERENCES store (store_id)
);

/*TABLE FOR INVOICES*/ /*UNLIKELY WE ARE USING THIS*/
CREATE TABLE invoice
(
    invoice_id     INT            NOT NULL AUTO_INCREMENT, /*invoice number, one instance of each int*/
    created        DATE           NOT NULL, /*date created*/
    title          VARCHAR(80)    NOT NULL, /*title of invoice*/
    body           VARCHAR(10000) NOT NULL, /*body of invoice*/
    PRIMARY KEY (invoice_id),
    FOREIGN KEY (invoice_id) REFERENCES employees (employee_id)
);

CREATE TABLE requests(
                         employee_id     INT  NOT NULL,
                         location        VARCHAR(50),
                         salary          INT,

                         PRIMARY KEY (employee_id),
                         FOREIGN KEY (employee_id) REFERENCES employees(employee_id)


);

CREATE TABLE locationRequest(
                                employee_id INT NOT NULL,
                                store       INT NOT NULL,
                                FOREIGN KEY (employee_id) REFERENCES employees(employee_id),
                                FOREIGN KEY (store) REFERENCES store(store_id)

);

CREATE TABLE scheduleRequest(
                                employee_id   INT NOT NULL,
                                daterange         VARCHAR(40),
                                monday        VARCHAR(30),
                                tuesday       VARCHAR(30),
                                wednesday       VARCHAR(30),
                                thursday        VARCHAR(30),
                                friday          VARCHAR(30),
                                saturday        VARCHAR(30),
                                sunday          VARCHAR(30),
                                approved         VARCHAR(1)



);

INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (1, 'Joey', 'Reno', '1998-10-28', 'M', '2019-10-16', 1);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Brock', 'Lee', '1993-10-28', 'E', '2018-05-16', 1);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Connor', 'Mills', '1999-05-12', 'M', '2018-07-16', 2);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Tommy', 'Chong', '1993-10-28', 'R', '2018-05-16', 1);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Will', 'Smith', '1993-10-28', 'E', '2018-05-16', 2);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Walter', 'Thorton', '1993-10-28', 'E', '2018-05-16', 2);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Will', 'Jefferson', '1993-10-28', 'E', '2018-05-16', 2);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Tony', 'MaMaMia', '1993-10-28', 'M', '2018-05-16', 3);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Jean', 'Ford', '1993-10-28', 'E', '2018-05-16', 1);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Billy', 'Smith', '1993-10-28', 'E', '2018-05-16', 2);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'John', 'Brown', '1993-10-28', 'E', '2018-05-16', 1);
INSERT INTO employees(employee_id, first_name, last_name, birth_date, position, hire_date, store)
VALUES (NULL, 'Rodger', 'Washington', '1993-10-28', 'E', '2018-05-16', 2);

INSERT INTO store(store_id, store_location)
VALUES (1, '1026 Washington Street');
INSERT INTO store(store_id, store_location)
VALUES (2, '5089 Main Street');
INSERT INTO store(store_id, store_location)
VALUES (3, '1604 Main Street');
INSERT INTO store(store_id, store_location)
VALUES (4, '2408 Main Street');

INSERT INTO login(employee_id, username, password, type)
VALUES (1, 'admin', 'boolsquad', 'M');
INSERT INTO login(employee_id, username, password, type)
VALUES (2, 'brock', 'squad', 'E');
INSERT INTO login(employee_id, username, password, type)
VALUES (3, 'steven', 'squad', 'M');
INSERT INTO login(employee_id, username, password, type)
VALUES (4, 'tommy', 'squad', 'R');
INSERT INTO login(employee_id, username, password, type)
VALUES (5, 'will', 'squad', 'E');


INSERT INTO schedule(employee_id, position, store_id, start_time, stop_time, work_day)
VALUES (1, 'M', 6, '08:00:00', '17:00:00', '2020-11-20');
INSERT INTO schedule(employee_id, position, store_id, start_time, stop_time, work_day)
VALUES (2, 'E', 2, '13:00:00', '21:00:00', '2020-12-21');
INSERT INTO schedule(employee_id, position, store_id, start_time, stop_time, work_day)
VALUES (2, 'E', 2, '13:00:00', '21:00:00', '2020-12-22');
INSERT INTO schedule(employee_id, position, store_id, start_time, stop_time, work_day)
VALUES (2, 'E', 1, '10:00:00', '18:00:00', '2020-12-23');
INSERT INTO schedule(employee_id, position, store_id, start_time, stop_time, work_day)
VALUES (2, 'E', 2, '11:00:00', '20:00:00', '2020-12-24');

INSERT INTO time_off_requests(request_id, employee_id, start_date, end_date, approved)
VALUES (1, 1, '2020-12-25', '2021-01-02', 'W');
INSERT INTO availability(employee_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday)
VALUES(1, '08:00-17:00', NULL, NULL, '10:00-18:00', '06:00-21:00', NULL, NULL);
INSERT INTO customer_card(comment_id, first_name, last_name, store_id, comments)
VALUES (1, 'Kat', 'Gurl', 1, 'Brock provided amazing service');
INSERT INTO invoice(invoice_id, created, title, body)
VALUES (1, '2020-11-23', 'invoice 1', 'put body of stuff here boi');
INSERT INTO requests(employee_id, location, salary)
VALUES(1, 'SOMEWHERE', 300000);