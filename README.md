SimpleCaptcha
=============

SimpleCaptcha is a simple Catcha written in PHP. 
While it can be used with very little effort, it is 
still secure enough for everyday use.

In constrast to other captchas, for instance those provided by Google, 
captchas created by SimpleCaptcha are easily readable by 
humans. 



How to use SimpleCaptcha
========================
1. include("SimpleCaptcha.php");

2. Create an instance of SimpleCaptcha<br/>
   $captcha = new SimpleCaptcha();  

3. Create the challenge
   $captcha->createChallenge(6);

4. Output the captcha
   $captcha->outputChallenge();
