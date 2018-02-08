
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>PHP Gallery</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">PHP Gallery</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="container">
    <br>
    <br>
    <br>
    <h1>PHP Gallery</h1>

    <form action="/" method="get">
        Search:
        <input type="text" name="tag">
        <input type="submit" name="submit">
    </form>
    <hr>
<?php include("models/db.php"); ?>

<?php foreach (getImages() as $img) { ?>
    <div>
        <img src="images/img_<?= $img["Id"]?>.<?= $img["extension"]?>" style="width: 100px" alt="">
        <a href="delete.php?remove=<?= $img["Id"]?>">remove</a>
    </div>

    <?php foreach (getImageTagsByImageId($img["Id"]) as $tag) { ?>
        <span>
            [<?= $tag["tag"]?> <a href="deleteTag.php?remove=<?=$tag["Id"]?>">x</a>]
        </span>
    <?php } ?>
    <?php foreach (getImageDescByImageId($img["Id"]) as $desc) { ?>
        <span>
            [<?= $desc["desc"]?> <a href="deleteTag.php?remove=<?=$desc["Id"]?>">x</a>]
        </span>
    <?php } ?>

    <form action="addTag.php" method="post">
        Add tag:
        <input type="text" name="tag">
        <input type="hidden" name="imageId" value="<?= $img["Id"]?>">
        <input type="submit" value="Add" name="submit">
    </form>
    <hr>
    <form action="/addDescription.php" method="post">
        Add description:
        <input type="text" name="desc">
        <input type="hidden" name="imageId" value="<?= $img["Id"]?>">
        <input type="submit" value="Add" name="submit">
    </form>
<?php } ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload" name="submit">
    </form>
    <hr>
</main>

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
</body>
</html>
