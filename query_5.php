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
            <a class="inline-block rounded bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-[2px] hover:text-white focus:outline-none focus:ring active:text-opacity-75" href="/">
                <span class="block rounded-sm bg-white px-8 py-3 text-sm font-medium hover:bg-transparent">
                    Back to home
                </span>
            </a>

        </div>


        <div role="alert" class="rounded border-s-4 border-blue-500 bg-blue-50 p-4 my-5">
            <strong class="block font-medium text-blue-800"> Query 4 </strong>

            <p class="mt-2 text-sm text-blue-700">
                Lists out the emp_name, dept_name, type_of_work, basic, deduction, net_salary from the above relational databases
            </p>
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