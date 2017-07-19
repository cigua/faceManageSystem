<?php
	
	/* 开启session */
	session_start();

	$userName=$_POST['form-username']; //获取用户名
	$userPassword=md5($_POST['form-password']); //获取密码并进行md5加密

	echo $userName,$userPassword;

	$dbHostName="localhost"; //主机名
	$dbUserName="root"; //数据库用户名
	$dbUserPassword="syq532597"; //数据库登录密码

	$dbName="face"; //数据库名称


	$db_conn=mysqli_connect($dbHostName,$dbUserName,$dbUserPassword); //连接数据库


	if(!$db_conn){
		echo "<br>DataBase Error";
		//die('Could not connect:'.mysql_error());
	}
	
	mysqli_select_db($dbName,$db_conn); //选择face数据库

	$sql="SELECT * FROM fa_users WHERE userName=$userName AND userPassword=$userPassword limit 1";
	$result=mysqli_query($db_conn,$sql);
	if(mysqli_num_rows($result)>0)){
    	$_SESSION['userName'] = $userName;
    	echo $userName,' 欢迎你！进入';
    	
	}

	else{
    	echo "Failed";
	}
?>