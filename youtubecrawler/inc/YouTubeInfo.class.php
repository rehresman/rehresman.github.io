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


/*
Basically an array of info collected from YouTube 
like this: [video links, user links].  

Converts "watch" links to "embed"
Doesn't handle cases without "www"

Only returns https.

*/
define('VIDEO_INDICATOR','/watch?v=');
define('USER_INDICATOR','/user/');
define('FULL_YOUTUBE_URL','https://www.youtube.com');
define('INSECURE_SCHEME','http');
define('EMBED_INDICATOR','/embed/');

class YouTubeInfo
{

	public function setVideo($link)
	{

		//clean link from newlines
		if (substr($link,-1,1) == "\n"){
			$link = substr($link,0,-1);
		}

		//relative URL given, i.e. /watch?v=iwk
		if (substr($link, 0, 9) == VIDEO_INDICATOR) {

			$link = EMBED_INDICATOR.substr($link,9);
			$link = parse_url(FULL_YOUTUBE_URL)["scheme"]."://".
						parse_url(FULL_YOUTUBE_URL)["host"].$link;	
			$this->video = $link;
			//echo "\n relative... \n";
		}
		//host given, i.e. www.youtube.com/watch...
		else if (substr($link,0,24) == parse_url(FULL_YOUTUBE_URL)["host"].VIDEO_INDICATOR) {

			$link = parse_url(FULL_YOUTUBE_URL)["scheme"]."://".$link;
			$this->video = $link;
			//echo "\n host... \n";
		}
		//full url given, i.e. https://www.yout...
		else if (substr($link,0,32) == 
				parse_url(FULL_YOUTUBE_URL)["scheme"]."://".
				parse_url(FULL_YOUTUBE_URL)["host"].VIDEO_INDICATOR) {

			$this->video = $link;
			//echo "\n full https... \n";
		}
		//full url given, i.e. http://www.yout...
		else if (substr($link,0,31) == 
				INSECURE_SCHEME."://".
				parse_url(FULL_YOUTUBE_URL)["host"].VIDEO_INDICATOR) {

			//converts to https
			$link = substr($link,0,4)."s".substr($link,4);
			$this->video = $link;
			//echo "\n full http... \n";
		}

		else
		{
			$this->video = NULL;
			/*
			//use this section for verbose testing
			echo "\n bad... \n"."Relative checked ".substr($link, 0, 9)." == ".VIDEO_INDICATOR;
			echo "\n Host checked ".substr($link,0,24)." == ".parse_url(FULL_YOUTUBE_URL)["host"].VIDEO_INDICATOR;
			echo "\n Full https checked ".substr($link,0,32)." == ".parse_url(FULL_YOUTUBE_URL)["scheme"]."://".
				parse_url(FULL_YOUTUBE_URL)["host"].VIDEO_INDICATOR;
			echo "\n Full http checked ".substr($link,0,31)." == ".INSECURE_SCHEME."://".parse_url(FULL_YOUTUBE_URL)["host"].VIDEO_INDICATOR."\n";
			*/
		}


	}

	public function setUser($link)
	{
		//clean link from newlines
		if (substr($link,-1,1) == "\n"){
			$link = substr($link,0,-1);
		}

		//relative URL given, i.e. /watch?v=iwk
		if (substr($link, 0, 6) == USER_INDICATOR) {

			$link = parse_url(FULL_YOUTUBE_URL)["scheme"]."://".
						parse_url(FULL_YOUTUBE_URL)["host"].$link;	
			$this->user = $link;
			//echo "\n relative... \n";
		}
		//host given, i.e. www.youtube.com/watch...
		else if (substr($link,0,21) == parse_url(FULL_YOUTUBE_URL)["host"].USER_INDICATOR) {

			$link = parse_url(FULL_YOUTUBE_URL)["scheme"]."://".$link;
			$this->user = $link;
			//echo "\n host... \n";
		}
		//full url given, i.e. https://www.yout...
		else if (substr($link,0,29) == 
				parse_url(FULL_YOUTUBE_URL)["scheme"]."://".
				parse_url(FULL_YOUTUBE_URL)["host"].USER_INDICATOR) {

			$this->user = $link;
			//echo "\n full https... \n";
		}
		//full url given, i.e. http://www.yout...
		else if (substr($link,0,28) == 
				INSECURE_SCHEME."://".
				parse_url(FULL_YOUTUBE_URL)["host"].USER_INDICATOR) {

			//converts to https
			$link = substr($link,0,4)."s".substr($link,4);
			$this->user = $link;
			//echo "\n full http... \n";
		}

		else
		{
			$this->user = NULL;
			/*
			//use this section for verbose testing
			echo "\n bad... \n"."Relative checked ".substr($link, 0, 6)." == ".USER_INDICATOR;
			echo "\n Host checked ".substr($link,0,21)." == ".parse_url(FULL_YOUTUBE_URL)["host"].USER_INDICATOR;
			echo "\n Full https checked ".substr($link,0,29)." == ".parse_url(FULL_YOUTUBE_URL)["scheme"]."://".
				parse_url(FULL_YOUTUBE_URL)["host"].USER_INDICATOR;
			echo "\n Full http checked ".substr($link,0,28)." == ".INSECURE_SCHEME."://".parse_url(FULL_YOUTUBE_URL)["host"].USER_INDICATOR."\n";
			*/
		}
	}
	public function getVideo()
	{
		return $this->video;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function __destruct()
	{
		$this->user = NULL;
		$this->video = NULL;
	}

	public function __toString()
	{
		return "\n[ ".$this->getUser()." , ".$this->getVideo()." ]";
	}

	private $video;
	private $user;


}


?>