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
    <title>Register Page</title>
</head>
<body>
    <?php $this->render('logged_out_navbar');?>
    <div class="background">
        <div class="center-box">
            <div class="box-title"><p>Register</p></div>
            <form action="register" method="post">
                <div class="dual-box-content">
                    <div class="box-content">
                        <input name="email" type="text" placeholder="email@email.com">
                        <input name="password" type="password" placeholder="password">
                        <input name="repeat_password" type="password" placeholder="repeat password">
                        <label><input type="checkbox" name="consent" value="consent">I agree to selling my soul</label>
                    </div>
                    <div class="box-content">
                        <p>Choose platforms you use:</p>
                        <select name="platform1">
                            <option value="windows">Windows</option>
                            <option value="linux">Linux</option>
                            <option value="macos">MacOS</option>
                            <option value="photoshop">Adobe Photoshop</option>
                            <option value="illustrator">Adobe illustrator</option>
                        </select>
                        <select name="platform2">
                            <option value="windows">Windows</option>
                            <option value="linux">Linux</option>
                            <option value="macos">MacOS</option>
                            <option value="photoshop">Adobe Photoshop</option>
                            <option value="illustrator">Adobe illustrator</option>
                        </select>
                        <select name="platform3">
                            <option value="windows">Windows</option>
                            <option value="linux">Linux</option>
                            <option value="macos">MacOS</option>
                            <option value="photoshop">Adobe Photoshop</option>
                            <option value="illustrator">Adobe illustrator</option>
                        </select>
                    </div>
                </div>
                <div class="box-buttons">
                    <button type="submit" class="btn box-btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>