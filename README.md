newstore
========

A Symfony project created on October 9, 2018, 9:44 am.</br>
Create user with command   <b>php bin/console fos:user:create testuser test@example.com p@ssword</b></br>
Grand user with some role  <b>php bin/console fos:user:promote testuser ROLE_ADMIN</b></br>

Then you can get token like this:</br>
curl -X POST -H "Content-Type: application/json" http://localhost/newstore/web/app_dev.php/api/login_check -d '{"username":"go","password":"123456"}'

![alt text](https://github.com/abudu1985/newstore/blob/master/web/images/Selection_005.png)


And use it like this: </br>
 curl -H "Authorization: Bearer [TOKEN]" http://localhost/newstore/web/app_dev.php/api/orders/
![alt text](https://github.com/abudu1985/newstore/blob/master/web/images/Selection_006.png)
