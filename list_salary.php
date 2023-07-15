<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <?php
    $host = 'localhost';
    $username = 'root';
    $password = 'admin';
    $database = 'employee_db';
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete salary
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $sql = "DELETE FROM salary WHERE emp_no = '$deleteId'";
        if (mysqli_query($conn, $sql)) {
            echo "Salary record deleted successfully.";
            // Redirect to clear the query parameter
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting salary record: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>

    <div class="p-24">
        <div>
            <a class="inline-block rounded bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-[2px] hover:text-white focus:outline-none focus:ring active:text-opacity-75" href="/">
                <span class="block rounded-sm bg-white px-8 py-3 text-sm font-medium hover:bg-transparent">
                    Back to home
                </span>
            </a>

        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Employee Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Basic Salary
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Allowance
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deduction
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Net Salary
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Salary Date
                        </th>
                        <!-- <th scope="col" class="px-6 py-3">
                            Actions
                        </th> -->
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
                    // fetch data from salary table
                    $sql = "SELECT * FROM salary";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4">' . $row["emp_no"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["basic"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["allowance"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["deduction"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["net_salary"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["salary_date"] . '</td>';
                            // echo '<td class="px-6 py-4"><a href="?delete_id=' . $row["emp_no"] . '"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg> </a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 results</td></tr>";
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