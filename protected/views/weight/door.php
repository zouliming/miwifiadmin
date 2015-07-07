<?php
//通过这种形式，以字符串形式，将数据传送给layout
$action = $this->menu[$active];
$action['class']= $active;
echo json_encode($action);
?>