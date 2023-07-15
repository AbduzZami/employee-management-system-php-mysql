<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Address</title>
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

    function getAddress($conn)
    {
        $emp_id = $_GET['emp_id'];

        $sql = "SELECT * FROM address WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "<script>alert('No address found for the employee ID: $emp_id')</script>";
            return null;
        }
    }

    function updateAddress($conn)
    {
        $emp_id = $_POST['emp_id'];
        $street_no = $_POST['street_no'];
        $street_name = $_POST['street_name'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];

        $sql = "UPDATE address SET street_no = '$street_no', street_name = '$street_name', city = '$city', zip_code = '$zip_code' WHERE emp_id = '$emp_id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Address updated successfully')</script>";
        } else {
            echo "<script>alert('Error updating address: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id']) && isset($_POST['street_no']) && isset($_POST['street_name']) && isset($_POST['city']) && isset($_POST['zip_code'])) {
        updateAddress($conn);
    }

    // Get the address data
    $address = getAddress($conn);

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="container mx-auto mt-20">
        <a class="inline-block rounded bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-[2px] hover:text-white focus:outline-none focus:ring active:text-opacity-75" href="/">
            <span class="block rounded-sm bg-white px-8 py-3 text-sm font-medium hover:bg-transparent">
                Back to home
            </span>
        </a>

        <h1 class="text-3xl text-center text-left font-bold m-20">
            Edit Address
        </h1>

        <div class="m-8 ml-20 flex justify-center">
            <?php if ($address) : ?>
                <form method="POST">
                    <input type="hidden" name="emp_id" value="<?php echo $address['emp_id']; ?>">
                    <input class="m-1 outline-none" type="text" name="street_no" placeholder="Street No" value="<?php echo $address['street_no']; ?>" required> <br>
                    <input class="m-1 outline-none w-full" type="text" name="street_name" placeholder="Street Name" value="<?php echo $address['street_name']; ?>" required> <br>
                    <input class="m-1 outline-none" type="text" name="city" placeholder="City" value="<?php echo $address['city']; ?>" required>
                    <input class="m-1 outline-none" type="text" name="zip_code" placeholder="Zip Code" value="<?php echo $address['zip_code']; ?>" required> <br>
                    <div class="flex justify-center">
                        <button class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500" type="submit">Update</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>