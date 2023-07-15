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
            <a class="inline-block rounded bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-[2px] hover:text-white focus:outline-none focus:ring active:text-opacity-75" href="/">
                <span class="block rounded-sm bg-white px-8 py-3 text-sm font-medium hover:bg-transparent">
                    Back to home
                </span>
            </a>


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
                            echo '<td class="whitespace-nowrap px-4 py-2 text-gray-700"><a class="font-bold text-blue-500"  href="/update_address.php?emp_id=' . $row["emp_id"] . '"> Update </a><a class="font-bold text-red-500" href="?delete_id=' . $row["emp_id"] . '"> Delete </a></td>';
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