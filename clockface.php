<?php
date_default_timezone_set('America/Chicago');
$url = 'http://www.gregneyman.com/clockgears.php';
$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($handle);
curl_close($handle); 
$ground = json_decode($output);
$doc = new DOMDocument();
$doc->formatOutput = true;
$html = $doc->appendChild(new DOMElement('html'));
$head = $html->appendChild(new DOMElement('head'));
$body = $html->appendChild(new DOMElement('body'));
$h1 = $body->appendChild(new DOMElement('h1', $ground->events));
$h2 = $body->appendChild(new DOMElement('h2', " so far in ".date("Y")));
$h3 = $body->appendChild(new DOMElement('h3', $ground->stamp));
$h4 = $body->appendChild(new DOMElement('h4', "Next in "));
$h5 = $body->appendChild(new DOMElement('h5'));
$anchor = $h5->appendChild(new DOMElement('a',"What is this?"));
$anchor->setAttribute('href','https://www.facebook.com/groups/132952066891217/permalink/1084252911761123/');
$script = $body->appendChild(new DOMElement('script'));
$script->setAttribute('src','clock.js');
$next = $ground->next - (date("i")*60) - date("s");
$minutes = floor($next/60);
$h4->appendChild(new DOMElement('span',$minutes));
$h4->appendChild($doc->createTextNode(':'));
$seconds = $next - ($minutes*60);
if(strlen($seconds)==1) $seconds = "0$seconds";
$h4->appendChild(new DOMElement('span',$seconds));
$title = $head->appendChild(new DOMElement('title', $ground->events." so far in ".date("Y")));
$style = $head->appendChild(new DOMElement('style',<<<HERE
//style text goes here
HERE
));
$meta = $head->appendChild(new DOMElement('meta'));
$meta->setAttribute('http-equiv','refresh');
$meta->setAttribute('content',3600-(date("i")*60)-date("s"));
print $doc->saveHTML();
?>
