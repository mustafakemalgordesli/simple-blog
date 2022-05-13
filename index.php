<?php
include("./config/dbconnect.php");
$GLOBALS["counter"] = 0;
$sql = "SELECT * FROM blogs";
$result = $connection->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .blogTitle {
            font-size: 24px;
            font-weight: 400;
        }

        @media only screen and (min-width: 997px) {
            .container-lg {
                min-width: 100%
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-light" style="border: 1px solid black;">
        <div class="container-fluid" style="display: flex; justify-content:center">
            <span class="navbar-brand mb-0 h1" style="font-weight: bold;font-size: 24px;">My Personel Blog</span>
        </div>
    </nav>


    <div class="container container-lg">
        <?php
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                if ($GLOBALS["counter"] == 0) {
                    echo '<div class="row justify-content-evenly">';
                }
                if ($GLOBALS["counter"] % 3 == 0 && $GLOBALS["counter"] != 0) {
                    echo '</div>';
                    echo '<div class="row justify-content-evenly">';
                    echo '<div class="col-lg-3 card m-3 p-3">
                            <img src=".' . $row['imageUrl'] . '" class="card-img-top img-fluid" alt="">
                            <div class="card-body">
                                <h5 class="card-title blogTitle">' .
                        $row["title"]
                        . '</h5>
                                <p class="card-text mb-3">' . substr($row["content"], 0, 100) . '... </p>
                                <a href="blogdetails.php?id=' . $row["id"] . '" class="btn btn-primary read-m">Read More</a>
                            </div>
                        </div>';
                    $GLOBALS["counter"] = $GLOBALS["counter"] + 1;
                } else {
                    echo '<div class="col-lg-3 card m-3 p-3">
                            <img src=".' . $row['imageUrl'] . '" class="card-img-top img-fluid" alt="">
                            <div class="card-body">
                                <h5 class="card-title blogTitle">' .
                        $row["title"]
                        . '</h5>
                                <p class="card-text mb-3">' . substr($row["content"], 0, 100) . '... </p>
                                <a href="blogdetails.php?id=' . $row["id"] . '" class="btn btn-primary read-m">Read More</a>
                            </div>
                        </div>';
                    $GLOBALS["counter"] = $GLOBALS["counter"] + 1;
                }
            }
            $GLOBALS["counter"] = 0;
            echo '</div>';
        } else {
        }
        ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>