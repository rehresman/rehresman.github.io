<?php

/*

MIT License

Copyright (c) 2017 Ryan Ehresman

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.


*/


//location of index.php
define('__ROOT__', dirname(__FILE__));
//name of included class files.  This file should reside in __ROOT__
define('INC_FOLDER_NAME', 'inc');

//test-specific constants
define('RELATIVE_WATCH_URL','/watch?v=u6ZPH__YX6k');
define('HOST_WATCH_URL','www.youtube.com/watch?v=u6ZPH__YX6k');
define('NO_WWW_WATCH_URL','youtube.com/watch?v=u6ZPH__YX6k');
define('FULL_WATCH_URL_1','https://www.youtube.com/watch?v=u6ZPH__YX6k');
define('FULL_WATCH_URL_2','http://www.youtube.com/watch?v=u6ZPH__YX6k');
define('BAD_WATCH_URL_1','http://www.houtube.com/watch?v=u6ZPH__YX6k');
define('BAD_WATCH_URL_2','https://www.youtube.com/gser/williamprey');

define('RELATIVE_USER_URL','/user/williamprey');
define('HOST_USER_URL','www.youtube.com/user/williamprey');
define('NO_WWW_USER_URL','youtube.com/user/williamprey');
define('FULL_USER_URL_1','https://www.youtube.com/user/williamprey');
define('FULL_USER_URL_2','http://www.youtube.com/user/williamprey');
define('BAD_USER_URL_1','https://www.youtube.com/gser/williamprey');
define('BAD_USER_URL_2','https://www.youtube.com/watch?v=u6ZPH__YX6k');


require_once(__ROOT__.'/'.INC_FOLDER_NAME.'/YouTubeInfo.class.php');

$yti = new YouTubeInfo();


echo "\n\nVIDEO TESTS \n";

$yti->setVideo(RELATIVE_WATCH_URL);
echo "\n".RELATIVE_WATCH_URL." becomes\n".$yti->getVideo()."\n";

$yti->setVideo(HOST_WATCH_URL);
echo HOST_WATCH_URL." becomes\n".$yti->getVideo()."\n";

$yti->setVideo(NO_WWW_WATCH_URL);
echo NO_WWW_WATCH_URL." becomes\n".$yti->getVideo()."(<-should be nothing)\n";

$yti->setVideo(FULL_WATCH_URL_1);
echo FULL_WATCH_URL_1." becomes \n".$yti->getVideo()."\n";

$yti->setVideo(FULL_WATCH_URL_2);
echo FULL_WATCH_URL_2." becomes \n".$yti->getVideo()."\n";

$yti->setVideo(BAD_WATCH_URL_1);
echo BAD_WATCH_URL_1." becomes \n".$yti->getVideo()."(<-should be nothing)\n";
$yti->setVideo(BAD_WATCH_URL_2);
echo BAD_WATCH_URL_2." becomes \n".$yti->getVideo()."(<-should be nothing)\n";


echo "\n\nUSER TESTS \n";

$yti->setUser(RELATIVE_USER_URL);
echo "\n".RELATIVE_USER_URL." becomes\n".$yti->getUser()."\n";

$yti->setUser(HOST_USER_URL);
echo HOST_USER_URL." becomes\n".$yti->getUser()."\n";

$yti->setUser(NO_WWW_USER_URL);
echo NO_WWW_USER_URL." becomes\n".$yti->getUser()."(<-should be nothing)\n";

$yti->setUser(FULL_USER_URL_1);
echo FULL_USER_URL_1." becomes \n".$yti->getUser()."\n";

$yti->setUser(FULL_USER_URL_2);
echo FULL_USER_URL_2." becomes \n".$yti->getUser()."\n";

$yti->setUser(BAD_USER_URL_1);
echo BAD_USER_URL_1." becomes \n".$yti->getUser()."(<-should be nothing)\n";

$yti->setUser(BAD_USER_URL_2);
echo BAD_USER_URL_2." becomes \n".$yti->getUser()."(<-should be nothing)\n";



?>