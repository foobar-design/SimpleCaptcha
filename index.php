<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SimpleCatpcha - Demonstration</title>
    </head>
    <script type='text/javascript' src='http://code.jquery.com/jquery-latest.min.js'></script>
    <script type='text/javascript' src='simplecaptcha.js'></script>    
    <body>
        <form action="index.php" method="POST">
            
            <?php
 
            include 'SimpleCaptcha.php';
            $captcha = new SimpleCaptcha();            
            if (@$_POST["submit"] && $captcha->verifyCode($_POST["key"], $_POST["challenge"])) {
                echo "Captcha ok<br/><a href=\"index.php\">Nochmal</a>";
            } else {
                $captcha->createChallenge(6);
                ?>

                Name<br/>
                <input type="text" name="name"/> <br/><br/>
                Captcha<br/> 
                <?php 
                    $captcha->outputChallenge();
                ?>
                <input type="text" name="key"/> <a href="" id="reloadSimpleCaptcha">Neu</a>
                <br/><input type="submit" name="submit" value="Absenden"/>
                
                <?php
            }
            ?>               
                
        </form>
    </body>
</html>
