<?
$filename = 'empl.json';
$data = file_get_contents($filename);
$array = json_decode($data, true);

$conn = null;
$query = '';
$table_data = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=cp37466_db;cahrset=utf8", 'cp37466_db', 'cp37466');

    foreach($array as $row) {
        $name = $row['name'];
        $phone = $row['phone'];
        $post = $row['post'];
        $query .= "INSERT INTO empl (NAME, PHONE, POST) VALUES ('$name', '$phone', '$post')";
        $affectedRowsNumber = $conn->exec($query);
    }

    $query = "SELECT * FROM empl";
    $result = $conn->query($query);
    while($row = $result->fetch()){
        $name = $row['NAME'];
        $phone = $row['PHONE'];
        $post = $row['POST'];
        $table_data .= '
            <tr>
                <td>'.$name.'</td>
                <td>'.$phone.'</td>
                <td>'.$post.'</td>
            </tr>
        ';
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

echo '<h3>Содержимое таблицы empl</h3><br />';
echo '<table border="1">
<tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Post</th>
</tr>';
echo $table_data;
echo '</table>';