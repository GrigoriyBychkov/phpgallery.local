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
        <input type="text" name="tag" value="<?= $_GET["tag"]?>">
        <input type="submit" name="submit">
    </form>
    <hr>
    <?php include("models/db.php"); ?>

    <?php foreach (Images::getImages() as $img) { ?>
        <div class="image">
            <div>
                <img src="images/img_<?= $img["Id"]?>.<?= $img["extension"]?>" style="width: 100px" alt="">
                <a role="button" class="btn btn-primary btn-sm deleteImg" data-img-id="<?=$img["Id"]?>">x</a>
            </div>

            <div id="image-tags-<?= $img["Id"]?>">
                <?php foreach (Tags::getImageTagsByImageId($img["Id"]) as $tag) { ?>
                    <span class="tag-body badge badge-info">
                        <?= $tag["tag"]?> <span class="deleteTag" data-tag-id="<?=$tag["Id"]?>">x</span>
                    </span>
                <?php } ?>
            </div>

            <span id="tagTemplate" class="tag-body badge badge-info" style="display: none">
                <span class="tagText"></span> <span class="deleteTag">x</span>
            </span>

            <div class="addTagForm">
                Add tag:
                <input type="text" class="addTagText">
                <input type="button"
                       class="addTagButton"
                       data-image-id="<?= $img["Id"]?>"
                       value="Add">
            </div>
            <hr>
        </div>
    <?php } ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload" name="submit">
    </form>
    <hr>
</main>

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>
</body>
</html>