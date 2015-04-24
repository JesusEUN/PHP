<?

include "./phpqrcode/phpqrcode.php";

QRcode::png("http://blog.naver.com/pareko","./result.png",0,3,2); //크기는 <img src width 와 height 로 크기를 맞추기로 한다.

?>