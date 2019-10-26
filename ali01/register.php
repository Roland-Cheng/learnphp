<?php
$output=ture;
            if ($_POST['submit']) {
                echo 'hello world';
                require_once(dataconnect.php);
                $username=mysqli_real_escape_string($dbc,trim($_POST['username']));
                $password=mysqli_real_escape_string($dbc,trim($_POST['password']));
                $email=$_POST['email'];
                $output=false;
                if ((empty($username))&&(empty($password))){
                    echo '用户名和密码为空';
                    $output=ture;
                }
                if ((empty($username))&&(!empty($password))){
                    echo '用户名为空';
                    $output=ture;
                }
                if ((!empty($username))&&(empty($password))){
                    echo '密码为空';
                    $output=ture;
                }
                if ((!empty($username))&&(!empty($password))){
                    $query="select * from userinfo where username = $username";
                    $result=mysqli_query($dbc,$query);
                    if(！empty($result)) {
                        echo'用户名重复';
                        $output=ture;
                    }
                    else {
                        $passwd=SHA('$password');
                        $query="insert into userinfo (username,password,email)".
                        "values ('$username','$passwd');";
                        $result=mysqli_query($dbc,$query)
                        or die("注册失败");
                        mysqli_close($dbc);
                        echo'注册成功，请登录<br/>';
                        echo'<a href="Login.php"><input type="button" value="登录“</a>';
                    }
                }
                mysqli_close($dbc);
            }
            if ($output) {
            ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>注册</title>
    </head>
    <body>
        <form method="post" action="register.php">
            <label for="username">用户名：</label>
            <input class="inputtxt" type="text" id="username" name="username" maxlength="12"><br/>
            <label for="password">密码：</label>
            <input class="inputtxt" type="text" id="password" name="password" maxlength="25"><br/>
            <label for="password">邮箱：</label>
            <input class="inputtxt" type="text" id="email" name="email" maxlength="30"><br/>
            <input type="button" id="submit" name="submit" value="注册">
        </form>
    </body>
</html>
<?php
            }
            ?>