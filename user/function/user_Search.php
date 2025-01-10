<?php
session_start();
include_once("../config/user_config.php");

// validate input search text and split into keywords using explode function
$search_text = '';
if (!empty($_POST["search_text"])) {
    $search_text = trim($_POST["search_text"]);
}

$keywords = explode(" ", $search_text);

// initialize SQL query search conditions using an array
$search_conditions = [];
foreach ($keywords as $keyword) {
    if (!empty($keyword)) {
        $search_conditions[] = "productName LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'";
    }
}

// execute SQL query based on search conditions and display the results
$sql = "SELECT * FROM product WHERE " . implode(" OR ", $search_conditions);
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DELETE PRODUCT</title>
    
    <!-- cdn icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- css file -->
    <link rel="stylesheet" href="../css/user_Style.css">
</head>
<body>

    <div id='searchMessage'>
        <p>SEARCH RESULT:</p>
    </div>

    <div class='searchResult-container'>
        <?php
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;" . "<a class='searchResult' href='" . BASE_URL . "/user/pages/menu/productPortfolio.php?id=" . htmlspecialchars($row['productID']) . "'>" . htmlspecialchars($row['productName']) . "</a><br>";
                }
            } else {
                echo "<p>Sorry, no result for '" . htmlspecialchars($search_text) . "'</p>";
            }
        } else {
            echo "<p>Error executing query: " . mysqli_error($conn) . "</p>";
        }
        ?>
        <br><a class='homePage-link' href='<?php echo BASE_URL; ?>'>Back to SUGAR RUSH</a>
    </div>

</body>
</html>