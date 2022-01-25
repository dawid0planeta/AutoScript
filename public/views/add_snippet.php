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
    <title>Add new snippet</title>
</head>
<body>
    <?php $this->render('logged_in_navbar');?>
    <div class="background">
        <div class="center-box">
            <div class="box-title"><p>Add new snippet</p></div>
            <form>
                <div class="dual-box-content">
                    <div class="box-content">
                        <input name="title" type="text" placeholder="Title">
                        <textarea placeholder="Description"></textarea>
                        <textarea placeholder="Instruction"></textarea>
                    </div>
                    <div class="box-content">
                        <p>Choose platforms</p>
                        <select name="platforms" id="platforms1">
                            <option value="windows">Windows</option>
                            <option value="linux">Linux</option>
                            <option value="macos">MacOS</option>
                            <option value="photoshop">Adobe Photoshop</option>
                            <option value="illustrator">Adobe illustrator</option>
                        </select>
                        <select name="platforms" id="platforms2">
                            <option value="windows">Windows</option>
                            <option value="linux">Linux</option>
                            <option value="macos">MacOS</option>
                            <option value="photoshop">Adobe Photoshop</option>
                            <option value="illustrator">Adobe illustrator</option>
                        </select>
                        <p>Add screenshots:</p>
                        <label class="border-label"><input type="file" id="screenshot_file" name="screenshot_file">+</label>
                        <p>Add snippet:</p>
                        <label class="border-label"><input type="file" id="snippet_file" name="snippet_file">+</label>
                    </div>
                </div>
                <div class="box-buttons">
                    <button class="btn box-btn btn-primary"type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>