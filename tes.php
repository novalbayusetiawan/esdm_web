<?php
exit(preg_replace(array("/https?:\/\//i", "/\/.*/i"), "", "https://www.lklfdslkkflds.com/dsadksakjjdas/dsadsa/dsadsa"));
$connected = fsockopen("www.lklfdslkkflds.com", 80);
$connected = fsockopen(preg_replace(array("/http:\/\//i", "/\/.*/i"), "", "www.lklfdslkkflds.com"), 80);
echo $connected;
?>