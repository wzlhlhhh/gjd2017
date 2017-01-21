<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	html,bozz{
overflow:hidden;
height:100%;

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

<bozz><?php  session_start();?>
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
		
		//获取当前钓植物状态，根据状态来显示网页
		$sql_zt = "select * from tb_gjd_hdzt where uuid = '$uuid'";
		$query_zt = $connID->query($sql_zt);
		$result_zt = $query_zt->fetch_array();
		$zzzt = $result_zt['zz'];
		
		//比较是否结束挂机，在每次结束挂机的时候往包裹里面写入相应收益
		$zz_end = $result_zt['zz_end'];
		$zz_time = $result_zt['zz_time'];//植物持续时间
		$now_time = (string)mktime();//用来做比较的mktime()的值，远程服务器不支持事件
		if($now_time >= $zz_end && $zz_end != 100 && isset($zz_end))
		{
			
			//往背包里添加相应的植物
			//获取收益
			$zz_level = $result_zt['zz_level'];
			$zz_time = $result_zt['zz_time'];
			$sql_zz = "select * from tb_gjd_zz where zz_level = '$zz_level' and zz_time = '$zz_time';";
			$query_zz = $connID->query($sql_zz);
			$result_zz = $query_zz->fetch_array();
			$zz_sy = (int)$result_zz['zz_sy'];
			$zz_dis = (string)$result_zz['zz_dis'];//获取植物名字
			
			//添加植物
			//查询当前字段是否存在，如果存在，采用update
			$sql = "select * from tb_gjd_bg where uuid='$uuid' and bg_name = '$zz_dis' and uuid='$uuid'";
			$query = $connID->query($sql);
		 	$num = $query->num_rows;
			//var_dump($num);	
			if($num == 0)
			{			
				$sql_pic = "select pic from tb_gjd_pic where bg_name = '$zz_dis'";
				$query_pic = $connID->query($sql_pic);
				$result_pic = $query_pic->fetch_array();
				$pic = $result_pic['pic'];
				
				$sql_add = "insert into tb_gjd_bg(uuid, bg_name, bg_count, bg_pic, bg_dis) values('$uuid', '$zz_dis', '$zz_sy', '$pic', '$zz_dis')";
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
				$sql_add = "update tb_gjd_bg set bg_count=bg_count+'$zz_sy' where bg_name = '$zz_dis' and uuid='$uuid'";//确认没问题，就跟新信息
				$query_add = $connID->query($sql_add);
				if(!$query_add)
				{
					echo "<script>alert('发生未知错误2！');</script>";
					return false;
				}
			}
			//将zz_end重置为100
			$sql = "update tb_gjd_hdzt set zz_end = 100 where uuid = '$uuid'";
			$query = $connID->query($sql);
			if(!$query)
				{
					echo "<script>alert('发生未知错误2！');</script>";
					return false;
				}
			
			
			//重置钓植物状态
			$zzzt = 0;
			$sql = "update tb_gjd_hdzt set zz = 0 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
		}
		
		//如果当前是正在植物状态，获取当前的植物信息用来显示
		if($zzzt == 1)
		{
			$zz_level = $result_zt['zz_level'];
			$zz_time = $result_zt['zz_time'];
				
			//获取植物信息表
			$sql_zz = "select * from tb_gjd_zz where zz_level = '$zz_level' and zz_time = '$zz_time';";
			$query_zz = $connID->query($sql_zz);
			$result_zz = $query_zz->fetch_array();
			$zz_sy = $result_zz['zz_sy'];
		}
		
		//在没有挂机时可以提交，以设定挂机的各种参数
		if(isset($_POST['submit']))
		{
			//首先判定玩家等级是否>=种植等级
			$sql_level = "select user_level as level from tb_gjd_jbxx where uuid = '$uuid'";
			$query_level = $connID->query($sql_level);
			$result_level = $query_level->fetch_array();
			
			if($result_level['level'] < $_POST['zzdj'])
			{
				echo "<script>alert('玩家等级过低！');</script>";
				echo "<script>window.location.href='zz.php';</script>";
				return ;
			}
			
			//更新zzzt为1
			$sql = "update tb_gjd_hdzt set zz = 1 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			//更新钓植物的等级和时间
			$zz_time = $_POST['zzsj'];
			$end_time = (string)(mktime()+$zz_time*3600*((100-$vip)/100));//计算结束时间,这个例子是半分钟为单位的
			$zz_level = $_POST['zzdj'];
			$sql = "update tb_gjd_hdzt set zz_level = '$zz_level' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			$sql = "update tb_gjd_hdzt set zz_time = '$zz_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			$sql = "update tb_gjd_hdzt set zz_end = '$end_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			
			echo "<script>window.location.href='zz.php';</script>";
		}
		
	?>
	<div style="height:600px; width:700px; background:url(../bg_image/zz.jpg); background-size:cover;  ">
    <!--钓植物页面，一张表，4行，2列-->
    	<table style="position:absolute; top:200px; left:140px;" width="400" height="300" align="center" border="0" cellpadding="0" cellspacing="0"><form action="" method="post" name="formzz">
    		<tr><!--定义钓植物等级-->
    			<td width="200px" class="zt" align="center">种植植物等级:</td>
    			<td>
                	<select name="zzdj" id="zzdj" style="height:20px; width:100px;">
                    	<option value="1">1级</option>
                    	<option value="5">5级</option>
                    	<option value="10">10级</option>
                    </select>
                </td>
    		</tr>
    		<tr><!--定义钓植物时间-->
    			<td  width="200px" class="zt" align="center">种植植物时间：</td>
    			<td>
                	<select name="zzsj" id="zzsj" style="height:20px; width:100px;">
                    	<option value="1">1小时</option>
                    	<option value="3">3小时</option>
                    	<option value="8">8小时</option>
                        <option value="24">24小时</option>
                    </select>
                </td>
    		</tr>
    		<tr>
    			<td align="left" class="zt">预计收益：</td>
                <td align="left" class="nr"><?php if($zzzt==0){?>种植1小时<br>可获得植物10株<?php }else{?>种植<?php echo $zz_time;?>小时，可获得等级为<?php echo $zz_level;?>的植物<?php echo $zz_sy;?>株<?php }?></td>
    		</tr>
    		<tr>
    			<td colspan="2" align="center" class="zt"><?php if($zzzt==0){?><input type="submit" value="确认挂机" name="submit" id="submit"><?php }else{?>正在挂机.......<?php }?></td>
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
</bozz>
</html>