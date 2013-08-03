SimpleCaptcha
=============

SimpleCaptcha is a simple Catcha written in PHP. 
While it can be used with very little effort, it is 
still secure enough for everyday use.

In constrast to other captchas, for instance those provided by Google, 
captchas created by SimpleCaptcha are easily readable by 
humans. 

## Example Captcha
![Sample Captcha](https://raw.github.com/foobar-design/SimpleCaptcha/master/img/sample.png "Sample Captcha")


## How to use SimpleCaptcha
1. load SimpleCaptcha.php
   ```
   include("SimpleCaptcha.php");
   ```

2. Create an instance of SimpleCaptcha<br/>
   ```
   $captcha = new SimpleCaptcha();  
   ```

3. Create the challenge<br/>
   ```
   $captcha->createChallenge(6);
   ```

4. Output the captcha<br/>
   ```
   $captcha->outputChallenge();
   ```

5. Use
   ```
   if (@$_POST["submit"] && $captcha->verifyCode($_POST["key"], $_POST["challenge"])) {
    // all good here!
   }
   ```
   to verify the input of the user

6. Embed this into your form and you are done!



Reloading SimpleCaptcha with JQuery
===================================
In order to request another captcha without 
reloading the entire form, proceed as follows:

1. Add the following two lines to the header of your HTML-File<br/>
   ```
   <script type='text/javascript' src='http://code.jquery.com/jquery-latest.min.js'></script>
   <script type='text/javascript' src='simplecaptcha.js'></script>    
   ```

2. Add a link with id = reloadSimpleCaptcha<br/>
   ```
   <a href="" id="reloadSimpleCaptcha">New captcha</a>
   ```

3. Done!


Version History
===============
version 0.1 (August 03, 2013)<br/>
    - Initial release
