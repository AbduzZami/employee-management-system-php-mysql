<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    // Create the address table
    function createAddress($conn)
    {
        $emp_id = $_POST['emp_id'];
        $street_no = $_POST['street_no'];
        $street_name = $_POST['street_name'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];

        $sql = "INSERT INTO address (emp_id, street_no, street_name, city, zip_code) VALUES ('$emp_id', '$street_no', '$street_name', '$city', '$zip_code')";

        // if address table does not exist, then create the table
        $sql_create = "CREATE TABLE IF NOT EXISTS address (
            emp_id INT PRIMARY KEY,
            street_no VARCHAR(100),
            street_name VARCHAR(100),
            city VARCHAR(100),
            zip_code VARCHAR(10),
            FOREIGN KEY (emp_id) REFERENCES employee(emp_id)
          )";
        if (mysqli_query($conn, $sql_create)) {
            // echo "<script>alert('Table created successfully')</script>";
        } else {
            echo "<script>alert('Error creating table: " . mysqli_error($conn) . "')</script>";
        }

        // if emp_id exists in the table, then do not write to the table
        $sql_check = "SELECT * FROM address WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Emp ID already exists " . mysqli_error($conn) . "')</script>";
            return;
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
            header_remove();
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id']) && isset($_POST['street_no']) && isset($_POST['street_name']) && isset($_POST['city']) && isset($_POST['zip_code'])) {
        createAddress($conn);
        // header("Location: insert_address.php");
        // exit();
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <div class="flex flex-wrap">
        <div class="flex h-screen w-16 flex-col justify-between border-e bg-white">
            <div>
                <div class="inline-flex h-16 w-16 items-center justify-center">
                    <span class="grid h-10 w-10 place-content-center rounded-lg bg-gray-100 text-xs text-gray-600">
                        L
                    </span>
                </div>

                <div class="border-t border-gray-100">
                    <div class="px-2">
                        <div class="py-4">
                            <a href="/" class="t group relative flex justify-center rounded bg-blue-50 px-2 py-1.5 text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>


                                <span class="absolute start-full top-1/2 ms-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100">
                                    Dashboard
                                </span>
                            </a>
                        </div>

                        <ul class="space-y-1 border-t border-gray-100 pt-4">
                            <li>
                                <a href="" class="group relative flex justify-center rounded px-2 py-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                    </svg>


                                    <span class="absolute start-full top-1/2 ms-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100">
                                        Filter
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="" class="group relative flex justify-center rounded px-2 py-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                    </svg>


                                    <span class="absolute start-full top-1/2 ms-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100">
                                        Queries
                                    </span>
                                </a>
                            </li>

                            <!-- <li>
                                <a href="" class="group relative flex justify-center rounded px-2 py-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>

                                    <span class="absolute start-full top-1/2 ms-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100">
                                        Invoices
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="" class="group relative flex justify-center rounded px-2 py-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>

                                    <span class="absolute start-full top-1/2 ms-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100">
                                        Account
                                    </span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="sticky inset-x-0 bottom-0 border-t border-gray-100 bg-white p-2">
                <form action="/logout">
                    <button type="submit" class="group relative flex w-full justify-center rounded-lg px-2 py-1.5 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>

                        <span class="absolute start-full top-1/2 ms-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100">
                            Logout
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <div style="width:calc(100vw - 100px);">

            <h1 class="text-3xl text-left font-bold m-20">
                Insert an Address
            </h1>
            <div class="m-8 ml-20 flex justify-start">
                <form onsubmit="createAddress()" method="POST">
                    <div class="flex flex-wrap w-full "><input class="m-1 outline-none w-42" type="text" name="emp_id" id="emp_id" placeholder=" Employee ID" required> <br>
                        <input class="m-1 outline-none" type="text" name="street_no" id="street_no" placeholder=" Street No" required> <br>
                    </div>
                    <input class="m-1 outline-none w-full" type="text" name="street_name" id="street_name" placeholder=" Street Name" required> <br>
                    <div class="flex flex-wrap w-full ">
                        <input class="outline-none m-1" type="text" name="city" id="city" placeholder=" City" required> <br>
                        <input class="outline-none m-1" type="text" name="zip_code" id="zip_code" placeholder=" Zip Code" required> <br>
                    </div>
                    <div class="flex  justify-center">
                        <a class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500" href="/insert_employee.php" type="submit" value="Submit">Insert</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
        function createAddress() {
            // Functionality handled by PHP code
        }
    </script>
</body>

</html>