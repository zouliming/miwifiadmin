<style type="text/css">
	h2{
		font-size:25px;
	}
	.bd{
		padding: 30px;
	}
	.row{
		margin-top:10px;
	}
	.content{
		width:100%;
		padding:30px;
		background-color:#eee;
	}
</style>
<div id="bd-hd">反序列化</div>
<div class="bd">
	<form action="" method="post">
		<h2>请在这里输入伟大的字符串：</h2>
		<div><textarea name="data" style="width: 100%;height: 300px;"><?php echo $data;?></textarea></div>
		<div class="row"><input type="submit" value="提交"/></div>
	</form>
</div>

<?php
if($result){
	echo '<div class="content"><h2>反序列化后的内容：</h2></div>div>';
	var_dump($result);
}
?>
