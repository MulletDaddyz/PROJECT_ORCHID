<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0e0e0; 
            color: #333; 
        }

    
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #555; 
            color: white;
            padding: 15px 30px;
        }

        header a.logo {
            text-decoration: none;
            color: white;
            font-size: 30px; 
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        header a.logo img {
            height: 80px; 
            width: 80px;
            margin-right: 15px;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-size: 18px; /* Slightly larger text for nav */
            padding: 8px 15px;
        }

        nav a:hover {
            background-color: #777; /* Hover effect for nav links */
            border-radius: 5px;
        }

        /* Main Container */
        .container {
            padding: 50px 20px;
            text-align: center;
            max-width: 1200px;
            margin: auto;
        }

        .container h1 {
            font-size: 38px;
            margin-bottom: 20px;
            color: #444; /* Slightly darker grey for headings */
        }

        .container p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        /* Buttons */
        button {
            background-color: #5a5a5a; /* Grey button background */
            color: white;
            padding: 15px 25px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        button:hover {
            background-color: #444; /* Darker grey hover for buttons */
        }

        /* Search Bar */
        .search-bar {
            margin: 20px auto 40px;
            display: flex;
            justify-content: center;
        }

        .search-bar input[type="text"] {
            padding: 12px;
            font-size: 16px;
            width: 350px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar button {
            background-color: #444; /* Matching button color with theme */
            color: white;
            padding: 12px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-bar button:hover {
            background-color: #222; /* Even darker hover effect */
        }
    </style>
</head>
<body>
    <header>
        
        <a href="home.php" class="logo">
            <img src="logo.png" alt="Logo">
            Recondition House
        </a>

        <!-- Navigation links -->
        <nav>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        </nav>
    </header>

    <div class="container">
        <h1>Welcome to the Online Recondition House</h1>
        <p>Your one-stop solution for buying and selling reconditioned bikes and cars.</p>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Search cars or bikes..." id="search">
            <button onclick="performSearch()">Search</button>
        </div>

        <!-- Action Buttons -->
        <button onclick="location.href='buy.php'">Explore Buy Options</button>
        <button onclick="location.href='sell.php'">Sell Your Vehicle</button>
    </div>

    <script>
        function performSearch() {
            const searchQuery = document.getElementById('search').value;
            if (searchQuery.trim()) {
                alert(`Searching for: ${searchQuery}`);
                // Logic for search functionality can be added here.
            } else {
                alert('Please enter a search query.');
            }
        }
    </script>
</body>
</html>
