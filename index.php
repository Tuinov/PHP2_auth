<?php
class User {

    public $user = 'user';

    public function Templater($file, $params) {
        foreach($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include ($file);
        return ob_get_clean();
    }

    function getAll() {
        define('DB_DRIVER', 'mysql');
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'geekbrains');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        // $dbh = new PDO('mysql:host=localhost;port=3307;dbname=geekbrains', 'root', '');
                try {
                    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';port=3307;dbname=' . DB_NAME;
                    $db = new PDO($connect_str, DB_USER, DB_PASS);
                    // $result = $db->query("SELECT * FROM geekbrains.goods where id > {$tt} limit 3");
        
                    $sth = $db->prepare("SELECT * FROM geekbrains.users");
                    $sth->execute();
                    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                    
                } catch (PDOException $e) {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
                }
        
        
            }
        

    public function isAuth() {
        if($_GET) {
            foreach ((new User)->getAll() as $value) {
                if ($_GET['login'] == $value['login']) {
                    $this->user = $value['name'];
                    return true;
                } 
            }
        } else {
            return false; 
        }      
        
    }
}

$content = date('d.m.Y');
$auth = (new User)->isAuth();

$page =(new User)->Templater("view.php", [
    'title'=>'Регистрация',
    'auth' => (new User)->isAuth(),
    'user' => (new User)->user,
    'content'=> $content
]);

// выход из системы
if($_GET['logout']) {
    $auth = false;
}

echo $page;