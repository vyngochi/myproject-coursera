<?php
if ( isset($_POST['who']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        echo '<p style="color: red">User name and password are required</p>';
    } else if ($_POST['pass'] !== 'php123') {
        echo '<p style="color: red">Incorrect password</p>';
    } else {
        header("Location: autos.php?name=" . urlencode($_POST['who']));
        return;
    }
}
?>

<?php
// Note - cannot have any output before setcookie
if ( ! isset($_COOKIE['zap']) ) {
    setcookie('zap', '42', time()+3600);
}
?>
<pre>
<?php print_r($_COOKIE); ?>
</pre>
<p><a href="cookie.php">Click Me!</a> or press Refresh</p>

<html>
<head>
    <title>Vy Ngo Chi (dc8d48be)</title>
</head>
<body>
    <h1>Please Log In</h1>
    <form method="post">
        <p>User Name: <input type="text" name="who"></p>
        <p>Password: <input type="password" name="pass"></p>
        <p><input type="submit" value="Log In" /></p>
    </form>
</body>
</html>
