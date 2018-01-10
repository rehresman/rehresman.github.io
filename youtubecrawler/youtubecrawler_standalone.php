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

require_once(__ROOT__.'/'.INC_FOLDER_NAME.'/YouTubeInfo.class.php');

define('QUERY_INDICATOR','/results?search_query=');
define('VIDEO_INDICATOR','/watch?v=');
define('USER_INDICATOR','/user/');
define('YOUTUBE_HOME','https://youtube.com');

//$plusquery = "moog+minimoog+model+D";

//gets YouTube links and returns an array of YouTubeInfo
//objects
function follow_links($url) {

	$doc = new DOMDocument();

	//make sure YouTube is accepting connections
	try {
		$doc->loadHTML(getWebsiteSafely($url));
	} catch (Exception $e) {
	 	echo $e->getMessage(), "\n";
	}

	$linklist = $doc->getElementsByTagName("a");
	$yti = new YouTubeInfo();
	$YouTubeInfoList = array();
	$numberoflinks = $linklist->length; 
	$resultsarraysize = 0;
	//get video links
	for ($n = 0; $n < $numberoflinks; $n++) {

		//check for dupes
		if (is_null($linklist->item($n+1)) || 
			$linklist->item($n)->getAttribute("href") !== 
			$linklist->item($n+1)->getAttribute("href")) {

				$l = $linklist->item($n)->getAttribute("href")."\n";
				if (substr($l, 0, 9) == VIDEO_INDICATOR) {
					$yti->setVideo($l);
				}
				else if (substr($l, 0, 6) == USER_INDICATOR) {
					$yti->setUser($l);
				}

				//set YouTubeInfo
				if (!(is_null($yti->getUser()) || 
					is_null($yti->getVideo()))) {
					array_push($YouTubeInfoList, $yti);
					$yti = new YouTubeInfo();
				}
		}

	}

	return $YouTubeInfoList;
}

function getWebsiteSafely($url=NULL){
	if (urlExists($url) == false) {

		throw new Exception(
			'<div class="alert alert-info" role="alert"><p>Error: Could not establish a connection to YouTube.  Check your internet connection and refresh the page.</p>
			<container class="row"><div class="col" align="center">
			<a class="btn btn-secondary btn-lg" href="'.get_permalink().'" >Refresh</a></div></container></div>');
	}
	return file_get_contents($url);

}
