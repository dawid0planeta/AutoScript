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
    <title>AutoScript</title>
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php $this->render('logged_in_navbar');?>
    <?php else: ?>
        <?php $this->render('logged_out_navbar');?>
    <?php endif; ?>
    <div class="background">
        <div class="big-logo"><p>AutoScript</p></div>
        <div class="center-box" id="landing-center-box">
            <div class="box-title"><p>Automate your life and business</p></div>
            <div class="box-content">
                <p>Browse 1000+ scripts and automation snippets
                for professional tools such as Adobe Photoshop and Illustrator
                </p>
                <hr>
                <p>Sell your scripts to help other people</p>
            </div>
            <div class="box-buttons">
                <form class="btn-form" action="/register">
                    <button class="btn box-btn btn-primary">Sign Up</button>
                </form>
                <form class="btn-form" action="/catalog">
                    <button class="btn box-btn btn-call">Browse</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>