<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '2_5_oop_crud');
class Database
{
    // private $db_host = 'localhost';
    // private $db_user = 'root';
    // private $db_pass = '';
    // private $db_name = '2_5_oop_crud';
    private $conn;


    public function __construct()
    {
        // $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->conn) {
            die('Not Connected' . $this->conn->error);
        }
    }

    public function show($table) {
        $sql = "SELECT * FROM `$table`";
        $result = $this->conn->query($sql);
        $records = $result->fetch_all(MYSQLI_ASSOC);
        return $records;
    }


    public function show_single($table, $id) {
        $sql = "SELECT * FROM `$table` WHERE `id` = $id";
        $result = $this->conn->query($sql);
        $records = $result->fetch_assoc();
        return $records;
    }


    public function insert($table, $data) {
        $columns = array_keys($data);
        $values = array_values($data);

        $columns = implode('`, `', $columns);
        $values = implode("', '", $values);

        $sql = "INSERT INTO `$table`(`$columns`) VALUES ('$values')";
    
        return $this->conn->query($sql) ? true : false;
    }


    public function update($table, $data, $id) {
        $pairs = [];
        foreach($data as $key => $value) {
            $pairs[] = "`" . $key . "` = '" . $value . "'"; 
        }
        $pairs = implode(", ", $pairs);
        $sql = "UPDATE `$table` SET $pairs WHERE `id` = $id";
    
        return $this->conn->query($sql) ? true : false;
    }

    
    public function delete($table, $id) {
        $sql = "DELETE FROM `$table` WHERE `id` = $id";
    
        return $this->conn->query($sql) ? true : false;
    }

}

$database = new Database;
// echo '<pre>';
// print_r($database->show('users'));
// echo '</pre>';

// echo '<pre>';
// print_r($database->show('products'));
// echo '</pre>';

// $data = [
//     'name' => 'Alia',
//     'email' => 'alia@gmail.com',
//     'password' => sha1('12345'),
// ];

// if($database->insert('users', $data)) {
//     echo 'Inserted';
// } else {
//     'Failed';
// }

// $data = [
//     'price' => 35,
//     'description' => 'Something',
// ];


// if($database->insert('products', $data)) {
//     echo 'Inserted';
// } else {
//     'Failed';
// }

// $data = [
//     'name' => 'Alia Bibi',
//     'email' => 'aliabibi@gmail.com',
// ];

// echo $database->update('users', $data, 3) ? 'Updated' : 'Failed';
// echo $database->delete('users', 3) ? 'Deleted' : 'Failed';

echo '<pre>';
print_r($database->show_single('products', 1));
echo '</pre>';

