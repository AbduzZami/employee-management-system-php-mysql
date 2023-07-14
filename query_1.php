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
            <a href="index.php" class="hover:underline italic">Back to Home</a>
        </div>
        <div id="alert-additional-content-3" class="p-3 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
            <div class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">Query 1</h3>
            </div>
            <div class="mt-2 mb-4 text-lg font-bold">
            List the names of all Engineers in Googong Subdivision project located at Googong city
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
                            Project Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Project Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
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

                    $query = "SELECT e.emp_id AS 'Employee ID', e.emp_name AS 'Employee Name', p.project_name AS 'Project Name', p.project_location AS 'Project Location', d.dept_name AS 'Department'
                            FROM employee e
                            JOIN ft_pt_work fpw ON e.emp_id = fpw.emp_id
                            JOIN project p ON fpw.project_id = p.project_id
                            JOIN dept d ON e.dept_id = d.dept_id
                            WHERE e.dept_id = (
                                SELECT dept_id
                                FROM dept
                                WHERE dept_name = 'Engineering'
                            )
                            AND p.project_name = 'Googong Subdivision'
                            AND p.project_location = 'Googong'";

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4">' . $row["Employee ID"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Employee Name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Project Name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Project Location"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Department"] . '</td>';
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