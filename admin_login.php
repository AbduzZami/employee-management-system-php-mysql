<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <?php
    // Replace these variables with your actual admin credentials
    $adminUsername = 'admin';
    $adminPassword = 'admin';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the provided credentials match the admin's credentials
        if ($username === $adminUsername && $password === $adminPassword) {
            // Successful login, redirect to admin panel or homepage
            header('Location: index.php'); // Replace with the actual admin panel page
            exit();
        } else {
            // Invalid credentials, show an error message
            echo '<div class="text-red-500 mb-4">Invalid username or password. Please try again.</div>';
        }
    }
    ?>

    <div class="bg-white w-1/3 p-6 shadow-md rounded">
        <h2 class="text-2xl font-semibold mb-4">Admin Login</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username:</label>
                <input type="text" id="username" name="username" required class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Login</button>
        </form>
    </div>
</body>

</html>