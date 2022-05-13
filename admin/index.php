<?php
include("../config/dbconnect.php");
session_start();
if (!isset($_SESSION['user'])) {
    Header('Location: login.php');
    exit();
}
if (isset($_SESSION["error_message"])) {
    $message = $_SESSION["error_message"];
    echo  '<script>alert("' . $message . '")</script>';
    $_SESSION["error_message"] = null;
}
$imageUrl = null;
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES['image']) && isset($_FILES['image']['size']) > 0) {
            $fileName = $_FILES["image"]["name"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $imageExtension = explode('.', $fileName);
            $imageUrl = "/uploads/images/" . uniqid() . "." . $imageExtension[1];
            move_uploaded_file($tmpName, ".." . $imageUrl);
        } else {
            $imageUrl = "/uploads/images/missing-available.jpg";
        }

        $query = "INSERT INTO `blogs` (`title`,`content`,`createdAt`,`imageUrl`) 
            VALUES (
                '$_POST[title]',
                '$_POST[content]',
                current_timestamp(),
                '$imageUrl'
                )
            ";
        $imageUrl = null;
        $connection->query($query);
    }
} catch (\Throwable $th) {
    echo "<script>alert('Blog Eklenemedi')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .add-form {
            margin-right: auto;
            margin-left: auto;
            padding: 10px;
        }

        .titleText {
            font-weight: bold;
            font-size: 24px;
            margin-top: 14px;
            text-align: center;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-light" style="border: 1px solid black;">
        <div class="container-fluid" style="display: flex; justify-content:center">
            <span class="navbar-brand mb-0 h1" style="font-weight: bold;font-size: 24px;">Admin Panel</span>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-6" style="margin-left: auto;margin-right:auto;">
                <div class="titleText">Yazı Ekle</div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="title">Başlık : </span>
                        <input id="title" type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Resim :</label>
                        <input id="image" type="file" name="image" accept="image/png, image/gif, image/jpeg">
                    </div>
                    <input type="submit" value="Kaydet" class="btn btn-primary">
                </form>
            </div>
            <!-- <div class="col-6">
                <div class="titleText">Yazılar</div>
                <div class="row justify-content-evenly">
                    <div class="col-4" style="padding: 5px;">
                        <div class="card" style="width: 14rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-wrap">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" style="padding: 5px;">
                        <div class="card" style="width: 14rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-wrap">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div> -->
        </div>
    </div>




    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>