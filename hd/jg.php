<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	html,bojg{
overflow:hidden;
height:100%;

}
	.HP{
		z-index:1;
		display:block;
	}
	.HPnone{
		display:none;
	}
	
	.gj{
		z-index:1;
		display:block;
	}
	.gjnone{
		display:none;
	}
	
	.jyz{
		z-index:1;
		display:block;
	}
	.jyznone{
		display:none;
	}
	
	.fy{
		z-index:1;
		display:block;
	}
	.fynone{
		display:none;
	}
</style>
<script>
	function change(btn)//定义加工类型按钮使div发生的变化
	{
		//alert(btn);
		if(btn == 'HP')
		{
			
			document.getElementById("div_HP").className="HP";
			document.getElementById('div_gj').className="gjnone";
			document.getElementById('div_fy').className="fynone";
			document.getElementById('div_jy').className="jyznone";
			document.getElementById("typee").value="hp";
		}
		else if(btn == 'gj')
		{
			//alert('xixi');
			document.getElementById("div_HP").className="HPnone";
			document.getElementById('div_gj').className="gj";
			document.getElementById('div_fy').className="fynone";
			document.getElementById('div_jy').className="jyznone";
			document.getElementById("typee").value="gj";
		}
		else if(btn == 'fy')
		{
			document.getElementById("div_HP").className="HPnone";
			document.getElementById('div_gj').className="gjnone";
			document.getElementById('div_fy').className="fy";
			document.getElementById('div_jy').className="jyznone";
			document.getElementById("typee").value="fy";
		}
		else if(btn == 'jyz')
		{
			document.getElementById("div_HP").className="HPnone";
			document.getElementById('div_gj').className="gjnone";
			document.getElementById('div_fy').className="fynone";
			document.getElementById('div_jy').className="jyz";
			document.getElementById("typee").value="jy";
		}
		
		function Ctype(t)//获取加工类型
		{
			//alert('haha');
			switch(t)
			{
				case 'HP': document.getElementById('type').value='HP'; break;
				case 'gj': document.getElementById('type').value='gj'; break;
				case 'fy': document.getElementById('type').value='fy'; break;
				case 'jy': document.getElementById('type').value='jy'; break;
			}
		}
	}
</script>
</head>

<bojg><?php session_start();//加工功能实现把鱼变成+HP/MP上限的BUFF药，把植物变成+攻击的BUFF药，把植物鱼一起变成经验药水，把植物鱼骨头变成防御药水?>
	<?php
    	include('../conmysql.php');
		//获取uuid
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connID->query($sql);
		$result = $query->fetch_array();
		$uuid = (int)$result[0];
		
		//获取当前加工状态，根据状态来显示网页
		$sql_zt = "select * from tb_gjd_hdzt where uuid = '$uuid'";
		$query_zt = $connID->query($sql_zt);
		$result_zt = $query_zt->fetch_array();
		$jgzt = $result_zt['jg'];
		
		//如果正在加工，判断是否结束加工
		$now_time = mktime();
		$jg_end = $result_zt['jg_end'];
		$jg_count = $result_zt['jg_count'];//获取收益的数量
	
		if($now_time > $jg_end && ($jg_end != 100) && isset($jg_end))
		{
			//加工完成，获取收益
			//往背包里添加相应的药剂
			$jg_type = $result_zt['jg_type'];
			$jg_level = $result_zt['jg_level'];
			$jg_count = (int)$result_zt['jg_count'];//数量
			$sql_jg = "select * from tb_gjd_jg where jg_level = '$jg_level' and jg_count = '$jg_count' and jg_type = '$jg_type'";
			$query_jg = $connID->query($sql_jg);
			$result_jg = $query_jg->fetch_array();
			$jg_dis = (string)$result_jg['jg_dis'];//获取加工产品名字
			
			//添加药剂
			//查询当前字段是否存在，如果存在，采用update
			$sql = "select * from tb_gjd_bg where uuid='$uuid' and bg_name = '$jg_dis'";
			$query = $connID->query($sql);
		 	$num = $query->num_rows;
			//var_dump($num);	
			if($num == 0)//若不存在
			{	
				//取得这个物品的图标
				$sql_pic = "select pic from tb_gjd_pic where bg_name = '$jg_dis'";
				$query_pic = $connID->query($sql_pic);
				$result_pic = $query_pic->fetch_array();
				$pic = $result_pic['pic'];
				
				$sql_add = "insert into tb_gjd_bg(uuid, bg_name, bg_count, bg_pic, bg_dis) values('$uuid', '$jg_dis', '$jg_count', '$pic', '$jg_dis')";
				$query_add = $connID->query($sql_add);
							//var_dump($num);	
				if(!$query_add)
				{
					echo "<script>alert('发生未知错误insert！');</script>";
					//die(mysqli_error());
					return false;

				}
			}
			else
			{
				$sql_add = "update tb_gjd_bg set bg_count=bg_count+'$jg_count' where bg_name = '$jg_dis' and uuid='$uuid'";//确认没问题，就跟新信息
				$query_add = $connID->query($sql_add);
				if(!$query_add)
				{
					echo "<script>alert('发生未知错误update');</script>";
					return false;
				}
			}
			
			//我想还需要把原料清除出去
			//获取当前加工种类需要的原料
			$sql_cl = "select * from tb_gjd_jg where jg_type='$jg_type' and jg_level='$jg_level' and jg_count='$jg_count'";
			$query_cl = $connID->query($sql_cl);
			$result_cl = $query_cl->fetch_array();
			$jgcl1 = $result_cl['jg_cl1'];
			$jgcl2 = $result_cl['jg_cl2'];
			$jgcl3 = $result_cl['jg_cl3'];
			
			//清除
			if(null != (trim($jgcl1)))
			{
				//更新包裹的物品数量
				//对比条件一
				//$sql_bg_cl1 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$jgcl1'";
				var_dump($jg_count);
				$sql_bg_cl1_up = "update tb_gjd_bg set bg_count = (bg_count-$jg_count*10) where bg_name = '$jgcl1' and uuid='$uuid' ";
				$query_bg_cl1 = $connID->query($sql_bg_cl1_up);
				
				if(!$query_bg_cl1)
				{
					echo "<script>alert('发生未知错误cl1');/script>";
					return false;
				}
				
				//如果存在条件二，对比条件二	
				if(null != (trim($jgcl2)))
				{
					$sql_bg_cl2_up = "update tb_gjd_bg set bg_count = (bg_count-$jg_count*10) where bg_name = '$jgcl2'  and uuid='$uuid'";
					$query_bg_cl2 = $connID->query($sql_bg_cl2_up);
					
					if(!$query_bg_cl2)
					{
						echo "<script>alert('发生未知错误cl2');/script>";
						return false;
					}
						
					
					//如果存在条件三，对比条件三
					if(null != (trim($jgcl3)))
					{
						$sql_bg_cl3_up = "update tb_gjd_bg set bg_count = (bg_count-$jg_count*10) where bg_name = '$jgcl3'  and uuid='$uuid'";
						$query_bg_cl3 = $connID->query($sql_bg_cl3_up);
						//var_dump($query_bg_cl3);
						
						if(!$query_bg_cl3)
						{
							echo "<script>alert('发生未知错误cl3');/script>";
							return false;
						}
						
					}
				}
			}
			
			//将jg_end重置为100
			$sql = "update tb_gjd_hdzt set jg_end = 100 where uuid = '$uuid'";
			$query = $connID->query($sql);
			if(!$query)
				{
					echo "<script>alert('发生未知错误jg_end！');</script>";
					return false;
				}
			
			
			//重置加工状态
			$jgzt = 0;
			$sql = "update tb_gjd_hdzt set jg = 0 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！reset');</script>";
				return false;
			}
		}
		
		//如果当前是正在加工状态，获取当前的加工信息用来显示
		if($jgzt == 1)
		{
			$jg_level = $result_zt['jg_level'];
			$jg_count = $result_zt['jg_count'];
				
			//获取加工信息表
			$sql_jg = "select * from tb_gjd_jg where jg_level = '$jg_level' and jg_count = '$jg_count'";
			$query_jg = $connID->query($sql_jg);
			$result_jg = $query_jg->fetch_array();
			$jg_dis = $result_jg['jg_dis'];
		}
		
		if(isset($_POST['submit']))//提交之后写入数据
		{
			//首先判断是进行什么加工
			$jg_type = $_POST['typee'];
			//$jg_level = $_POST['jgdj'];
			/*if(isset($_POST['jgdj_hp']))
				$jg_level = $_POST['jgdj_hp'];
			else if(isset($_POST['jgdj_gj']))
				$jg_level = $_POST['jgdj_gj'];
			else if(isset($_POST['jgdj_fy']))
				$jg_level = $_POST['jgdj_fy'];
			else if(isset($_POST['jgdj_jy']))
				$jg_level = $_POST['jgdj_jy'];/**/
			$jg_level = $_POST["jgdj_$jg_type"];//获取当前加工类型的等级
			$jg_count = $_POST["jgcount_$jg_type"];
			//var_dump($jg_count);var_dump($jg_type);var_dump($jg_level);
			
			//判定加工条件是否满足，方式是比较三个材料的个数
			$sql_cl = "select * from tb_gjd_jg where jg_type='$jg_type' and jg_level='$jg_level' and jg_count='$jg_count'";
			$query_cl = $connID->query($sql_cl);
			$result_cl = $query_cl->fetch_array();
			$jgcl1 = $result_cl['jg_cl1'];
			$jgcl2 = $result_cl['jg_cl2'];
			$jgcl3 = $result_cl['jg_cl3'];
			
			//如果当前条件存在，则进行判断
			if(null != (trim($jgcl1)))
			{
				//查看包裹里的需求物品个数是否满足
				//对比条件一
				$sql_bg_cl1 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$jgcl1'";
				$query_bg_cl1 = $connID->query($sql_bg_cl1);
				$result_bg_cl1 = $query_bg_cl1->fetch_array();
				$jgcl1_bg_count = $result_bg_cl1['bg_count'];
				
				if($jgcl1_bg_count < ($jg_count*10))
				{
					echo "<script>alert('物品1数量不足！');</script>";
					echo "<script>window.location.href='jg.php';</script>";
				}
				//如果存在条件二，对比条件二	
				if(null != (trim($jgcl2)))
				{
					$sql_bg_cl2 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$jgcl2'";
					$query_bg_cl2 = $connID->query($sql_bg_cl2);
					$result_bg_cl2 = $query_bg_cl2->fetch_array();
					$jgcl2_bg_count = $result_bg_cl2['bg_count'];
					
					if($jgcl2_bg_count < ($jg_count*10))
					{
						echo "<script>alert('物品2数量不足！');</script>";
						echo "<script>window.location.href='jg.php';</script>";
					}
					
					//如果存在条件三，对比条件三
					if(null != (trim($jgcl3)))
					{
						$sql_bg_cl3 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$jgcl3'";
						$query_bg_cl3 = $connID->query($sql_bg_cl3);
						$result_bg_cl3 = $query_bg_cl3->fetch_array();
						$jgcl3_bg_count = $result_bg_cl3['bg_count'];
						
						if($jgcl3_bg_count < ($jg_count*10))
						{
							echo "<script>alert('物品3数量不足！');</script>";
							echo "<script>window.location.href='jg.php';</script>";
							return false;
						}
					}
				}
			}
			
			//条件判断结束，可以进行加工操作,修改加工状态htzt
			$sql = "update tb_gjd_hdzt set jg = 1 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误hdzt！');</script>";
				return false;
			}
			
			//更新加工等级和时间，还要写入加工类型jg_dis
			//$jg_count = $_POST['jgcount'];//加工时间以加工数量为基数，每个10分钟
			$end_time = (string)(mktime()+$jg_count*600);//计算结束时间,这个例子是半分钟为单位的
			//$jg_level = $_POST['jgdj'];
			$sql = "update tb_gjd_hdzt set jg_level = '$jg_level' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错jg_level误！');</script>";
				return false;
			}
			
			//更新数量，以便获取收益
			$sql = "update tb_gjd_hdzt set jg_count = '$jg_count' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错jg_count误！');</script>";
				return false;
			}
			
			//更新结束时间
			$sql = "update tb_gjd_hdzt set jg_end = '$end_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错jg_end误！');</script>";
				return false;
			}
			//更新加工类型
			$sql = "update tb_gjd_hdzt set jg_type = '$jg_type' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错jg_type误！');</script>";
				return false;
			}
			
			echo "<script>window.location.href='jg.php';</script>";//刷新自己
		}
	?>

	<div style="height:600px; width:700px; background-image:url(../bg_image/jg.jpg); background-repeat:round;">
    <!--这个表是2行*4列-->
    	<table border="1" cellspacing="0" cellpadding="0" height="400px" width="400px" style="position:absolute; top:100px; left:150px;" ><form action="" method="post" name="form1">
    		<tr height="50px" align="center"><!--第一行，表头，分为  HP/MP  攻击   防御   经验药水-->
    			<td><input type="button" value="HP/MP药水" name='HPa' id = "HPa" onClick="change('HP'); Ctype('HP');"></td>
    			<td><input type="button" value="攻击药水" name="gjys" id="gjys" onClick="change('gj'); Ctype('gj');"></td>
    			<td><input type="button" value="防御药水" name="fyys" id="fyys" onClick="change('fy'); Ctype('fy');"></td>
    			<td><input type="button" value="经验药水" name="jyys" id="jyys" onClick="change('jyz'); Ctype('jy');"><input type="text" hidden="hidden" value="HP" name="typee" id="typee"></td>
    		</tr>
    		<tr><!--第二行，分别对应4张表-->
    			<td colspan="4">
                	<div class="HP" id="div_HP"><table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px" ><!--HP/MP药水-->
                		<tr>
                			<td width="40%" align="center">加工等级:</td>
                			<td width="60%">
                            	<select name="jgdj_HP" id="jgdj_HP">
                            		<option value="1">1级红蓝药水</option>
                                    <option value="5">5级红蓝药水</option>
                                    <option value="10">10级红蓝药水</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">加工数量:</td>
                			<td>
                            	<select name="jgcount_HP" id="jgcount_HP">
                            		<option value="1">1个</option>
                                    <option value="5">5个</option>
                                    <option value="10">10个</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td><?php echo "通过消耗鱼来获取增加HP/MP的红蓝药水";?></td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>鱼：药水等级相同的鱼*10只/瓶</td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($jgzt==0){?><input type="submit" value="开始加工" name="submit" id="submit"><?php  }else{echo "正在加工。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    
                    <div class="gjnone" id="div_gj">
                    <table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px"><!--攻击药水-->
                		<tr>
                			<td width="40%" align="center">加工等级:</td>
                			<td width="60%">
                            	<select name="jgdj_gj" id="jgdj_gj">
                            		<option value="1">1级攻击药水</option>
                                    <option value="5">5级攻击药水</option>
                                    <option value="10">10级攻击药水</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">加工数量:</td>
                			<td>
                            	<select name="jgcount_gj" id="jgcount_gj">
                            		<option value="1">1个</option>
                                    <option value="5">5个</option>
                                    <option value="10">10个</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td><?php echo "通过消耗植物来获取增加攻击的攻击药水";?></td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>植物：药水等级相同的植物*10株/瓶</td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($jgzt==0){?><input type="submit" value="开始加工" name="submit" id="submit"><?php  }else{echo "正在加工。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    
                    <div class="jyznone" id="div_jy">
                    <table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px" ><!--经验值药水-->
                		<tr>
                			<td width="40%" align="center">加工等级:</td>
                			<td width="60%">
                            	<select name="jgdj_jy" id="jgdj_jy">
                            		<option value="1">1级经验药水</option>
                                    <option value="5">5级经验药水</option>
                                    <option value="10">10级经验药水</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">加工数量:</td>
                			<td>
                            	<select name="jgcount_jy" id="jgcount_jy">
                            		<option value="1">1个</option>
                                    <option value="5">5个</option>
                                    <option value="10">10个</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td><?php echo "通过消耗鱼和植物来获取增加经验的经验药水";?></td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>鱼和植物：药水等级相同的鱼*10只，植物*10株/瓶<?php $type='jy';?></td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($jgzt==0){?><input type="submit" value="开始加工" name="submit" id="submit"><?php  }else{echo "正在加工。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    
                    <div class="fynone" id="div_fy">
                    <table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px"><!--防御药水-->
                		<tr>
                			<td width="40%" align="center">加工等级:</td>
                			<td width="60%">
                            	<select name="jgdj_fy" id="jgdj_fy">
                            		<option value="1">1级防御药水</option>
                                    <option value="5">5级防御药水</option>
                                    <option value="10">10级防御药水</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">加工数量:</td>
                			<td>
                            	<select name="jgcount_fy" id="jgcount_fy">
                            		<option value="1">1个</option>
                                    <option value="5">5个</option>
                                    <option value="10">10个</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td><?php echo "通过消耗鱼、植物和骨头来获取增加防御的防御药水";?></td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>鱼、植物和骨头：药水等级相同的材料*10/瓶<?php $type='fy';?></td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($jgzt==0){?><input type="submit" value="开始加工,10Min/个" name="submit" id="submit"><?php  }else{echo "正在加工。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    </form>
                </td>
    		</tr>
    	</table>	
    </div>
</bojg>
</html>