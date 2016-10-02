<?php
include '../common.php';
header('Content-Type: text/html; charset=utf-8');
?>
<a href="../index.php">&lt; Back</a>

<h2>Transpose</h2>
<form>
	<textarea name="raw"  cols="30" rows="10"><?php echo @$_GET["raw"]; ?></textarea><br />
  
	<input type="submit" value="Solve">
</form>
<?php

if(!isset($_GET["raw"])){
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
	$transpose = Operations::transpose($Matrix);
	$transpose_compose = new Compose($transpose);
	echo $transpose_compose->display();
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}