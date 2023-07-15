<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data</title>

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
            <strong class="block font-medium text-blue-800"> Query 2 </strong>

            <p class="mt-2 text-sm text-blue-700">
                List the names of all Labour in Googong Subdivision project located at Googong city who work more than 20 hours per week
            </p>
        </div>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Employee Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Employee ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Project Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Number of Working Hours
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

                    $project_name = $_GET['project_name'];
                    $dept_name = $_GET['dept_name'];
                    $project_location = $_GET['project_location'];
                    $start_date =
                        $_GET['start_date'];
                    $end_date =
                        $_GET['end_date'];

                    $query = "SELECT e.emp_name AS 'Employee Name', e.emp_id AS 'Employee ID', d.dept_name AS 'Department', p.project_name AS 'Project Name', SUM(fpw.num_of_hours) AS 'Total Work Hours'
                                FROM employee e
                                JOIN ft_pt_work fpw ON e.emp_id = fpw.emp_id
                                JOIN dept d ON e.dept_id = d.dept_id
                                JOIN project p ON fpw.project_id = p.project_id
                                WHERE d.dept_name = '$dept_name'
                                AND p.project_name = '$project_name'
                                AND p.project_location = '$project_location'
                                -- AND fpw.num_of_hours > 1
                                AND fpw.work_date >= '$start_date' -- Replace 'start_date' with the actual start date
                                AND fpw.work_date <= '$end_date' -- Replace 'end_date' with the actual end date
                                GROUP BY e.emp_name, e.emp_id, d.dept_name, p.project_name
                                ";

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4">' . $row["Employee Name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Employee ID"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Department"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Project Name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Total Work Hours"] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='5'>No results found.</td></tr>";
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