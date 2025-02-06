<?php 
require_once("mysql_connect.php");
require_once("includes/a_config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/nutrition.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<title><?php print $PAGE_TITLE ?> ></title>

<?php if ($CURRENT_PAGE == "Index") { ?>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
<?php } ?>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
	</style>
	</head>
<body>

<?php 
include("includes/design-top.php");
include("includes/navigation.php");
?>

		<div class="container" id="main-content">
			<h2>Contact Us</h2>
			<p>"Contact Us" content goes here.</p>
			<label for="ingredients" id="ingredients">Ingredient:</label>
			<select onchange="loadNutritionalPanel()" id="ingredient" name="ingredient">
			<option id="empty" value="empty">Select an Ingredient</option>
				
			<?php
				$ingredients = RecipesSQL::getIngredients();
				// print_r($ingredients);
				foreach ($ingredients as $key => $arr) {
					echo '<option id="' . $arr['ingredient_uid'] . '" value="' . $arr['ingredient_uid'] . '">' . $arr['name'] .'</option>';
				}
				print '</select>';
			?>


			<label for="quantity" id="quantity">Quantity:</label>
			<input type="number" name="quantity" />

			<label for="uoms" id="uoms">UOM:</label>
			<select name="uoms">';
			<?php
				$uoms = RecipesSQL::getUOMS();
				foreach ($uoms as $key => $arr) {
						echo '<option id="' . $arr['uom_uid'] . '" value="' . $arr['name'] . '">' . $arr['name'] .'</option>';
					}
			?>
			</select>


		</div>

		<section id="nutritional-panel" class="performance-facts">
		</section>

		<script type="text/javascript">
			function loadNutritionalPanel() {
				if ($('#ingredient').find(":selected").val() === 'empty') {
					$("#nutritional-panel").empty();
					return;
				}
				$.get("nutrition.php", ({ingredientUID : $('#ingredient').find(":selected").val()}), function(result) {
					$("#nutritional-panel").html(result);
				});
			}
		</script>

		<div class="footer"></div>
	</body>
</html>