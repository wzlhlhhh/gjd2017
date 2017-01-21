<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	html,body{
overflow:hidden;
height:100%;
position:absolute;
left:0;
top:0;

}
	.zt{
		font-size:20px;
		font-weight:bolder;
	}
	
	.nr{
		font-size:20px;
		font-weight:bolder;
	}
</style>
</head>

<body><?php  session_start();?>
	<?php
    	include("../conmysql.php");
		//获取uuid
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connID->query($sql);
		$result = $query->fetch_array();
		$uuid = (int)$result[0];
		
		//获取VIP等级
		$sql_vip = "select * from tb_gjd_jbxx where uuid = '$uuid'";
		$query_vip = $connID->query($sql_vip);
		$result_vip = $query_vip->fetch_array();
		$vip = (int)$result_vip['vip'];
		
		//获取当前钓鱼状态，根据状态来显示网页
		$sql_zt = "select * from tb_gjd_hdzt where uuid = '$uuid'";
		$query_zt = $connID->query($sql_zt);
		$result_zt = $query_zt->fetch_array();
		$dyzt = $result_zt['dy'];
		
		//比较是否结束挂机，在每次结束挂机的时候往包裹里面写入相应收益
		$dy_end = $result_zt['dy_end'];
		$dy_time = $result_zt['dy_time'];//钓鱼持续时间
		$now_time = (string)mktime();//用来做比较的mktime()的值，远程服务器不支持事件
		if($now_time >= $dy_end && $dy_end != 100 && isset($dy_end))
		{
			
			//往背包里添加相应的鱼
			//获取收益
			$dy_level = $result_zt['dy_level'];
			$dy_time = $result_zt['dy_time'];
			$sql_dy = "select * from tb_gjd_dy where dy_level = '$dy_level' and dy_time = '$dy_time';";
			$query_dy = $connID->query($sql_dy);
			$result_dy = $query_dy->fetch_array();
			$dy_sy = (int)$result_dy['dy_sy'];
			$dy_dis = (string)$result_dy['dy_dis'];//获取鱼名字
			
			//添加鱼
			//查询当前字段是否存在，如果存在，采用update
			$sql = "select * from tb_gjd_bg where uuid='$uuid' and bg_name = '$dy_dis'";
			$query = $connID->query($sql);
		 	$num = $query->num_rows;
			//var_dump($num);	
			if($num == 0)
			{	
				//取得这个物品的图标
				$sql_pic = "select pic from tb_gjd_pic where bg_name = '$dy_dis'";
				$query_pic = $connID->query($sql_pic);
				$result_pic = $query_pic->fetch_array();
				$pic = $result_pic['pic'];
				
				$sql_add = "insert into tb_gjd_bg(uuid, bg_name, bg_count, bg_pic, bg_dis) values('$uuid', '$dy_dis', '$dy_sy', '$pic', '$dy_dis')";
				$query_add = $connID->query($sql_add);
							//var_dump($num);	
				if(!$query_add)
				{
					echo "<script>alert('发生未知错误1！');</script>";
					//die(mysqli_error());
					return false;

				}
			}
			else
			{
				$sql_add = "update tb_gjd_bg set bg_count=bg_count+'$dy_sy' where bg_name = '$dy_dis' and uuid='$uuid'";//确认没问题，就跟新信息
				$query_add = $connID->query($sql_add);
				if(!$query_add)
				{
					echo "<script>alert('发生未知错误2！');</script>";
					return false;
				}
			}
			//将dy_end重置为100
			$sql = "update tb_gjd_hdzt set dy_end = 100 where uuid = '$uuid'";
			$query = $connID->query($sql);
			if(!$query)
				{
					echo "<script>alert('发生未知错误2！');</script>";
					return false;
				}
			
			
			//重置钓鱼状态
			$dyzt = 0;
			$sql = "update tb_gjd_hdzt set dy = 0 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
		}
		
		//如果当前是正在钓鱼状态，获取当前的钓鱼信息用来显示
		if($dyzt == 1)
		{
			$dy_level = $result_zt['dy_level'];
			$dy_time = $result_zt['dy_time'];
				
			//获取钓鱼信息表
			$sql_dy = "select * from tb_gjd_dy where dy_level = '$dy_level' and dy_time = '$dy_time';";
			$query_dy = $connID->query($sql_dy);
			$result_dy = $query_dy->fetch_array();
			$dy_sy = $result_dy['dy_sy'];
		}
		
		//在没有挂机时可以提交，以设定挂机的各种参数
		if(isset($_POST['submit']))
		{
			//首先判定玩家等级是否>=钓鱼等级
			$sql_level = "select user_level as level from tb_gjd_jbxx where uuid = '$uuid'";
			$query_level = $connID->query($sql_level);
			$result_level = $query_level->fetch_array();
			
			if($result_level['level'] < $_POST['dydj'])
			{
				echo "<script>alert('玩家等级过低！');</script>";
				echo "<script>window.location.href='dy.php';</script>";
				return ;
			}
			
			//更新dyzt为1
			$sql = "update tb_gjd_hdzt set dy = 1 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			//更新钓鱼的等级和时间
			$dy_time = $_POST['dysj'];
			$end_time = (string)(mktime()+$dy_time*3600*((100-$vip)/100));//计算结束时间,这个例子是半分钟为单位的
			$dy_level = $_POST['dydj'];
			$sql = "update tb_gjd_hdzt set dy_level = '$dy_level' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			$sql = "update tb_gjd_hdzt set dy_time = '$dy_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			$sql = "update tb_gjd_hdzt set dy_end = '$end_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			
			echo "<script>window.location.href='dy.php';</script>";//刷新一次
			
		}
		
	?>
	<div style="height:600px; width:700px; background:url(../bg_image/dy.png); background-repeat:round;">
    <!--钓鱼页面，一张表，4行，2列-->
    	<table style="position:absolute; top:200px; left:140px;" width="400" height="300" align="center" border="0" cellpadding="0" cellspacing="0"><form action="" method="post" name="formdy">
    		<tr><!--定义钓鱼等级-->
    			<td width="200px" class="zt" align="center">钓鱼等级:</td>
    			<td>
                	<select name="dydj" id="dydj" style="height:20px; width:100px;">
                    	<option value="1">1级</option>
                    	<option value="5">5级</option>
                    	<option value="10">10级</option>
                    </select>
                </td>
    		</tr>
    		<tr><!--定义钓鱼时间-->
    			<td  width="200px" class="zt" align="center">钓鱼时间：</td>
    			<td>
                	<select name="dysj" id="dysj" style="height:20px; width:100px;">
                    	<option value="1">1小时</option>
                    	<option value="3">3小时</option>
                    	<option value="8">8小时</option>
                        <option value="24">24小时</option>
                    </select>
                </td>
    		</tr>
    		<tr>
    			<td align="left" class="zt">预计收益：</td>
                <td align="left" class="nr"><?php if($dyzt==0){?>钓鱼1小时<br>可获得鱼10条<?php }else{?>钓鱼<?php echo $dy_time;?>小时，可获得等级为<?php echo $dy_level;?>的鱼<?php echo $dy_sy;?>条<?php }?></td>
    		</tr>
    		<tr>
    			<td colspan="2" align="center" class="zt"><?php if($dyzt==0){?><input type="submit" value="确认挂机" name="submit" id="submit"><?php }else{?>正在挂机.......<?php }?></td>
    		</tr>
    	</form></table>
        <div style="position:absolute; bottom:30px; width:10%; left:60px;" align="center">
        	<progress style="width:500px;" max="100" value="50" align="center"></progress><br>
这个进度条目前是摆设
        </div>
    </div>
    <?php  
		$connID->close();
	?>
</body>
</html>