<form action="" method="post" style="margin: 40px auto;width: 600px;">
	<textarea name="data" style="width: 500px;height: 300px;"><?php echo $data;?></textarea>
	<br>
	<input type="submit" value="提交"/>
</form>
<div style="width:800px;margin:0 auto;background-color:#eee;">
<?php
if($result){
	var_dump($result);
}
?>
</div>
