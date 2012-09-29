<?php

require_once dirname(dirname(__FILE__)).'/src/ad-fly-away.php';

$adfly = new adFlyAway;

// Example 1: Method chaining allows you to join class methods without needing to write many lines of messy code

// $adfly->bypass('AGrE')->redirect();

// Example 2: The traditional style of writing code for you old school folk

// $adfly->bypass('AGrE');
// $adfly->redirect();

// Example 3: No redirect. Simply bypass and echo the URL to the client.

$adfly->bypass('AGrE');

echo $adfly->url;