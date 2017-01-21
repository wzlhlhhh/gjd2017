<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	html,bodl{
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

<bodl><?php  session_start();?>
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
		
		//获取当前钓骨头状态，根据状态来显示网页
		$sql_zt = "select * from tb_gjd_hdzt where uuid = '$uuid'";
		$query_zt = $connID->query($sql_zt);
		$result_zt = $query_zt->fetch_array();
		$dlzt = $result_zt['dl'];
		if(isset($_SESSION['money']))
		{
			$money = $_SESSION['money'];	
		}
		
		
		//比较是否结束挂机，在每次结束挂机的时候往包裹里面写入相应收益
		$dl_end = $result_zt['dl_end'];
		$dl_time = $result_zt['dl_time'];//骨头持续时间
		$now_time = (string)mktime();//用来做比较的mktime()的值，远程服务器不支持事件
		if($now_time >= $dl_end && $dl_end != 100 && isset($dl_end))
		{
			
			//往背包里添加相应的骨头
			//获取收益
			$dl_level = $result_zt['dl_level'];
			$dl_time = $result_zt['dl_time'];
			$sql_dl = "select * from tb_gjd_dl where dl_level = '$dl_level' and dl_time = '$dl_time';";
			$query_dl = $connID->query($sql_dl);
			$result_dl = $query_dl->fetch_array();
			$dl_gt = (int)$result_dl['dl_gt'];
			$dl_money = (int)$result_dl['dl_money'];
			$dl_dis = (string)$result_dl['dl_dis'];//获取骨头名字
			$money = $dl_time * 10;
			
			//添加骨头
			//查询当前字段是否存在，如果存在，采用update
			$dis = $dl_dis."掉落的";//合成物品描述
			$sql = "select * from tb_gjd_bg where uuid='$uuid' and bg_dis = '$dis'";
			$query = $connID->query($sql);
		 	$num = $query->num_rows;
			//var_dump($num);	
			if($num == 0)
			{			
				$sql_pic = "select pic from tb_gjd_pic where bg_name = '$dl_dis'";
				$query_pic = $connID->query($sql_pic);
				$result_pic = $query_pic->fetch_array();
				$pic = $result_pic['pic'];
				
				//加钱
				
				$sql_add = "update tb_gjd_jbxx set money = money + $money where uuid='$uuid'";
				$query_add = $connID->query($sql_add);
				//增加骨头
				$gt = $dl_level."级骨头";
				$dis = $dl_dis."掉落的";
				$sql_add = "insert into tb_gjd_bg(uuid, bg_name, bg_count, bg_pic, bg_dis) values('$uuid', '$gt', '$dl_gt', '$pic', '$dis')";
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
				$sql_add = "update tb_gjd_bg set bg_count=bg_count+'$dl_gt' where bg_dis = '$dis' where uuid ='$uuid'";//确认没问题，就跟新信息
				$query_add = $connID->query($sql_add);
				if(!$query_add)
				{
					echo "<script>alert('发生未知错误2！');</script>";
					return false;
				}
			}
			//将dl_end重置为100
			$sql = "update tb_gjd_hdzt set dl_end = 100 where uuid = '$uuid'";
			$query = $connID->query($sql);
			if(!$query)
				{
					echo "<script>alert('发生未知错误2！');</script>";
					return false;
				}
			
			
			//重置打猎状态
			$dlzt = 0;
			$sql = "update tb_gjd_hdzt set dl = 0 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
		}
		
		//如果当前是正在打猎状态，获取当前的打猎信息用来显示
		if($dlzt == 1)
		{
			$dl_level = $result_zt['dl_level'];
			$dl_time = $result_zt['dl_time'];
				
			//获取骨头信息表
			$sql_dl = "select * from tb_gjd_dl where dl_level = '$dl_level' and dl_time = '$dl_time'" ;
			$query_dl = $connID->query($sql_dl);
			$result_dl = $query_dl->fetch_array();
			$dl_gt = $result_dl['dl_gt'];
		}
		
		//在没有挂机时可以提交，以设定挂机的各种参数
		if(isset($_POST['submit']))
		{
			//判定玩家是否能够战胜怪物，以属性来。伤害=攻击/防御
			$sql_zdxx = "select * from tb_gjd_zdxx where uuid = '$uuid'";
			$query_zdxx = $connID->query($sql_zdxx);
			$result_zdxx = $query_zdxx->fetch_array();
			//玩家属性
			$user_hp = $result_zdxx['hp'];
			$user_mp = $result_zdxx['mp'];
			$user_fy = $result_zdxx['fy'];
			$user_attck = $result_zdxx['attck'];
			//怪物属性
			$dl_level = $_POST['dldj'];
			
			$sql_gwsx = "select dl_attack as gj, dl_hp as hp, dl_mp as mp, dl_fy as fy from tb_gjd_dl where dl_level = '$dl_level'";
			$query_gwsx = $connID->query($sql_gwsx);
			$result_gwsx = $query_gwsx->fetch_array();
			
			$gw_hp = $result_gwsx['hp'];
			$gw_mp = $result_gwsx['mp'];
			$gw_fy = $result_gwsx['fy'];
			$gw_attck = $result_gwsx['gj']; 
			//计算攻击次数
			$gj_count_user = $gw_hp/($user_attck/$gw_fy);
			$gj_count_gw = $user_hp/($gw_attck/$user_fy);
			if($gj_count_gw < $gj_count_user)
			{
				echo "<script>alert('你的能力不足以挑战此怪物，请提升属性后再来！');</script>";
				echo "<script>window.location.href='dl.php';</script>";
				return;
			}
			
			//更新dlzt为1
			$sql = "update tb_gjd_hdzt set dl = 1 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			//更新钓骨头的等级和时间
			$dl_time = $_POST['dlsj'];
			$end_time = (string)(mktime()+$dl_time*3600*((100-$vip)/100));//计算结束时间,这个例子是半分钟为单位的
			$dl_level = $_POST['dldj'];
			$_SESSION['money'] = $dl_time * 10;
			$sql = "update tb_gjd_hdzt set dl_level = '$dl_level' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			$sql = "update tb_gjd_hdzt set dl_time = '$dl_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			$sql = "update tb_gjd_hdzt set dl_end = '$end_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！');</script>";
				return false;
			}
			
			echo "<script>window.location.href='dl.php';</script>";
		}
		
	?>
	<div style="height:600px; width:700px; background:url(../bg_image/dl.jpg); background-repeat:round;  ">
    <!--钓骨头页面，一张表，4行，2列-->
    	<table style="position:absolute; top:200px; left:140px;" width="400" height="300" align="center" border="0" cellpadding="0" cellspacing="0"><form action="" method="post" name="formdl">
    		<tr><!--定义钓骨头等级-->
    			<td width="200px" class="zt" align="center">打猎怪物等级:</td>
    			<td>
                	<select name="dldj" id="dldj" style="height:20px; width:100px;">
                    	<option value="1">1级</option>
                    	<option value="5">5级</option>
                    	<option value="10">10级</option>
                        <option value="100">BOSS<1W/1W/1W></option>
                    </select>
                </td>
    		</tr>
    		<tr><!--定义钓骨头时间-->
    			<td  width="200px" class="zt" align="center">打猎时间：</td>
    			<td>
                	<select name="dlsj" id="dlsj" style="height:20px; width:100px;">
                    	<option value="1">1小时</option>
                    	<option value="3">3小时</option>
                    	<option value="8">8小时</option>
                        <option value="24">24小时</option>
                    </select>
                </td>
    		</tr>
    		<tr>
    			<td align="left" class="zt">预计收益：</td>
                <td align="left" class="nr"><?php if($dlzt==0){?>打猎1小时<br>可获得骨头10块，金钱10<?php }else{?>打猎<?php echo $dl_time;?>小时，可获得等级为<?php echo $dl_level;?>的骨头<?php echo $dl_gt;?>块，金钱<?php echo $money; }?></td>
    		</tr>
    		<tr>
    			<td colspan="2" align="center" class="zt"><?php if($dlzt==0){?><input type="submit" value="确认挂机" name="submit" id="submit"><?php }else{?>正在挂机.......<?php }?></td>
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
</bodl>
</html>