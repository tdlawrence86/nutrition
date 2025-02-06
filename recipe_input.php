<?php 
require_once("RecipesSQL.php");
?>

<!-- <h2>Instructions</h2>
<p>Instructions go here.</p> -->
<label for="ingredients" id="ingredients">Ingredient:</label>
<select onchange="loadNutritionalPanel()" id="ingredient" name="ingredient">
	<option id="empty" value="empty">Select an Ingredient</option>

	<?php
	$ingredients = RecipesSQL::getIngredients();
	foreach ($ingredients as $key => $arr) {
		echo '<option id="' . $arr['name'] . '" value="' . $arr['ingredient_uid'] . '">' . $arr['name'] .'</option>';
	}
	?>
</select>
<br/>

<label for="uoms" id="uoms">UOM:</label>
<select name="uoms">';
<?php
$uoms = RecipesSQL::getUOMS();
foreach ($uoms as $key => $arr) {
	echo '<option id="' . $arr['uom_uid'] . '" value="' . $arr['name'] . '">' . $arr['name'] .'</option>';
}
?>
</select>
<br/>

<label for="quantity-text" id="quantity-text">UOM Quantity:</label>
<input type="number" name="quantity-text" />
<br/>

<div>
	<section id="nutritional-panel" class="performance-facts">
	</section>
</div>

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
