<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary Data</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="p-24">
        <div>
            <a href="index.php" class="hover:underline italic">Back to Home</a>
        </div>

        <div id="alert-additional-content-3" class="p-3 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
            <div class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">Query 5</h3>
            </div>
            <div class="mt-2 mb-4 text-lg font-bold">
                Lists out the emp_name, dept_name, type_of_work, basic, deduction, net_salary from the above relational databases
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Employee ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Employee Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type of Work
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Basic Salary
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deduction
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Net Salary
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $host = 'localhost';
                    $username = 'root';
                    $password = 'admin';
                    $database = 'employee_db';

                    $conn = mysqli_connect($host, $username, $password, $database);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = "SELECT employee.emp_id, employee.emp_name, dept.dept_name, employee.type_of_work, salary.basic, salary.deduction, salary.net_salary 
                              FROM employee, dept, salary
                              WHERE employee.emp_id = salary.emp_no AND employee.dept_id = dept.dept_id
                              ORDER BY employee.emp_id ASC";

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4">' . $row["emp_id"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["emp_name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["dept_name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["type_of_work"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["basic"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["deduction"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["net_salary"] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='7'>No results found.</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>