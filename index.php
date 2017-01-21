<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>挂机岛</title>
<script type="text/javascript">
	var DEFAULT_VERSION = "8.0";
	var ua = navigator.userAgent.toLowerCase();
	var isIE = ua.indexOf("msie")>-1;
	var safariVersion;
	if(isIE){
	    safariVersion =  ua.match(/msie ([\d.]+)/)[1];
	    if(safariVersion <= DEFAULT_VERSION ){
	        alert("请更换IE9.0以上版本的浏览器！");
	    }else{
	        // 跳转至页面2
	    }
	}else{
	    // 跳转至页面2
	}
</script>
<style>
	header{
		font-size:40px;
		font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
		font-weight:bold;
		color:#F72528;
	}
	.bg{
		position:absolute;
		left:15%;
		width:70%;
		height:500px;
		top:20%;
	}
	.dl{
		font-size:26px;
		font-weight: 800;
		color: red;
	}
	.dd{
		font-size:24px;
		font-weight: 500;
		font-weight:bold;
		color: blue;
	}
	.ddd{
		font-size:16px;
		font-weight: 500;
		font-weight:bold;
		color: blue;
	}
	
	.ThreeDee {
	font-family: 'Microsoft YaHei';
	line-height: 1.5em;
	color: red;
	font-weight:bold;
	text-align: center;
	font-size: 80px;
	text-shadow:0px 0px 0 rgb(68,16,16),-1px 1px 0 rgb(53,1,1),-2px 2px 0 rgb(39,-13,-13),-3px 3px 0 rgb(24,-28,-28),-4px 4px 0 rgb(10,-42,-42),-5px 5px 0 rgb(-5,-57,-57), -6px 6px 0 rgb(-19,-71,-71),-7px 7px 6px rgba(0,0,0,0.6),-7px 7px 1px rgba(0,0,0,0.5),0px 0px 6px rgba(0,0,0,.2);
	behavior: url(ie-css3.htc); /* 通知IE浏览器调用脚本作用于'box'类 */
		}
		
	.an{
		 font-family: Arial;
  color: #ffffff;
  font-size: 35px;
  padding: 10px;
  text-decoration: none;
  -webkit-border-radius: 28px;
  -moz-border-radius: 28px;
  border-radius: 28px;
  -webkit-box-shadow: 0px 1px 3px #666666;
  -moz-box-shadow: 0px 1px 3px #666666;
  box-shadow: 0px 1px 3px #666666;
  text-shadow: 1px 1px 3px #666666;
  border: solid #d91c71 2px;
  background: -webkit-gradient(linear, 0 0, 0 100%, from(#fc3f94), to(#fc0574));
  background: -moz-linear-gradient(top, #fc3f94, #fc0574);
		}
.form-control { 
display: block; 
width: 100%; 
height: 34px; 
padding: 6px 12px; 
font-size: 14px; 
line-height: 1.428571429; 
color: #555555; 
vertical-align: middle; 
background-color: #ffffff; 
border: 1px solid #cccccc; 
border-radius: 4px; 
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075); 
box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075); 
-webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s; 
transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s; 
} 
.form-control:focus { 
border-color: #66afe9; 
outline: 0; 
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6); 
box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6); 
} 

</style>
</head>

<body>

	<?php session_start();?>
	<header align="center" class="ThreeDee" >~~欢迎来到挂机岛~~</header>
    <table align="center" border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td>
        		<!--<embed src="bg_image/xunsc.swf" quality=high width="600" height="440"      
              wmode=transparent type='application/x-shockwave-flash'></embed>-->
        		<img src="bg_image/23.gif" alt="你可以想象下这里有一张图片，上面有岛，还有水" width="600" height="440"></td>
        </tr>
    	<tr>
        	<td>
            	<div class="dl">归来的岛民，亮出你的身份信息，我就让你上岛！</div>
            </td>
        </tr>
        <tr>
        	<td><table border="0" cellpadding="0" cellspacing="0" align="center" class="dd"><form action="" name="form1" method="post">
            	<tr>
            		<td>岛民号：</td>
            		<td><input type="text" name="username" id="username" class="form-control"></td>
            	</tr>
            	<tr>
            		<td>岛民口令：</td>
            		<td><input type="password" name="password" id="password" class="form-control"></td>
            	</tr>
            	<tr>
            		<td><input type="submit"  value="上岛" id="submit" name="submit" style=" font-family: Arial;
  color: #000000;
  font-size: 20px;
  padding: 5px;
  text-decoration: none;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
  -webkit-box-shadow: 0px 1px 3px #000000;
  -moz-box-shadow: 0px 1px 3px #000000;
  box-shadow: 0px 1px 3px #000000;
  text-shadow: 1px 1px 3px #000000;
  border: solid #000000 1px;
"></td>
            		<td><input type="button" value="忘记口令" id="wjkl" name="wjkl" onClick="" style=" color: #000000;
  font-size: 20px;
  padding: 5px;
  text-decoration: none;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
  -webkit-box-shadow: 0px 1px 3px #000000;
  -moz-box-shadow: 0px 1px 3px #000000;
  box-shadow: 0px 1px 3px #000000;
  text-shadow: 1px 1px 3px #000000;
  border: solid #000000 1px;"></td>
            	</td></form></tr>
            </table>
        </tr>
    	<tr>
        	<td>
            	<div class="dl">想入驻这座岛屿？来我这里<a href="register.php">登记</a>报道吧！</div>
            </td>
        </tr>
    </table>
    <?php
    	if(isset($_POST['submit']))
		{
			include("conmysql.php");
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$sql = "select * from tb_gjd_user where username ='$username'";
			$query = $connID->query($sql);
			$num = $query->num_rows;
			
			if($num != 0)
			{
				$_SESSION["username"] = $username;
				echo "<script>alert('通过验证，成功入岛');</script>";
				echo "<script>document.location='first_test.php';</script>";
				$connID->close();
			}
			else
			{
				echo "<script>alert('口令/ID出错！');</script>";
			}
			
		}
	?>
    <!--<div class="bg" align="center" id="bgpic"><img src="bg_image/xiaodao.png" alt=""></div>
    <div align="center" style="position:absolute; top:10%;"><span class="dl">归来的岛民，亮出你的身份信息，我就让你上岛！</span></div>
    <div>想入驻这座岛屿？来我这里登记报道吧！</div>-->
</body>
</html>