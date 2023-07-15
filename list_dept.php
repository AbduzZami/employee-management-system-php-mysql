<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dept list</title>

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

    // Delete dept
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $sql = "DELETE FROM dept WHERE dept_id = '$deleteId'";
        if (mysqli_query($conn, $sql)) {
            echo "Dept deleted successfully.";
            // Redirect to clear the query parameter
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting dept: " . mysqli_error($conn);
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
                            Dept ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dept Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dept Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
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
                    // fetch data from dept table
                    $sql = "SELECT * FROM dept";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4">' . $row["dept_id"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["dept_name"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["dept_location"] . '</td>';
                            echo '<td class="whitespace-nowrap px-4 py-2 text-gray-700"><a class="font-bold text-blue-500"  href="/update_dept.php?dept_id=' . $row["dept_id"] . '"> Update </a><a class="font-bold text-red-500" href="?delete_id=' . $row["dept_id"] . '"> Delete </a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
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