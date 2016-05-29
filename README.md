# 微信后台实现_校园个人信息认证
![](https://github.com/shelton13/express_validation/blob/master/images/1.jpg)
![](https://github.com/shelton13/express_validation/blob/master/images/2.jpg)
![](https://github.com/shelton13/express_validation/blob/master/images/3.jpg)
## 起因
校园拿快递，每次都要出示身份证明，因此想着写个简单的个人信息验证与微信服务号连接，只要把个人信息与个人证件图片上传到服务器并通过验证。
以后拿快递只需要打开个人信息链接即可显示个人信息。

## 准备
1.新浪SAE
2.BootStrap+PHP+MySQL
3.前端本地客户端压缩图片localResizeIMG
https://github.com/think2011/localResizeIMG
4.申请一个微信公众平台测试帐号

## 使用
##### 1.先到SAE中创建一个新的应用，再创建一个共享型MySQL并把项目下的MySQL文件夹中的两个sql文件import到数据库中，再juba_original中insert一条属于你自己的信息。（后面测试用）

##### 2把init_login.php与show_info.php中的
```php
$appid = '公众号id'; 
$appsecret = '公众号appsecret';
$uri = "服务器地址/show_info.php";
```
#####修改为测试账号中的信息。

##### 3.把所有文件上传服务器中（MySQL_file、images除外）

##### 4.再到公众测试账号修改接口配置信息与网页授权获取用户基本信息。

##### 5.关注公众测试账号并把输入init_login.php地址进行测试
###最后，Enjoy it!
