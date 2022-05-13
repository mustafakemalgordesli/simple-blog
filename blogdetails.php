<?php
include("./config/dbconnect.php");
$row = null;
if (isset($_GET["id"])) {
    $sql = "SELECT * FROM blogs Where id = " . $_GET["id"];
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header('Location: localhost/simple-blog/');
        exit();
    }
} else {
    header('Location: localhost/simple-blog/');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
    <div class="container container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-6 card p-5" style="border: 0px">
                <?php echo '<img src=".' . $row['imageUrl'] . '" class="card-img-top img-fluid" alt="">' ?>
                <div class="card-body">
                    <h5 class="card-title blogTitle text-center">
                        <?= $row['title'] ?>
                    </h5>
                    <p class="card-text mb-3 text-center"> <?= $row['content'] ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>