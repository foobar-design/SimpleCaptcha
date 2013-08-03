<?php

/**
 * Description of SimpleCaptcha
 *
 * @author Martin
 * @date 08/03/2013
 */
class SimpleCaptcha {
    private static $AES_KEY_HIDDEN = "12345678901234561234567890123451";
    private static $AES_IV_HIDDEN  = "9532654BD781547023AB4FA7723F2FC1";    
    
    private static $ALPHABET = "1234567890ABCDEFGHIKMQRSTPW";
    
    private static $WIDTH = 80;
    private static $HEIGHT = 20;    
    
    private $image;
    private $challenge;
        
    public function createChallenge($length) {
        $code = "";
        for ($i = 0; $i < $length; $i++) {
            $code .= self::$ALPHABET[rand(0, strlen(self::$ALPHABET) - 1)];
        }
    
        $this->image = $this->createImage($code);
        $this->challenge = $this->encrypt($code);
    }
    
    private function createImage($code) {
        $image = imagecreatetruecolor(self::$WIDTH, self::$HEIGHT);
        
        $background = imagecolorallocate($image, 240 + rand(-15, 15), 240 + rand(-15, 15), 240 + rand(-15, 15));
        imagefill($image, 0, 0, $background);
       
        for ($i = 0; $i < 3; $i++) {
            $textColor = imagecolorallocate($image, 78 + rand(-45, 45), 78 + rand(-45, 45), 78 + rand(-45, 45));
            imageline($image, rand(0, self::$WIDTH), rand(0, self::$HEIGHT), rand(0, self::$WIDTH), rand(0, self::$HEIGHT), $textColor);
        }
        
        $offset = 5;
        for ($i = 0; $i < strlen($code); $i++) {
            $textColor = imagecolorallocate($image, 78 + rand(-45, 45), 78 + rand(-45, 45), 78 + rand(-45, 45));
            imagestring($image, 7, $offset + $i * 12, 3 + rand(-2, 2),  $code[$i], $textColor);
        }
        
        return $image;
    }
    
    private function encryptString($code, $key, $iv) {
        $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($cipher, $key, $iv);
                
        $encrypted = mcrypt_generic($cipher, $code);
        mcrypt_generic_deinit($cipher);                
        
        return bin2hex($encrypted);
    }
        
    private function encrypt($code) {
         return $this->encryptString($code, self::$AES_KEY_HIDDEN, self::$AES_IV_HIDDEN);
    }
    
    public function verifyCode($answer, $encrypted) {
        $decrypted = $this->decrypt(hex2bin($encrypted), self::$AES_KEY_HIDDEN, self::$AES_IV_HIDDEN);
        return trim($answer) == trim($decrypted);
    }
    
    private function decrypt($encrypted, $key, $iv) {
        $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($cipher, $key, $iv) ;        

        $decrypted = mdecrypt_generic($cipher, $encrypted);
        mcrypt_generic_deinit($cipher);        

        return trim($decrypted);
    }
    
    public function getImage() {
        ob_start();
        imagepng($this->image);
        $str = sprintf("data:image/png;base64,%s", base64_encode(ob_get_clean()));
        
        return $str;
    }
    
    public function getChallenge() {
        return $this->challenge;
    }
     
    public function outputChallenge() {            
        printf("<input id=\"simpleCaptchaChallenge\" type=\"hidden\" name=\"challenge\" value=\"%s\"/>\r\n", $this->challenge);
        printf('<img id="simpleCaptchaImage" src="%s"/>', $this->getImage());
    }
}


if (@$_GET["q"] == "new") {
    $captcha = new SimpleCaptcha();
    $captcha->createChallenge(6);
    
    $ret = array("challenge" => $captcha->getChallenge(), "image" => $captcha->getImage());
    
    echo json_encode($ret);
    die();
}

?>