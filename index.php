<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['dbHost'] = 'localhost'; 
    $_SESSION['dbName'] = 'tienda'; 
    $_SESSION['dbUser'] = $_POST['dbUser']; 
    $_SESSION['dbPass'] = $_POST['dbPass']; 

    header("Location: setup.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factureasy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/output.css">
    <link rel="shortcut icon" href="/public/assets/favicon.ico">

</head>
<body class="bg-black flex flex-col items-center justify-center h-screen">

    <div class="flex justify-center mb-6">
        <object
            data="/public/assets/Factureasy.svg"
            type="image/svg+xml"
            class="w-40"
        ></object>
    </div>
    
    <div class="bg-gray-800 rounded-lg shadow-lg p-8 w-96">
        <h2 class="text-white text-2xl text-center mb-6">Enter Credentials</h2>
        
        <form action="index.php" method="post">
            <div class="mb-4">
                <label for="dbUser" class="block text-white mb-2">MySQL Username:</label>
                <input type="text" name="dbUser" value="root" required class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:border-purple-500">
            </div>

            <div class="mb-6">
                <label for="dbPass" class="block text-white mb-2">MySQL Password:</label>
                <input type="password" name="dbPass" required class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:border-purple-500">
            </div>

            <div class="mb-4">
                <label for="username" class="block text-white mb-2">Username:</label>
                <input type="text" name="username" required class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:border-purple-500">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-white mb-2">Password:</label>
                <input type="password" name="password" required class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:border-purple-500">
            </div>
            
            <input type="submit" value="Login" class="w-full bg-purple-600 font-semibold text-white py-2 px-4 rounded-md hover:bg-purple-700 focus:outline-none transition duration-200">
        </form>
    </div>

</body>
</html>
