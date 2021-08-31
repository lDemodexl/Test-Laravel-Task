<?php
$something = 'qwe.qwe';
putenv('RES_OPTIONS=retrans:1 retry:2 timeout:1 attempts:1');
// var_dump(getenv());
var_dump(gethostbyname($something));
?>
