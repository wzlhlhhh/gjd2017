<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	html,bogc{
overflow:hidden;
height:100%;

}
	.wq{
		z-index:1;
		display:block;
	}
	.wqnone{
		display:none;
	}
	
	.zj{
		z-index:1;
		display:block;
	}
	.zjnone{
		display:none;
	}
	
	.xzz{
		z-index:1;
		display:block;
	}
	.xzznone{
		display:none;
	}
	
	.kz{
		z-index:1;
		display:block;
	}
	.kznone{
		display:none;
	}
</style>
<script>
	function change(btn)//定义工厂生产类型按钮使div发生的变化
	{
		//alert(btn);
		if(btn == 'wq')
		{
			
			document.getElementById("div_wq").className="wq";
			document.getElementById('div_zj').className="zjnone";
			document.getElementById('div_kz').className="kznone";
			document.getElementById('div_xz').className="xzznone";
			document.getElementById("typee").value="hp";
		}
		else if(btn == 'zj')
		{
			//alert('xixi');
			document.getElementById("div_wq").className="wqnone";
			document.getElementById('div_zj').className="zj";
			document.getElementById('div_kz').className="kznone";
			document.getElementById('div_xz').className="xzznone";
			document.getElementById("typee").value="zj";
		}
		else if(btn == 'kz')
		{
			document.getElementById("div_wq").className="wqnone";
			document.getElementById('div_zj').className="zjnone";
			document.getElementById('div_kz').className="kz";
			document.getElementById('div_xz').className="xzznone";
			document.getElementById("typee").value="kz";
		}
		else if(btn == 'xzz')
		{
			document.getElementById("div_wq").className="wqnone";
			document.getElementById('div_zj').className="zjnone";
			document.getElementById('div_kz').className="kznone";
			document.getElementById('div_xz').className="xzz";
			document.getElementById("typee").value="xz";
		}
		
		function Ctype(t)//获取工厂生产类型
		{
			//alert('haha');
			switch(t)
			{
				case 'wq': document.getElementById('type').value='wq'; break;
				case 'zj': document.getElementById('type').value='zj'; break;
				case 'kz': document.getElementById('type').value='kz'; break;
				case 'xz': document.getElementById('type').value='xz'; break;
			}
		}
	}
</script>
</head>

<bogc><?php session_start();//工厂把骨头生产成装备，武器+攻击/衣服+防御/裤子+hp/鞋子+hp+攻击?>
	<?php
    	include('../conmysql.php');
		//获取uuid
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connID->query($sql);
		$result = $query->fetch_array();
		$uuid = (int)$result[0];
		
		//获取当前工厂生产状态，根据状态来显示网页
		$sql_zt = "select * from tb_gjd_hdzt where uuid = '$uuid'";
		$query_zt = $connID->query($sql_zt);
		$result_zt = $query_zt->fetch_array();
		$gczt = $result_zt['gc'];
		
		//如果工厂正在生产，判断是否结束工厂生产
		$now_time = mktime();
		$gc_end = $result_zt['gc_end'];
		//$gc_count = $result_zt['gc_count'];//获取收益的数量,装备只出一把
	
		if($now_time > $gc_end && ($gc_end != 100) && isset($gc_end))
		{
			//工厂生产完成，获取收益
			//往背包里添加相应的药剂
			$zb_type = $result_zt['gc_type'];
			$gc_level = $result_zt['gc_level'];
			//$gc_count = (int)$result_zt['gc_count'];//数量
			$sql_gc = "select * from tb_gjd_gc where zb_level = '$gc_level' and zb_type = '$zb_type'";
			$query_gc = $connID->query($sql_gc);
			$result_gc = $query_gc->fetch_array();
			$gc_dis = (string)$result_gc['zb_dis'];//获取工厂生产产品描述
			$gc_name = (string)$result_gc['zb_name'];
			
			//添加药剂
			//查询当前字段是否存在，如果存在，采用update
			$sql = "select * from tb_gjd_zb where uuid='$uuid' and zb_name = '$zb_name'";
			$query = $connID->query($sql);
		 	$num = $query->num_rows;
			//var_dump($num);	
			if($num == 0)//若不存在
			{	
				//取得这个物品的图标
				$sql_pic = "select pic from tb_gjd_pic where bg_name = '$gc_name'";
				$query_pic = $connID->query($sql_pic);
				$result_pic = $query_pic->fetch_array();
				$pic = $result_pic['pic'];
				
				$sql_add = "insert into tb_gjd_zb(uuid, zb_name, zb_count, zb_pic, zb_dis) values('$uuid', '$gc_name', 1, '$pic', '$gc_dis')";
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
				$sql_add = "update tb_gjd_zb set zb_count=(zb_count+1) where zb_name = '$gc_name' and uuid='$uuid'";//确认没问题，就跟新信息
				$query_add = $connID->query($sql_add);
				if(!$query_add)
				{
					echo "<script>alert('发生未知错误update');</script>";
					return false;
				}
			}
			
			//我想还需要把原料清除出去
			//获取当前工厂生产种类需要的原料
			$sql_cl = "select * from tb_gjd_gc where zb_type='$zb_type' and zb_level='$gc_level'";
			$query_cl = $connID->query($sql_cl);
			$result_cl = $query_cl->fetch_array();
			$gccl1 = $result_cl['zb_cl1'];
			$gccl2 = $result_cl['zb_cl2'];
			$gccl3 = $result_cl['zb_cl3'];
			
			//清除
			if(null != (trim($gccl1)))
			{
				//更新包裹的物品数量
				//对比条件一
				//$sql_bg_cl1 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$gccl1'";
				//var_dump($gc_count);
				$sql_bg_cl1_up = "update tb_gjd_bg set bg_count = (bg_count-$gc_level*10) where bg_name = '$gccl1' and uuid='$uuid' ";
				$query_bg_cl1 = $connID->query($sql_bg_cl1_up);
				
				if(!$query_bg_cl1)
				{
					echo "<script>alert('发生未知错误cl1');/script>";
					return false;
				}
				
				//如果存在条件二，对比条件二	
				if(null != (trim($gccl2)))
				{
					$sql_bg_cl2_up = "update tb_gjd_bg set bg_count = (bg_count-$gc_level*10) where bg_name = '$gccl2'  and uuid='$uuid'";
					$query_bg_cl2 = $connID->query($sql_bg_cl2_up);
					
					if(!$query_bg_cl2)
					{
						echo "<script>alert('发生未知错误cl2');/script>";
						return false;
					}
						
					
					//如果存在条件三，对比条件三
					if(null != (trim($gccl3)))
					{
						$sql_bg_cl3_up = "update tb_gjd_bg set bg_count = (bg_count-$gc_level*10) where bg_name = '$gccl3'  and uuid='$uuid'";
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
			
			//将gc_end重置为100
			$sql = "update tb_gjd_hdzt set gc_end = 100 where uuid = '$uuid'";
			$query = $connID->query($sql);
			if(!$query)
				{
					echo "<script>alert('发生未知错误gc_end！');</script>";
					return false;
				}
			
			
			//重置工厂生产状态
			$gczt = 0;
			$sql = "update tb_gjd_hdzt set gc = 0 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误！reset');</script>";
				return false;
			}
		}
		
		//如果当前是工厂正在生产状态，获取当前的工厂生产信息用来显示
		/*if($gczt == 1)
		{
			$gc_level = $result_zt['zb_level'];
			//$gc_count = $result_zt['gc_count'];
				
			//获取工厂生产信息表
			$sql_gc = "select * from tb_gjd_gc where zb_level = '$gc_level' zb_name = '$gc_name'";
			$query_gc = $connID->query($sql_gc);
			$result_gc = $query_gc->fetch_array();
			$gc_dis = $result_gc['zb_dis'];
		}*/
		
		if(isset($_POST['submit']))//提交之后写入数据
		{
			//首先判断是进行什么工厂生产
			$zb_type = $_POST['typee'];
			$gc_level = (int)$_POST["gcdj_$zb_type"];//获取当前工厂生产类型的等级,
			//var_dump($gc_count);
			//var_dump($zb_type);var_dump($gc_level);
			
			//判定工厂生产条件是否满足，方式是比较三个材料的个数
			$sql_cl = "select * from tb_gjd_gc where zb_type='$zb_type' and zb_level='$gc_level'";
			$query_cl = $connID->query($sql_cl);
			$result_cl = $query_cl->fetch_array();
			$gccl1 = $result_cl['gc_cl1'];
			$gccl2 = $result_cl['gc_cl2'];
			$gccl3 = $result_cl['gc_cl3'];
			$zbcl1 = $result_cl['zb_cl1_count'];//材料需求
			$zbcl2 = $result_cl['zb_cl2_count'];
			$zbcl3 = $result_cl['zb_cl3_count'];
			
			//如果当前条件存在，则进行判断
			if(null != (trim($gccl1)))
			{
				//查看包裹里的需求物品个数是否满足
				//对比条件一
				$sql_bg_cl1 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$gccl1'";
				$query_bg_cl1 = $connID->query($sql_bg_cl1);
				$result_bg_cl1 = $query_bg_cl1->fetch_array();
				//$gccl1_bg_count = $result_bg_cl1['bg_count'];//数量要求为等级*10
				
				if($gccl1_bg_count < $zbcl1)
				{
					echo "<script>alert('物品1数量不足！');</script>";
					echo "<script>window.location.href='gc.php';</script>";
				}
				//如果存在条件二，对比条件二	
				if(null != (trim($gccl2)))
				{
					$sql_bg_cl2 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$gccl2'";
					$query_bg_cl2 = $connID->query($sql_bg_cl2);
					$result_bg_cl2 = $query_bg_cl2->fetch_array();
					//$gccl2_bg_count = $result_bg_cl2['bg_count'];
					
					if($gccl2_bg_count < $zbcl2)
					{
						echo "<script>alert('物品2数量不足！');</script>";
						echo "<script>window.location.href='gc.php';</script>";
					}
					
					//如果存在条件三，对比条件三
					if(null != (trim($gccl3)))
					{
						$sql_bg_cl3 = "select * from tb_gjd_bg where uuid='$uuid' and bg_name='$gccl3'";
						$query_bg_cl3 = $connID->query($sql_bg_cl3);
						$result_bg_cl3 = $query_bg_cl3->fetch_array();
						//$gccl3_bg_count = $result_bg_cl3['bg_count'];
						
						if($gccl3_bg_count < $zbcl3)
						{
							echo "<script>alert('物品3数量不足！');</script>";
							echo "<script>window.location.href='gc.php';</script>";
							return false;
						}
					}
				}
			}
			
			//条件判断结束，可以进行工厂生产操作,修改工厂生产状态htzt
			$sql = "update tb_gjd_hdzt set gc = 1 where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错误hdzt！');</script>";
				return false;
			}
			
			//更新工厂生产等级和时间，还要写入工厂生产类型gc_dis
			//$gc_count = $_POST['gccount'];//工厂生产时间以工厂生产数量为基数，每个10分钟
			$end_time = (string)(mktime()+$gc_level*600);//计算结束时间,这个例子是半分钟为单位的
			//$gc_level = $_POST['gcdj'];
			$sql = "update tb_gjd_hdzt set gc_level = '$gc_level' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错gc_level误！');</script>";
				return false;
			}
			
			//更新数量，以便获取收益
			/*$sql = "update tb_gjd_hdzt set gc_count = '$gc_count' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错gc_count误！');</script>";
				return false;
			}*/
			
			//更新结束时间
			$sql = "update tb_gjd_hdzt set gc_end = '$end_time' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错gc_end误！');</script>";
				return false;
			}
			//更新工厂生产类型
			$sql = "update tb_gjd_hdzt set gc_type = '$zb_type' where uuid='$uuid'";
			$query = $connID->query($sql);
			if(!$query)
			{
				echo "<script>alert('发生未知错gc_type误！');</script>";
				return false;
			}
			
			echo "<script>window.location.href='gc.php';</script>";//刷新自己
		}
	?>

	<div style="height:600px; width:700px; background-image:url(../bg_image/gc.jpg); background-repeat:round;">
    <!--这个表是2行*4列-->
    	<table border="1" cellspacing="0" cellpadding="0" height="400px" width="400px" style="position:absolute; top:100px; left:150px;" ><form action="" method="post" name="form1">
    		<tr height="50px" align="center"><!--第一行，表头，分为  wq/MP  攻击   防御   鞋子-->
    			<td><input type="button" value="制造武器" name='wqa' id = "wqa" onClick="change('wq'); Ctype('wq');"></td>
    			<td><input type="button" value="制造战甲" name="zxzs" id="zxzs" onClick="change('zj'); Ctype('zj');"></td>
    			<td><input type="button" value="制造裤子" name="kzys" id="kzys" onClick="change('kz'); Ctype('kz');"></td>
    			<td><input type="button" value="制造鞋子" name="xzys" id="xzys" onClick="change('xz'); Ctype('xz');"><input type="text" hidden="hidden" value="wq" name="typee" id="typee"></td>
    		</tr>
    		<tr><!--第二行，分别对应4张表-->
    			<td colspan="4">
                	<div class="wq" id="div_wq"><table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px" ><!--wq/MP药水-->
                		<tr>
                			<td width="40%" align="center">工厂生产等级:</td>
                			<td width="60%">
                            	<select name="gcdj_wq" id="gcdj_wq">
                            		<option value="1">1级武器</option>
                                    <option value="5">5级武器</option>
                                    <option value="10">10级武器</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td>打造武器提高攻击力</td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>装备等级*10块装备等级的骨头</td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($gczt==0){?><input type="submit" value="开始工厂生产" name="submit" id="submit"><?php  }else{echo "工厂正在生产。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    
                    <div class="zjnone" id="div_zj">
                    <table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px"><!--战甲-->
                		<tr>
                			<td width="40%" align="center">工厂生产等级:</td>
                			<td width="60%">
                            	<select name="gcdj_zj" id="gcdj_zj">
                            		<option value="1">1级战甲</option>
                                    <option value="5">5级战甲</option>
                                    <option value="10">10级战甲</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td>打造战甲提高防御</td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>装备等级*10块装备等级的骨头</td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($gczt==0){?><input type="submit" value="开始工厂生产，10min/个" name="submit" id="submit"><?php  }else{echo "工厂正在生产。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    
                    <div class="xzznone" id="div_xz">
                    <table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px" ><!--经验值药水-->
                		<tr>
                			<td width="40%" align="center">工厂生产等级:</td>
                			<td width="60%">
                            	<select name="gcdj_xz" id="gcdj_xz">
                            		<option value="1">1级鞋子</option>
                                    <option value="5">5级鞋子</option>
                                    <option value="10">10级鞋子</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td>打造鞋子提高攻击力和HP</td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>装备等级*10块装备等级的骨头</td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($gczt==0){?><input type="submit" value="开始工厂生产" name="submit" id="submit"><?php  }else{echo "工厂正在生产。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    
                    <div class="kznone" id="div_kz">
                    <table border="2" cellpadding="0" cellspacing="0" align="center" height="300px" width="300px"><!--裤子-->
                		<tr>
                			<td width="40%" align="center">工厂生产等级:</td>
                			<td width="60%">
                            	<select name="gcdj_kz" id="gcdj_kz">
                            		<option value="1">1级裤子</option>
                                    <option value="5">5级裤子</option>
                                    <option value="10">10级裤子</option>	
                            	</select>
                            </td>
                		</tr>
                		<tr>
                			<td align="center">描述:</td>
                			<td>打造裤子提高HP</td>
                		</tr>
                		<tr>
                			<td align="center">材料需求：</td>
                			<td>装备等级*10块装备等级的骨头</td>
                		</tr>
                		<tr>
                			<td width="100%" colspan="2" align="center"><?php if($gczt==0){?><input type="submit" value="开始工厂生产" name="submit" id="submit"><?php  }else{echo "工厂正在生产。。。";}?></td>
                		</tr>
                	</table>
                    </div>
                    </form>
                </td>
    		</tr>
    	</table>	
    </div>
</bogc>
</html>