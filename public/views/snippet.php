<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
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
        <div class="snippet-view">
            <div class="snippet-header">
                <div class="snippet-info">
                    <div class="snippet-title">
                        <p><?= $snippet->getTitle();?></p>
                    </div>
                    <div class="snippet-author">
                        <p>by <?= $snippet->getAuthorName();?></p>
                    </div>
                </div>
                <img src="/public/img/<?= $snippet->getPlatform();?>.svg" alt="<?= $snippet->getPlatform();?>"/>
            </div>
            <div class="snippet-view-text">
                <h3>Description</h3>
                <p><?= $snippet->getDescription();?></p>
            </div>
            <div class="snippet-view-text">
                <h3>Instruction</h3>
                <p><?= $snippet->getInstruction();?></p>
            </div>
            <div class="box-buttons" id="snippet-view-buttons">
                <form class="btn-form" action="/download_snippet/<?= $snippet->getId();?>">
                    <button class="btn box-btn btn-primary">Download</button>
                </form>
                <?php if ($show_delete): ?>
                <form class="btn-form" action="/delete_snippet/<?= $snippet->getId();?>">
                    <button class="btn box-btn btn-call">Remove</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>