<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>

<body style="background-color: #a1d2ce;">
    <div class="p-20 max-w-full">
        <h2 class="text-center text-3xl font-bold pb-10">Employee Pay Scenario Management System 🖥️</h2>
        <div class="flex flex-wrap justify-center">

            <div class="m-5 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4">
                </div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/assets/employee.png" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Employee information</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total Employees:
                        <?php
                        $host = 'localhost';
                        $username = 'root';
                        $password = 'admin';
                        $database = 'employee_db';

                        $conn = mysqli_connect($host, $username, $password, $database);

                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $query = "SELECT COUNT(*) AS totalEmployees FROM employee";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $totalEmployees = $row['totalEmployees'];
                            echo $totalEmployees;
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                        ?>
                    </span>
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <a href="/insert_employee.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-blue-400 rounded">Add New</a>
                        <a href="/list_employees.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-green-400 rounded">View All Employees</a>
                    </div>
                </div>
            </div>

            <div class="w-full m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4"></div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/assets/dept.png" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Department information</h5>
                    <!-- <span class="text-sm text-gray-500 dark:text-gray-400">Total Employees: </span> -->
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <a href="/insert_dept.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-blue-400 rounded">Add New</a>
                        <a href="/list_dept.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-green-400 rounded">View All Departments</a>
                    </div>
                </div>
            </div>

            <div class="w-full m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4"></div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/assets/address.png" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Address information</h5>
                    <!-- <span class="text-sm text-gray-500 dark:text-gray-400">Total Employees: </span> -->
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <a href="/insert_address.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-blue-400 rounded">Add New</a>
                        <a href="/list_address.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-green-400 rounded">View All Addresses</a>
                    </div>
                </div>
            </div>


            <div class="w-full m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4"></div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/assets/project.png" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Project information</h5>
                    <!-- <span class="text-sm text-gray-500 dark:text-gray-400">Total Employees: </span> -->
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <a href="/insert_project.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-blue-400 rounded">Add New</a>
                        <a href="/list_project.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-green-400 rounded">View All Projects</a>
                    </div>
                </div>
            </div>

            <div class="w-full m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4"></div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/assets/ft_pt_work.png" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">FT / PT Work Information</h5>
                    <!-- <span class="text-sm text-gray-500 dark:text-gray-400">Total Employees: </span> -->
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <a href="/insert_ft_pt_work.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-blue-400 rounded">Add New</a>
                        <a href="/list_ft_pt_work.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-green-400 rounded">View All informatino</a>
                    </div>
                </div>
            </div>

            <div class="w-full m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4"></div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/assets/salary.png" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Salary Information</h5>
                    <!-- <span class="text-sm text-gray-500 dark:text-gray-400">Total Employees: </span> -->
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <a href="/insert_salary.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-blue-400 rounded">Add New</a>
                        <a href="/list_salary.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-green-400 rounded">View All Salary info</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="flex flex-col items-center justify-center px-24">
            <div class="underline text-3xl">Queries</div>
            <ol class="m-10 mb-36 pl-5 space-y-1 list-decimal list-inside">
                <li>
                    <a class="hover:underline text-lg" href="/query_1.php">List the names of all Engineers in Googong Subdivision project located at Googong city</a>
                </li>
                <li>
                    <a class="hover:underline text-lg" href="/query_2.php">List the names of all Labour in Googong Subdivision project located at Googong city who work more than 20 hours per week</a>
                </li>
                <li>
                    <a class="hover:underline text-lg" href="/query_3.php">Retrieve the names and addresses of all employees who work on at least one project located in Burton Canberra but whose department has no location in Canberra.</a>
                </li>
                <li>
                    <a class="hover:underline text-lg" href="/query_4.php">Retrieve the names of employees who work on both the Googong Subdivision and Burton Highway project</a>
                </li>
                <li>
                    <a class="hover:underline text-lg" href="/query_5.php">Lists out the emp_name, dept_name, type_of_work, basic, deduction, net_salary from the above relational databases.</a>
                </li>
            </ol>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>