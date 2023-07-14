<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address List</title>

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

    // Delete address
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $sql = "DELETE FROM address WHERE emp_id = '$deleteId'";
        if (mysqli_query($conn, $sql)) {
            echo "Address deleted successfully.";
            // Redirect to clear the query parameter
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting address: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>

    <div class="p-24">
        <div>
            <a href="index.php" class="hover:underline italic">Back to Home</a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th scope="col" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Employee ID
                        </th>
                        <th scope="col" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Street No
                        </th>
                        <th scope="col" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Street Name
                        </th>
                        <th scope="col" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            City
                        </th>
                        <th scope="col" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Zip Code
                        </th>
                        <th scope="col" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    $host = 'localhost';
                    $username = 'root';
                    $password = 'admin';
                    $database = 'employee_db';

                    $conn = mysqli_connect($host, $username, $password, $database);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    // fetch data from address table
                    $sql = "SELECT * FROM address";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="odd:bg-gray-50">';
                            echo '<td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">' . $row["emp_id"] . '</td>';
                            echo '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $row["street_no"] . '</td>';
                            echo '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $row["street_name"] . '</td>';
                            echo '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $row["city"] . '</td>';
                            echo '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $row["zip_code"] . '</td>';
                            echo '<td class="whitespace-nowrap px-4 py-2 text-gray-700"><a href="?delete_id=' . $row["emp_id"] . '"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg> </a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='6'>0 results</td></tr>";
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