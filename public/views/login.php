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
    <title>Login Page</title>
</head>
<body>
    <?php $this->render('logged_out_navbar');?>
    <div class="background">
        <div class="center-box">
            <div class="box-title"><p>Login</p></div>
            <form action="/login" method="POST">
                <div class="box-content">
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                </div>
                <div class="box-buttons">
                    <button type="submit" class="btn box-btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>