<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>挂机岛|首页</title>
<script>
	//切换战斗信息/基本信息
	function change(btn)
	{
		//alert(btn);
		if(btn == 'jbxx')
		{
			
			document.getElementById("jbxx_dis").className="jbxx";
			document.getElementById('zdxx_dis').className="zdxx_none";
		}
		else if(btn == 'zdxx')
		{
			//alert('xixi');
			document.getElementById('jbxx_dis').className="jbxx_none";
			document.getElementById('zdxx_dis').className="zdxx";
		}
	}
	//切换活动页面 
	function changeframe(btn)
	{
		switch(btn)
		{
			//alert("haha");
			case 'dy':
				document.getElementById('iframe').src="hd/dy.php"; break;
			case 'gc':
				document.getElementById('iframe').src="hd/gc.php"; break;
			case 'jg':
				document.getElementById('iframe').src="hd/jg.php"; break;
			case 'dl':
				document.getElementById('iframe').src="hd/dl.php"; break;
			case 'zz':
				document.getElementById('iframe').src="hd/zz.php"; break;
			case 'bg':
				document.getElementById('iframe').src="bg.php"; break;
			case 'shop':
				document.getElementById('iframe').src="shop.php"; break;
			case 'zb':
				document.getElementById('iframe').src="zb.php"; break;
			case 'cj':
				document.getElementById('iframe').src="cj.php"; break;
			case 'zd':
				document.getElementById('iframe').src="hd/zd.php"; break;
		}
	}
	//改名
	function changegm()
	{
		document.getElementById('gmdiv').className="jmdiv_dis";
	}
	
</script>
<style>
	.jbxx{
		display:block;
	}
	.jbxx_none{
		display:none;
	}
	
	.zdxx{
		display:block;
	}
	.zdxx_none{
		display:none;
	}
	.jmdiv{
		display:none;
	}
	.jmdiv_dis{
		display:block;
	}
	.none{
		display:none;
	}
	
</style>
</head>

<body><?php session_start(); include("conmysql.php");?>
<?php  

		//PHP脚本也是看顺序的。。。在代码前先执行...
		//取出角色uuid信息
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connID->query($sql);
		$result = $query->fetch_array();
		$uuid = $result[0];
		
		//取出角色基本信息
		$sql_jbxx = "select * from tb_gjd_jbxx where uuid = '$uuid'";
		$query_jbxx = $connID->query($sql_jbxx);
		$result_jbxx = $query_jbxx->fetch_array();
		$user_tx = (string)$result_jbxx['user_tx'];			//头像信息
		$user_name = (string)$result_jbxx['user_name'];		//角色名
		$user_level = $result_jbxx['user_level'];			//角色等级
		$dao_level = $result_jbxx['dao_level'];				//小岛等级
		$money = $result_jbxx['money'];						//当前金钱信息
		$money_h = $result_jbxx['money_h'];					//金钱收益
		$jingyan_h = $result_jbxx['jingyan_h'];				//经验收益
		$vip = $result_jbxx['vip'];

		//取出角色战斗信息
		$sql_zdxx = "select * from tb_gjd_zdxx where uuid = '$uuid'";
		$query_zdxx = $connID->query($sql_zdxx);
		$result_zdxx = $query_zdxx->fetch_array();
		$hp = $result_zdxx['hp'];					//角色血量
		$mp = $result_zdxx['mp'];					//角色蓝量		
		$attck = $result_zdxx['attck'];				//角色攻击
		$fy = $result_zdxx['fy'];					//角色防御
		$jyz = $result_zdxx['jyz'];					//角色当前经验值
		$jyz_level = $result_zdxx['jyz_level']; 		//角色当前等级升级所需经验值
		
		
		//改名函数
			if(isset($_POST['submit']))
			{
				$new_name = $_POST['gm'];
				$sql = "update tb_gjd_jbxx set user_name='$new_name' where user_name = '$uuid'";
				$query = $connID->query($sql);
				if($query)
				{
					echo "<script>alert('修改成功！');</script>";
					//0sleep(3);
					
					echo "<script>window.locahref='index.php';</script>";
				}
			}
	?>
	<div style="background:url(bg_image/xiaodao2.jpg); height: 600px; width: 100%;">
		<!--
        	作者：411491847@qq.com
        	时间：2017-01-11
        	描述:最外层容器
        -->
        <div id="" style="width: 300px; height: 580px;border:3px solid;border-radius: 25px 0px 0px 25px; border-color: gray; position: absolute; left: 150px; top:18px;">
        	<!--
            	作者：411491847@qq.com
            	时间：2017-01-11
            	描述：玩家信息
            -->
            <div id="" style="border-bottom:2px solid; border-color: gray; height: 170px;">
            	<!--
                	作者：411491847@qq.com
                	时间：2017-01-11
                	描述：头像，名称，VIP等级
                -->
                <div id="" style="position: relative; left:5px; width: 150px; height: 150px; top: 8px;">
                	<!--
                    	作者：411491847@qq.com
                    	时间：2017-01-11
                    	描述：头像
                    -->
                    <img height="120" width="120" style="border-radius: 10px; border: 2px solid indianred;" src="<?php echo $user_tx;?>" alt="你的头像">
                    <input type="button" name="changeimg" id="changeimg" value="更换头像" style="position: relative; left: 15px; top: 3px; width: 100px; height: 25px; background-color: indianred;outline: none; border-radius:20px ; font-family:  SimHei;"/>
                </div>
                <div id="" style="position: relative; left:155px; width: 140px; height: 170px; top: -150px; border-left:2px solid gray;">
                	<!--
                    	作者：411491847@qq.com
                    	时间：2017-01-11
                    	描述：角色名,称号，VIP等级
                    -->
                    <div align="center" style=" width:145px;height:30px;font-size: 26px;font-family: STLiti; color: black; font-weight: bold;"><?php echo $user_name;?>
                    	
                    </div>
                    <div id="" align="center" style="border-bottom:2px solid gray; width:145px;height:32px;font-size: 26px; font-weight: bold;">
                    	<input type="button" name="changename" id="changename" value="修改角色名" style=" border-radius: 15px; outline: none; font-family: SimHei; background-color: lightcoral ;" />
                    </div>
                    <div align="center" style=" width:145px;height:28px;font-size: 26px;font-family: STLiti; color: black; font-weight: bold;">无
                    	
                    </div>
                    <div id="" align="center" style="border-bottom:2px solid gray; width:145px;height:18px;font-size: 26px; font-weight: bold;">
                    	<input type="button" name="changename" id="changename" value="修改称号" style=" border-radius: 15px; outline: none; font-family: SimHei; background-color: lightcoral ; position: relative; top:-13px;" />
                    </div>
                    <div id="" align="center" style="height: 46px; width: 145px;">
                    	<div id="" style="position: relative; top:8px; font-family: STLiti; height:25px;">
                    		<b style="font-size: 24px;">VIP等级:<b/><b style="color: red;"><?php if($vip) echo $vip; else echo 0;?><b/>
                    	</div>
                    	<div id="" style="position: relative; top:3px; font-family: STLiti; height: 20px;" >
                    		<input type="button" name="chongzhi" id="chongzhi" value="点我充值" style="font-family: SimSun; border-radius: 15px; outline: none; background-color: lightcoral ;" />
                    	</div>
                    </div>
                </div>
            </div>
            <div id="" style="border-bottom:2px solid; border-color: gray; height: 230px;">
            	<!--
                	作者：411491847@qq.com
                	时间：2017-01-11
                	描述：玩家属性
                -->
            	<div id="" align="center" style="position: relative; top: 5%; font: 20px; font-family: KaiTi; color: black;">
            		当前属性
            	</div>
            	<table width="280" align="center" border="0" cellspacing="0" cellpadding="0" style="position: relative; top: 30px; left: -30px; font-family: KaiTi; font-size:24px; color: black;">
            		<tr>
            			<td align="right">等级</td>
            			<td align="center"><?php echo $user_level;?></td>
            		</tr>
            		<tr>
            			<td align="right">经验</td>
            			<td align="center"><?php echo $jyz;?>/<?php echo $jyz_level;?></td>
            		</tr>
            		<tr>
            			<td align="right">血量</td>
            			<td align="center"><?php echo $hp;?></td>
            		</tr>
            		<tr>
            			<td align="right">攻击</td>
            			<td align="center"><?php echo $attck;?></td>
            		</tr>
            		<tr>
            			<td align="right">防御</td>
            			<td align="center"><?php echo $fy;?></td>
            		</tr>
            		<tr>
            			<td align="right">金钱</td>
            			<td align="center"><?php echo $money;?></td>
            		</tr>
            	</table>
            </div>
            <div id="" style="height: 180px; width: 300px;">
            	<!--
                	作者：411491847@qq.com
                	时间：2017-01-11
                	描述：功能选项:战斗地图、包裹、装备、商店;四格所以平分
                -->
                <div id="" align="center" style="height: 70px;position: relative; top: 20px; left: 20px; border-bottom: 3px solid black;border-right: 3px solid black; width: 130px; ">
                	<!--
                    	作者：411491847@qq.com
                    	时间：2017-01-18
                    	描述：战斗地图
                    -->
                    <input type="button" id="zddt" value="战斗地图" onclick="changeframe('zd');" style="font-size: 24px; width: 120px; height: 70px; border-radius: 50px; outline: none; background: aquamarine; font-family: KaiTi; font-weight: bold;" />
                </div>
                <div id="" align="center" style="height: 70px;position: relative; top: -53px; left: 150px; border-bottom: 3px solid black; width: 130px;">
                	<!--
                    	作者：411491847@qq.com
                    	时间：2017-01-18
                    	描述：包裹
                    -->
                    <input type="button" id="bg" value="包裹" onclick="changeframe('bg');" style="font-size: 24px; width: 120px; height: 70px; border-radius: 50px; position: relative; left: 3px; outline: none;background: aquamarine;font-family: KaiTi; font-weight: bold;" />
                </div>
                <div id="" align="center" style="height: 70px;position: relative; top: -50px; left: 20px; border-bottom: 3px solid black;border-right: 3px solid black; width: 130px;">
                	<!--
                    	作者：411491847@qq.com
                    	时间：2017-01-18
                    	描述：装备
                    -->
                    <input type="button" id="zb" value="装备" onclick="changeframe('zb');" style="font-size: 24px; width: 120px; height: 70px; border-radius: 50px; outline: none;background: aquamarine;font-family: KaiTi; font-weight: bold;" />
                </div>
                <div id="" align="center" style="height: 70px;position: relative; top: -123px; left: 150px; border-bottom: 3px solid black; width: 130px;">
                	<!--
                    	作者：411491847@qq.com
                    	时间：2017-01-18
                    	描述：商店
                    -->
                    <input type="button" id="shop" value="商店" onclick="changeframe('shop');" style="font-size: 24px; width: 120px; height: 70px; border-radius: 50px; position: relative; left: 3px; outline: none;background: aquamarine;font-family: KaiTi; font-weight: bold;" />
                </div>
            </div>
        </div>
    	<div id=""  style="border:3px solid; border-color: gray; border-left:0;border-radius:0 25px 25px 0; width: 800px; height: 580px;position: absolute; left: 450px; top: 18px;">
    		<!--
            	作者：411491847@qq.com
            	时间：2017-01-11
            	描述：游戏舞台
           -->         
           <div id="" style="border-bottom:2px solid;border-right: 2px solid; border-color: gray; height: 80px; position: relative; left: 3px; width: 200px;">
           	<!--
               	作者：411491847@qq.com
               	时间：2017-01-11
               	描述：标题
               -->
               <div align="center" style="font-size: 40px; color: black; position: relative; top: 18px;">活      动</div>
           </div>
           <div id="" style="border-bottom:2px solid; border-color: gray; height:px; position: relative;top:-2px; left: 203px; width:600px;">
           	<!--
               	作者：411491847@qq.com
               	时间：2017-01-11
               	描述：二级菜单
               -->
           </div>
           <div id="" style="border:2px solid gray;position: relative;border-radius: 20px; top: 10px; left: 13px; width: 776px; height: 470px;">
           	<!--
               	作者：411491847@qq.com
               	时间：2017-01-11
               	描述：内嵌网页区
               -->
           	<iframe src="hd/zd.php" frameborder="2" height="470" width="776" id="iframe"></iframe>
           </div>
    	</div>
    </div>
    <?php $connID->close(); ?>
</body>
</html>