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

        <div role="alert" class="rounded border-s-4 border-blue-500 bg-blue-50 p-4 my-5">
            <strong class="block font-medium text-blue-800"> Query 3 </strong>

            <p class="mt-2 text-sm text-blue-700">
                Retrieve the names and addresses of all employees who work on at least one project located in Burton Canberra but whose department has no location in Canberra.
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
                            Employee Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Project Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department Address
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

                    $query = "SELECT e.emp_id AS 'Employee ID', e.emp_name AS 'Employee Name', ad.city AS 'Employee Address', p.project_location AS 'Project Location', d.dept_location AS 'Department Address'
                            FROM employee e
                            JOIN ft_pt_work fpw ON e.emp_id = fpw.emp_id
                            JOIN project p ON fpw.project_id = p.project_id
                            JOIN address ad ON e.emp_id = ad.emp_id
                            JOIN dept d ON e.dept_id = d.dept_id
                            WHERE p.project_location = 'Burton'
                            AND d.dept_location != 'Canberra'";

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4">' . $row["Employee ID"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Employee Name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Employee Address"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Project Location"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["Department Address"] . '</td>';
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