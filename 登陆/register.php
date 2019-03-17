<?php
    header("content-type:text/html;charset=utf-8");
    session_start();
    
    //接收表单传递的用户名和密码
    $name=$_POST['user'];
    $pwd=$_POST['psd1'];
    $repwd=$_POST['psd2'];
    $email=$_POST['eml'];
    //下面判断信息是不是输入完整
    if(empty($name)||empty($pwd)||empty($repwd)||empty($email)){
        echo "<script>alert('信息输入没完整');</script>";
        echo "<script>window.location='register.html';</script>";
    }else
    //判断密码是否一 致
    if ($pwd!=$repwd) {
        echo"<script>alert('两次密码输入不一致，请重新输入');</script>";
        echo"<script>location='register.html'</script>";
    }else{  
            //通过php连接到mysql数据库
            $conn=mysqli_connect("localhost","user","asdfghjkl",'register');
            //选择数据库
            
            $sql1 = "SELECT * FROM t1 WHERE username='$name'";
            $result = mysqli_query($conn,$sql1);
            $rows = mysqli_num_rows($result); 
            if($rows>0) {
                echo "<script>alert('用户名已经有人注册了，重新注册一个吧')</script>";
                echo "<script>window.location='register.html'</script>";
            }
            else {
                echo "用户名可用\n";
                //设置客户端和连接字符集
                mysqli_query($conn,"set names utf8");
    
                //通过php进行insert操作
                $sqlinsert="insert into t1(username,password,email) values('{$name}','{$pwd}','{$email}')";
                //返回用户信息字符集
                $result=mysqli_query($conn,$sqlinsert);
                if(! $result )
                    {
                      die('Could not enter data: ' . mysql_error());
                    }
                    echo "恭喜你注册成功\n";
                
                //释放连接资源
                mysqli_close($conn);
                }
                            
                
                              
            } 
    
?>