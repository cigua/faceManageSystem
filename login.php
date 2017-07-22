<?php
	
	/* php7废弃了mysql类的函数,对mysql的操作改用mysqli进行 */


	/* 开启session */
	session_start();

	$userName=$_POST['form-username']; //获取表单用户名
	$userPassword=md5($_POST['form-password']); //获取表单密码并进行md5加密

	

	$dbHostName="localhost"; //数据库实例的Server名称
	$dbUserName="root"; //登录mysql-server的用户名
	$dbUserPassword="syq532597"; //登录密码
	$dbName="face"; //数据库名称


	$db_conn=new mysqli($dbHostName,$dbUserName,$dbUserPassword,$dbName); //连接数据库Server并选择face数据库
	if($db_conn->connect_error){
		die("Error,Can't connect to the mysql-server!: ".$db_conn->connect_error);
	}

	

	$sql = "SELECT * FROM face_users WHERE userName='$userName' AND userPassword='$userPassword' limit 1";
	$result=$db_conn->query($sql);

	if($result->num_rows>0){
    	$_SESSION['userName'] = $userName;
    	header("refresh:0;url=main/index.php");//如果成功跳转至main/index.php页面
        exit;
	}

	else{
		 echo "表单填写不完整";
        echo "
           <script>
              setTimeout(function(){window.location.href='index.php';},1000);
           </script>";
 
            //如果错误使用js 1秒后跳转到登录页面重试;
	}
?>