<?php
include '../common.php';
header('Content-Type: text/html; charset=utf-8');

$operations = [
	"addition" => "Addition",
	"subtraction" => "Subtraction",
	"multiplication" => "Multiplication"
];

$operations_html = '';
foreach($operations as $key => $value){
	$operations_html .= '<option value="'.$key.'"'.(@$_GET["operation"] == $key ? ' selected' : '').'>'.$value.'</option>';
}

if(isset($_GET["switch"]) && $_GET["switch"]){
	$a = $_GET["raw1"];
	$_GET["raw1"] = $_GET["raw2"];
	$_GET["raw2"] = $a;
}
?>
<a href="../index.php">&lt; Back</a>

<h2>Operations</h2>
<form>
	<h2>Matrix 1</h2>
	<textarea name="raw1"  cols="30" rows="10"><?php echo @$_GET["raw1"]; ?></textarea><br />

	<input type="submit" name="switch" value="Switch">
	
	<h2>Matrix 2</h2>
	<textarea name="raw2"  cols="30" rows="10"><?php echo @$_GET["raw2"]; ?></textarea>

	<h2>Operation</h2>
	<select name="operation">
		<option value="">Vyberte si:</option>
		<?php echo $operations_html; ?>
	</select>

	<input type="submit" value="Solve">
</form>
<?php

if(!isset($_GET["raw1"]) || !isset($_GET["raw2"]) || !isset($_GET["operation"])){
	die("no input");
}

$operation = $_GET["operation"];
if(!in_array($operation, array_keys($operations))){
	die("operation is not supported");
}

$input = [
	Parse::plain_text($_GET["raw1"]),
	Parse::plain_text($_GET["raw2"])
];

try {
	$Matrix = [
		new Matrix($input[0]),
		new Matrix($input[1])
	];

	$Compose = [
		new Compose($Matrix[0]),
		new Compose($Matrix[1])
	];

	echo '<h2>Input: Matrix 1</h2>';
	echo $Compose[0]->display();
	echo '<h2>Input: Matrix 2</h2>';
	echo $Compose[1]->display();
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

try {
	echo '<h2>'.$operations[$operation].'</h2>';
	$addition = Operations::$operation($Matrix[0], $Matrix[1]);
	$addition_compose = new Compose($addition);
	echo $addition_compose->display();
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}