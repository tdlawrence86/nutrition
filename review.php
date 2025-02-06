<?php 
require_once("RecipesSQL.php");
?>

<!-- <h2>Contact Us</h2>
<p>"Contact Us" content goes here.</p> -->

<select onchange="loadNutritionalPanel()" id="ingredient" name="ingredient">
	<option id="empty" value="empty">Select an Ingredient</option>

	<?php
	$ingredients = RecipesSQL::getIngredients();
	foreach ($ingredients as $key => $arr) {
		echo '<option id="' . $arr['name'] . '" value="' . $arr['ingredient_uid'] . '">' . $arr['name'] .'</option>';
	}
	?>

</select>
<br>


<form id="edit" method="post">
	<input type="hidden" id="editIngredient" name="editIngredient" value=""></input>
	<input id="edit_button" type="submit" value="Edit" method="post" onclick="editIngredients(event)"></input>
</form>

<form id="delete" method="post">
	<input type="hidden" id="deleteIngredient" name="deleteIngredient" value=""></input>
	<input id="delete_button" type="submit" value="Delete" method="post" onclick="confirmDelete(event)"></input>
</form>

<div>
	<section id="nutritional-panel" class="performance-facts">
	</section>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#edit_button").hide();
		$("#delete_button").hide();
	});

	$("#ingredient").change(function() {
		if ($(this).val() === 'empty') {
			$("#edit_button").hide();
			$("#delete_button").hide();
		} else {
			$("#edit_button").show();
			$("#delete_button").show();
		}
	});

	function loadNutritionalPanel() {
		if ($('#ingredient').find(":selected").val() === 'empty') {
			$("#nutritional-panel").empty();
			return;
		}
		$.get("nutrition.php", ({ingredientUID : $('#ingredient').find(":selected").val()}), function(result) {
			$("#nutritional-panel").html(result);
		});
	}

	function confirmDelete(e) {
		if(!confirm('Are you sure?')) {
			e.preventDefault();
		}
		$('#deleteIngredient').val($('#ingredient').find(":selected").val());
	}
	
	function editIngredients(e) {
		$('#editIngredient').val($('#ingredient').find(":selected").val());
	}

</script>

