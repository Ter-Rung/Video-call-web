
<?php
const _DB = 'testphp'; // tên database
const _HOST = 'localhost'; 
const _USER ='root';
const _PASS = '';

try {
    if(class_exists('PDO')) {
        $dsn = 'mysql:dbname='._DB.';host='._HOST;
        $connect = new PDO($dsn,_USER,_PASS);
        //set utf8
        $connect->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAME utf8');
        //tạo thông báo ra ngoại lệ khi gặp lỗi
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo("Connection successful" ) ;
    }
}
catch (Exception $e){
echo "Connection failed: ".$e -> getMessage() ."<br>";
die();
}
 ?>