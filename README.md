
CONTENTS OF THIS FILE
---------------------

 * About Grab Get Set
 * Configuration and features
 * Appearance


ABOUT GRAB GET SET
------------

GRAB GET SET is an open source Get Satisfaction php topic display library including some
Libraries for PEAR, HTTP Request2, ect.


Legal information about GRAB GET SET:
 * I wrote it beeeeyoch so if you use it your my beeeeyoch

   

CONFIGURATION AND FEATURES
--------------------------

The config.inc.php file locted in HttpReq/config.inc.php is where you put in your basic auth
info for GetSatisfaction. Also the link to the community should be listed here if you want 
people to click and go strait to your community.

The topic_block.php is a Class file that returns the data from the api. You can use URL parameters
to have it return a list. This file can not be moved or included out side of it's folder so it must be 
reference by java script.

The index.html file is a example of the url parameters and used jquery to call the topic_block.php file 

More about configuration:
 More to come on this