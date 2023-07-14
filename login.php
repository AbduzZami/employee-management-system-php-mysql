<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <script>
        // Check if the session is already set in localStorage
        if (localStorage.getItem('logged_in')) {
            // Redirect to the private page
            window.location.href = 'private_page.php';
        }

        function handleLogin(event) {
            event.preventDefault();

            // Get the form input values
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Perform the authentication check against a database table
            // Replace with your authentication logic (e.g., an AJAX request)

            // Simulate authentication success
            const validCredentials = true;

            if (validCredentials) {
                // Set the session variable in localStorage
                localStorage.setItem('logged_in', 'true');

                // Redirect to the private page
                window.location.href = 'private_page.php';
            } else {
                // Display an error message if the credentials are invalid
                const error = document.getElementById('error');
                error.textContent = 'Invalid username or password';
            }
        }
    </script>
    <?php
    session_start();

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate the user's credentials
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Perform the authentication check against a database table
        $host = 'localhost';
        $username_db = 'root';
        $password_db = 'admin';
        $database = 'employee_db';

        $conn = mysqli_connect($host, $username_db, $password_db, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Authentication successful
            $_SESSION['logged_in'] = true;
            header("Location: index.php");
            exit();
        } else {
            // Invalid credentials
            $error = "Invalid username or password";
        }

        mysqli_close($conn);
    }
    ?>
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-md rounded px-8 py-10">
            <h2 class="text-2xl font-bold mb-6">Login</h2>
            <?php if (isset($error)) : ?>
                <div class="text-red-500 mb-4"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>