create database employeepay;
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'admin';
-- create the dept table
create table dept (
  dept_id int primary key,
  dept_name varchar(40) not null,
  dept_location varchar(40)
);

-- create the employee table
create table employee (
  emp_id int primary key,
  emp_name varchar(40) not null,
  dept_id int,
  type_of_work varchar(20) not null,
  hourly_rate decimal(10, 2),
  constraint fk_dept foreign key (dept_id) references dept(dept_id)
);

-- create the address table
create table address (
  emp_id int primary key,
  street_no varchar(10),
  street_name varchar(40),
  city varchar(40),
  zip_code varchar(15),
  constraint fk_emp foreign key (emp_id) references employee(emp_id)
);

-- create the project table
create table project (
  project_id int primary key,
  project_name varchar(40) not null,
  project_location varchar(40)
);


-- create the ft_pt_work table
create table ft_pt_work (
  project_id int,
  emp_id int,
  dept_id int,
  num_of_hours int,
  constraint fk_project foreign key (project_id) references project(project_id),
  constraint fk_emp_work foreign key (emp_id) references employee(emp_id),
  constraint fk_dept_work foreign key (dept_id) references dept(dept_id)
);

-- create the salary table
create table salary (
  emp_no int primary key,
  basic decimal(10, 2),
  allowance decimal(10, 2) as (0.45 * basic) STORED,
  deduction decimal(10, 2) as ((0.09+0.25)* basic) STORED,
  net_salary decimal(10, 2) as (basic + allowance - deduction) STORED,
  salary_date DATE,
  constraint fk_emp_salary foreign key (emp_no) references employee(emp_id)
);

-- Trigger to enforce the minimum basic salary for full-time employees
delimiter $$
create TRIGGER tr_salary_F_basic
BEFORE insert on salary
FOR EACH ROW
BEGIN
  declare employee_type varchar(20);
  select type_of_work into employee_type
  from employee
  where emp_id = new.emp_no;
  if employee_type = 'F' then
    if new.basic < 4000 then
      SIGNAL SQLSTATE '44000' SET MESSAGE_TEXT = 'For the full-time employee, the basic is a standard rate and cannot be less than $4000';
    end if;
  end if;
end$$
delimiter ;

-- Trigger to enforce the basic salary for part-time employees
delimiter $$
create TRIGGER tr_salary_P_basic
BEFORE insert on salary
FOR EACH ROW
BEGIN
  declare employee_type1 varchar(20);
  declare hr_rate decimal(10, 2);
  declare no_hr int;
  select type_of_work into employee_type1
  from employee
  where emp_id = new.emp_no;
  select hourly_rate into hr_rate
  from employee
  where emp_id = new.emp_no; 
  select num_of_hours into no_hr
  from ft_pt_work
  where emp_id = new.emp_no;
  if employee_type1 = 'P' then
    if new.basic != (hr_rate * no_hr) then
      SIGNAL SQLSTATE '44000' SET MESSAGE_TEXT = 'For the part-time employee, the basic cannot be anything other than (hourly_rate* num_of_hours)';
    end if;
  end if;
end$$
delimiter ;

-- Trigger to enforce the hourly rate constraint for part-time employees
delimiter $$
create TRIGGER tr_employee_hourly_rate
BEFORE INSERT on employee
FOR EACH ROW
BEGIN
	if new.type_of_work = 'P' then
		if new.hourly_rate < 25 or new.hourly_rate > 60 then
			SIGNAL SQLSTATE '44000' 
			SET MESSAGE_TEXT = 'Hourly rate should be between $25 and $60.';
		end if;
	end if;
end$$
delimiter ;


-- inserting into dept
insert into dept (dept_id, dept_name, dept_location)
values
  (1, 'Engineering', 'Burton Canberra '),
  (2, 'IT', 'Googong'),
  (3, 'Sales', 'Canberra');

-- inserting into employee
insert into employee (emp_id, emp_name, dept_id, type_of_work, hourly_rate)
values
  (1903151, 'John', 1, 'F', 45),
  (1903152, 'Emily', 3, 'P', 35),
  (1903153, 'Michael', 1, 'F', 55),
  (1903154, 'Jessica', 2, 'P', 30),
  (1903155, 'Andrew', 1, 'F', 50),
  (1903156, 'Olivia', 2, 'P', 40),
  (1903157, 'William', 1, 'F', 60),
  (1903158, 'Sophia', 3, 'P', 45),
  (1903159, 'Daniel', 2, 'F', 35),
  (1903160, 'Emma', 3, 'P', 40);

-- inserting into address
insert into address (emp_id, street_no, street_name, city, zip_code)
values
  (1903151, '52', 'Main St', 'Burton Canberra ', '15345'),
  (1903152, '56', 'First Ave', 'Canberra', '54321'),
  (1903153, '89', 'Second St', 'Googong', '67890'),
  (1903154, '154', 'Main St', 'Burton Canberra ', '15345'),
  (1903155, '66', 'First Ave', 'Canberra', '54321'),
  (1903156, '99', 'Second St', 'Googong', '67890'),
  (1903157, '153', 'Main St', 'Burton Canberra ', '15345'),
  (1903158, '46', 'First Ave', 'Canberra', '54321'),
  (1903159, '119', 'Second St', 'Googong', '67890'),
  (1903160, '113', 'Main St', 'Burton Canberra ', '15345');

-- inserting into project
insert into project (project_id, project_name, project_location)
values
  (1, 'Burton Highway', 'Burton Canberra '),
  (2, 'Googong Subdivision', 'Googong'),
  (3, 'Sales Expansion', 'Canberra'),
  (4, 'Customer Retention', 'Burton Canberra ');
  
-- inserting into ft_pt_work
insert into ft_pt_work (project_id, emp_id, dept_id, num_of_hours)
values
  (2, 1903157, 1, 15),
  (2, 1903152, 3, 25),
  (1, 1903153, 1, 17),
  (4, 1903154, 2, 30),
  (1, 1903155, 1, 15),
  (3, 1903156, 2, 35),
  (1, 1903157, 1, 10),
  (1, 1903152, 2, 25),
  (2, 1903153, 1, 15),
  (4, 1903151, 1, 10),
  (1, 1903158, 3, 35),
  (1, 1903160, 3, 45);
  


-- inserting into salary
insert into salary (emp_no, basic, salary_date) 
values
  (1903151, 6000, '2023-06-01'),
  (1903153, 7000, '2023-06-01'),
  (1903155, 8000, '2023-06-01'),
  (1903157, 7400, '2023-06-01'),
  (1903159, 6400, '2023-06-01');
  
  
 
 

select * from address;
select * from dept;
select * from employee;
select * from ft_pt_work;
select * from project;
select * from salary;

-- 1 List the names of all Engineers in Googong Subdivision project located at Googong city
select e.emp_name, p.project_name, p.project_location
from employee e
join dept d on e.dept_id = d.dept_id
join ft_pt_work f on e.emp_id = f.emp_id
join project p on f.project_id = p.project_id
where d.dept_name = 'Engineering' AND p.project_name = 'Googong Subdivision' AND p.project_location = 'Googong';

-- 2 List the names of all Labor in Googong Subdivision project located at Googong city who work more than 20 hours per week
select e.emp_name, f.num_of_hours
from employee e
join dept d on e.dept_id = d.dept_id
join ft_pt_work f on e.emp_id = f.emp_id
join project p on f.project_id = p.project_id
where d.dept_name = 'IT'  AND p.project_name = 'Sales Expansion' AND p.project_location = 'Canberra' AND f.num_of_hours > 20;

-- 3 Retrieve the names and addresses of all employees who work on at least one project located in Burton Canberra but whose department has no location in Canberra
select e.emp_name, ad.street_no, ad.street_name, ad.city, ad.zip_code,p.project_location,d.dept_location
from employee e
join address ad on e.emp_id = ad.emp_id
join ft_pt_work f on e.emp_id = f.emp_id
join project p on f.project_id = p.project_id
join dept d on e.dept_id = d.dept_id
where p.project_location = 'Burton Canberra ' AND d.dept_location <> 'Googong';

-- 4 Retrieve the names of employees who work on both the Googong Subdivision and Burton Highway project
select e.emp_name
from employee e
join ft_pt_work f on e.emp_id = f.emp_id
join project p on f.project_id = p.project_id
where p.project_name IN ('Burton Highway', 'Googong Subdivision')
GROUP BY e.emp_name
HAVING COUNT(DISTINCT p.project_name) = 2;

-- 5 create a view which lists out the emp_name, dept_name, type_of_work, basic, deduction, net_salary from the above relational databases
create VIEW employee_salary AS
select e.emp_name, d.dept_name, e.type_of_work, s.basic, s.deduction, s.net_salary
from employee e
join dept d on e.dept_id = d.dept_id
join ft_pt_work f on e.emp_id = f.emp_id
join salary s on e.emp_id = s.emp_no
GROUP BY e.emp_name
ORDER BY e.emp_id;

-- 6 Advise some modification/s about the ft_pt_work and named new table as ft_pt_work_yourlastname
-- create the ft_pt_work_yourlastname table with modified structure
create TABLE ft_pt_work_zami (
  work_id int primary key,
  project_id int,
  emp_id int,
  num_of_hours int,
  work_date DATE,
  constraint fk_project_new foreign key (project_id) references project(project_id),
  constraint fk_emp_work_new foreign key (emp_id) references employee(emp_id));
  
insert into ft_pt_work_zami (work_id, project_id, emp_id, num_of_hours, work_date)
values
  (1, 2, 1903157, 1, '2023-06-01'),
  (2, 2, 1903152, 3, '2023-06-01'),
  (3, 1, 1903153, 1, '2023-06-01'),
  (4, 4, 1903154, 2, '2023-06-01'),
  (5, 1, 1903155, 1, '2023-06-01'),
  (6, 3, 1903156, 2, '2023-06-01'),
  (7, 1, 1903157, 1, '2023-06-01'),
  (8, 1, 1903152, 2, '2023-06-01'),
  (9, 2, 1903153, 1, '2023-06-01'),
  (10, 4, 1903151, 1, '2023-06-01');
  
select * from ft_pt_work_zami;