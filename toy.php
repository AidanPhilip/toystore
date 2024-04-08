<?php   										
// Opening PHP tag

// Include the database connection script
require 'includes/database-connection.php';

// Retrieve the value of the 'toynum' parameter from the URL query string
// i.e., ../toy.php?toynum=0001
$toy_id = $_GET['toynum'];

function get_toy(PDO $pdo, string $id) {
    $sql = "SELECT t.*, m.* 
            FROM toy t
            INNER JOIN manuf m ON t.manid = m.manid
            WHERE t.toynum = :id"; //placeholder
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    
    $toy = $stmt->fetch(PDO::FETCH_ASSOC);

    return $toy;
}
$toy_info = get_toy($pdo, $toy_id);

// Closing PHP tag
?> 

<!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toys R URI</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="header-left">
            <div class="logo">
                <img src="imgs/logo.png" alt="Toy R URI Logo">
            </div>

            <nav>
                <ul>
                    <li><a href="index.php">Toy Catalog</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
        </div>

        <div class="header-right">
            <ul>
                <li><a href="order.php">Check Order</a></li>
            </ul>
        </div>
    </header>

    <main>
        <!-- 
          -- TO DO: Fill in ALL the placeholders for this toy from the db
          -->
        
        <div class="toy-details-container">
            <div class="toy-image">
                <!-- Display image of toy with its name as alt text -->
                <img src="<?= $toy_info['imgSrc'] ?>" alt="<?= $toy_info['name'] ?>">
            </div>

            <div class="toy-details">

                <!-- Display name of toy -->
                <h1><?= $toy_info['name'] ?></h1>

                <hr />

                <h3>Toy Information</h3>

                <!-- Display description of toy -->
                <p><strong>Description:</strong> <?= $toy_info['description'] ?></p>

                <!-- Display price of toy -->
                <p><strong>Price:</strong> $ <?= $toy_info['price'] ?></p>

                <!-- Display age range of toy -->
                <p><strong>Age Range:</strong> <?= $toy_info['agerange'] ?></p>

                <!-- Display stock of toy -->
                <p><strong>Number In Stock:</strong> <?= $toy_info['numinstock'] ?></p>

                <br />

                <h3>Manufacturer Information</h3>

                <!-- Display name of manufacturer -->
                <p><strong>Name:</strong> <?= $toy_info['name'] ?> </p>

                <!-- Display address of manufacturer -->
                <p><strong>Address:</strong> <?= $toy_info['Street'] . ', ' . $toy_info['City'] . ', ' . $toy_info['State'] . ' ' . $toy_info['ZipCode'] ?></p>

                <!-- Display phone of manufacturer -->
                <p><strong>Phone:</strong> <?= $toy_info['phone'] ?></p>

                <!-- Display contact of manufacturer -->
                <p><strong>Contact:</strong> <?= $toy_info['contact'] ?></p>
            </div>
        </div>
    </main>

</body>
</html>
