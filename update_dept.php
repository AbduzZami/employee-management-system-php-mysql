<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
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

    function getDepartment($conn)
    {
        $dept_id = $_GET['dept_id'];

        $sql = "SELECT * FROM dept WHERE dept_id = '$dept_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "<script>alert('No department found for the department ID: $dept_id')</script>";
            return null;
        }
    }

    function updateDepartment($conn)
    {
        $dept_id = $_POST['dept_id'];
        $dept_name = $_POST['dept_name'];
        $dept_location = $_POST['dept_location'];

        $sql = "UPDATE dept SET dept_name = '$dept_name', dept_location = '$dept_location' WHERE dept_id = '$dept_id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Department updated successfully')</script>";
        } else {
            echo "<script>alert('Error updating department: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dept_id']) && isset($_POST['dept_name']) && isset($_POST['dept_location'])) {
        updateDepartment($conn);
    }

    // Get the department data
    $department = getDepartment($conn);

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
            Edit Department
        </h1>

        <div class="m-8 ml-20 flex justify-center">
            <?php if ($department) : ?>
                <form method="POST">
                    <input type="hidden" name="dept_id" value="<?php echo $department['dept_id']; ?>">
                    <input class="m-1 outline-none" type="text" name="dept_name" placeholder="Department Name" value="<?php echo $department['dept_name']; ?>" required> <br>
                    <input class="m-1 outline-none" type="text" name="dept_location" placeholder="Department Location" value="<?php echo $department['dept_location']; ?>" required> <br>
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