<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: #f9f9f9;
    color: #333;
}

.container {
    text-align: center;
    padding: 20px;
}

.error-content h1 {
    font-size: 120px;
    color: #050097;
    margin-bottom: 10px;
}

.error-content h2 {
    font-size: 24px;
    color: #333399;
    margin-bottom: 15px;
}

.error-content p {
    font-size: 16px;
    color: #666;
    margin-bottom: 30px;
}

.home-button {
    padding: 12px 25px;
    background-color: #050097;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.home-button:hover {
    background-color: #333399;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="error-content">
            <h1>404</h1>
            <h2>Oops! Page Not Found</h2>
            <p>The page you're looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
            <button class="home-button" onclick="closeLoginForm()">Go Back</button>
        </div>
    </div>

    <script>
        function closeLoginForm() {
            window.history.back();
        }
    </script>
</body>
</html>
