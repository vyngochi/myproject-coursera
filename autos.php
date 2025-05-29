<?php
require_once "pdo.php";

if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die('Name parameter missing');
}

if (isset($_POST['logout'])) {
    header("Location: index.php");
    return;
}

$failure = false;
$success = false;

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (strlen($_POST['make']) < 1) {
        $failure = "Make is required";
    } elseif (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $failure = "Mileage and year must be numeric";
    } else {
        $stmt = $pdo->prepare('INSERT INTO autos (make, mileage, year) VALUES (:mk, :mi, :yr)');
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':mi' => $_POST['mileage'],
            ':yr' => $_POST['year']
        ));
        $success = "Record inserted";
    }
}
?>

<html>
<head>
    <title>Vy Ngo Chi (dc8d48be)</title>
</head>
<body>
<h1>Tracking Autos for <?= htmlentities($_GET['name']) ?></h1>

<?php
if ($failure !== false) {
    echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
}
if ($success !== false) {
    echo('<p style="color: green;">' . htmlentities($success) . "</p>\n");
}
?>

<form method="post">
    <p>Make: <input type="text" name="make"></p>
    <p>Year: <input type="text" name="year"></p>
    <p>Mileage: <input type="text" name="mileage"></p>
    <p>
        <input type="submit" value="Add">
        <input type="submit" name="logout" value="Logout">
    </p>
</form>

<h2>Automobiles</h2>
<ul>
<?php
$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<li>" . htmlentities($row['make']) . " " .
         htmlentities($row['year']) . " / " .
         htmlentities($row['mileage']) . "</li>\n";
}
?>
</ul>
</body>
</html>
