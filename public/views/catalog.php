<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Snippet Catalog</title>
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php $this->render('logged_in_navbar');?>
    <?php else: ?>
        <?php $this->render('logged_out_navbar');?>
    <?php endif; ?>
    <div class="background-long">
        <div class="gallery-container">
            <div class="search">
                <input name="search" type="text" placeholder="Search...">
                <img src="public/img/search.svg" alt="search icon">
            </div>
            <div class="snippet-gallery">
                <ul class="snippet-container">
                <?php foreach ($snippets as $snippet): ?>
                    <li>
                        <div class="snippet">
                            <div class="snippet-header">
                                <div class="snippet-info">
                                    <div class="snippet-title">
                                        <p><?= $snippet->getTitle();?></p>
                                    </div>
                                    <div class="snippet-author">
                                        <p>by <?= $snippet->getAuthorName();?></p>
                                    </div>
                                </div>
                                <img src="public/img/<?= $snippet->getPlatform();?>.svg" alt="<?= $snippet->getPlatform();?>"/>
                            </div>
                            <div class="snippet-description">
                                <p><?= $snippet->getDescription();?></p>
                            </div>
                            <div class="snippet-show-more">
                                <a href="/snippet/<?= $snippet->getId();?>">Show more</a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

<template id=snippet-template>
    <li>
        <div class="snippet">
            <div class="snippet-header">
                <div class="snippet-info">
                    <div class="snippet-title">
                        <p id="title">title</p>
                    </div>
                    <div class="snippet-author">
                        <p id="author-name">by author_name</p>
                    </div>
                </div>
                <img src="" alt=""/>
            </div>
            <div class="snippet-description">
                <p id="description">description</p>
            </div>
            <div class="snippet-show-more">
                <a href="#">Show more</a>
            </div>
        </div>
    </li>
</template>