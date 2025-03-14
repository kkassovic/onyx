
<?php
//PDO connect - EP
try {
  $servername = DB_HOST;
  $database = DB_NAME;
  $conn_pdo = new PDO("mysql:host=$servername;port=3306;charset=UTF8;dbname=$database", DB_USER, DB_PASSWORD);
  // set the PDO error mode to exception
  $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "PDO Connected successfully (connect.php)<br>";
  } catch(PDOException $e) {
  echo "PDO Connection failed (connect.php): " . $e->getMessage() . "<br>";
  }
?>


<?php
//test connection PDO - connect.php
include $_SERVER[ 'DOCUMENT_ROOT'] .  "/template/connect.php";

var_dump($conn_pdo);

//Recipients PDO
try {
    $stmt = $conn_pdo->prepare("SELECT email AS email, to_cc_bcc AS to_cc_bcc, trn As trn FROM email_dist WHERE trn = :trn");
    $mod = "LA_NOVA";
    $stmt->bindParam(':trn', $mod);
    $stmt->execute();
    $row_count = $stmt->rowCount();
    $table = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $row = $table[0];
    $figure = $table[0]['email'];

    echo "PDO success<br>";
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    }

$conn_pdo = null;
?>
