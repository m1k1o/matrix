<?php
include '../common.php';
header('Content-Type: text/html; charset=utf-8');
?>
<a href="../index.php">&lt; Back</a>

<h2>Const Multiplication</h2>
<form>
	<textarea name="raw"  cols="30" rows="10"><?php echo @$_GET["raw"]; ?></textarea><br />
	Const: <input type="text" name="const" value="<?php echo @$_GET["const"]; ?>"><br />
	<input type="submit" value="Solve">
</form>
<?php

if(!isset($_GET["raw"]) || !isset($_GET["const"])){
	die("no input");
}

$input = Parse::plain_text($_GET["raw"]);

try {
	$Matrix = new Matrix($input);
	$Compose = new Compose($Matrix);

	echo '<h2>Input</h2>';
	echo $Compose->display();
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

try {
	echo '<h2>Output</h2>';
	$const_multiplication = Operations::const_multiplication($Matrix, floatval($_GET["const"]));
	$const_multiplication_compose = new Compose($const_multiplication);
	echo $const_multiplication_compose->display();
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}