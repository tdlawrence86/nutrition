<?php 
require_once("RecipesSQL.php");

$name 				= '';
$total_servings 	= '';
$calories 			= '';
$calories_from_fat 	= '';
$fat 				= '';
$saturated_fat 		= '';
$trans_fat 			= '';
$cholesterol 		= '';
$sodium 			= '';
$carbs 				= '';
$dietary_fiber 		= '';
$sugar 				= '';
$added_sugar 		= '';
$protein 			= '';

if(isset($_POST['post']['editIngredient']) && !empty($_POST['post']['editIngredient'])) {
	$uid = $_POST['post']['editIngredient'];
	$ingredient = RecipesSQL::getIngredients($uid);
	$nutrition = RecipesSQL::getIngredientNutrition($uid);

	$name 				= $ingredient[$uid]['name'];
	$total_servings 	= $nutrition[$uid]['total_servings'];
	$calories 			= $nutrition[$uid]['calories'];
	$calories_from_fat 	= $nutrition[$uid]['calories_from_fat'];
	$fat 				= $nutrition[$uid]['fat'];
	$saturated_fat 		= $nutrition[$uid]['saturated_fat'];
	$trans_fat 			= $nutrition[$uid]['trans_fat'];
	$cholesterol 		= $nutrition[$uid]['cholesterol'];
	$sodium 			= $nutrition[$uid]['sodium'];
	$carbohydrates		= $nutrition[$uid]['carbohydrates'];
	$dietary_fiber 		= $nutrition[$uid]['dietary_fiber'];
	$sugar 				= $nutrition[$uid]['sugar'];
	$added_sugar 		= $nutrition[$uid]['added_sugar'];
	$protein 			= $nutrition[$uid]['protein'];
}

?>

<!-- <h2>Instructions</h2>
<p>Instructions go here.</p> -->

<form id="ingredient_form" method="post">
	<label for="ingredient_name" id="ingredient_name">Ingredient:</label>
	<input id="ingredient_input" type="text" name="ingredient_name" value="<?php echo $name; ?>"/>
	<br/>

	<label for="total_servings_value" id="total_servings_value">Total Servings:</label>
	<input id="total_servings-input" type="number" name="total_servings_value" value="<?php echo $total_servings; ?>"/>
	<br/>

	<label for="uom_uid" id="uom_uid">Default UOM / Serving Size:</label>
	<select id="uom_uid_input" name="uom_uid">';
	<option id="default" value="">Select UOM</option>
	<?php
	$uoms = RecipesSQL::getUOMS();
	foreach ($uoms as $key => $arr) {
		$selected = '';
		if ($arr['uom_uid'] === $nutrition[$_POST['post']['editIngredient']]['uom_uid']) {
			$selected = 'selected';
		}
		echo '<option id="' . $arr['uom_uid'] . '" ' . $selected . ' value="' . $arr['uom_uid'] . '">' . $arr['name'] .'</option>';
	}
	?>
	</select>
	<br/>

	<label for="calorie_value" id="calorie_value">Calories per Serving:</label>
	<input id="calories-input" type="number" name="calorie_value" value="<?php echo $calories; ?>"/>
	<br/>

	<label for="calories_from_fat_value" id="calories_from_fat_value">Calories from Fat:</label>
	<input id="calories_from_fat-input" type="number" name="calories_from_fat_value" value="<?php echo $calories_from_fat; ?>"/>
	<br/>

	<label for="fat_value" id="fat_value">Fat:</label>
	<input id="fat-input" type="number" name="fat_value" step=".1" value="<?php echo $fat; ?>"/>
	<br/>

	<label for="saturated_fat_value" id="saturated_fat_value">Saturated Fat:</label>
	<input id="saturated_fat-input" type="number" name="saturated_fat_value" step=".1" value="<?php echo $saturated_fat; ?>"/>
	<br/>

	<label for="trans_fat_value" id="trans_fat_value">Trans Fat:</label>
	<input id="trans_fat-input" type="number" name="trans_fat_value" step=".1" value="<?php echo $trans_fat; ?>"/>
	<br/>

	<label for="cholesterol_value" id="cholesterol_value">Cholesterol:</label>
	<input id="cholesterol-input" type="number" name="cholesterol_value" value="<?php echo $cholesterol; ?>"/>
	<br/>

	<label for="sodium_value" id="sodium_value">Sodium (in mg):</label>
	<input id="sodium-input" type="number" name="sodium_value" value="<?php echo $sodium; ?>"/>
	<br/>

	<label for="carbs_value" id="carbs_value">Carbohydrates:</label>
	<input id="carbs-input" type="number" name="carbs_value" value="<?php echo $carbohydrates; ?>"/>
	<br/>

	<label for="dietary_fiber_value" id="dietary_fiber_value">Dietary Fiber:</label>
	<input id="dietary_fiber-input" type="number" name="dietary_fiber_value" step=".1" value="<?php echo $dietary_fiber; ?>"/>
	<br/>

	<label for="total_sugar_value" id="total_sugar_value">Total Sugar (in grams):</label>
	<input id="total_sugar-input" type="number" name="total_sugar_value" value="<?php echo $sugar; ?>"/>
	<br/>

	<label for="added_sugar_value" id="added_sugar_value">Added Sugar (in grams):</label>
	<input id="added_sugar-input" type="number" name="added_sugar_value" value="<?php echo $added_sugar; ?>"/>
	<br/>

	<label for="protein_value" id="protein-_value">Protein (in grams):</label>
	<input id="protein-input" type="number" name="protein_value" step=".1" value="<?php echo $protein; ?>"/>
	<br/>
	<input type="submit" value="Submit">

</form>

<script type="text/javascript">
	$('#ingredient_form').submit(function(e) {
		if (!$('#ingredient_input').val()) {
			e.preventDefault();
			alert("Ingredient is required.");
			return;
		}
		if (!$('#uom_uid_input').val()) {
			e.preventDefault();
			alert("Unit of measue (UOM) is required.");
		}
		if (!$('#ingredient_input').val()) {
			e.preventDefault();
			alert("Ingredient is required.");
		}
	});
	
	// TODO: Can I preload the inputs more cleanly with jQuery when editing 
	// an existing item rather than using PHP vars
	// $(document).ready(function() {
	// $("#calories-input").val();
	// });

</script>

