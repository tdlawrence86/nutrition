
<?php 
require_once("RecipesSQL.php");
// print_r($_POST);

if (isset($_POST['editIngredient'])) {
	$_COOKIE['editIngredient'] = $_POST['editIngredient'];
} else if (isset($_POST['deleteIngredient'])) {
	RecipesSQL::deleteIngredient($_POST['deleteIngredient']);
} else if ($_POST) {
	RecipesSQL::addIngredient(array(
		'name' 				=> $_POST['ingredient_name'], 
		'default_uom_uid' 	=> $_POST['uom_uid'],
		'total_servings' 	=> empty($_POST['total_servings_value']) ? 0 : $_POST['total_servings_value'],
		'calories' 			=> empty($_POST['calorie_value']) ? 0 : $_POST['calorie_value'],
		'calories_from fat' => empty($_POST['calories_from_fat_value']) ? 0 : $_POST['calories_from_fat_value'],
		'fat' 				=> empty($_POST['fat_value']) ? 0 : $_POST['fat_value'],
		'saturated_fat' 	=> empty($_POST['saturated_fat_value']) ? 0 : $_POST['saturated_fat_value'],
		'trans_fat' 		=> empty($_POST['trans_fat_value']) ? 0 : $_POST['trans_fat_value'],
		'cholesterol' 		=> empty($_POST['cholesterol_value']) ? 0 : $_POST['cholesterol_value'],
		'sodium' 			=> empty($_POST['sodium_value']) ? 0 : $_POST['sodium_value'],
		'carbohydrates' 	=> empty($_POST['carbs_value']) ? 0 : $_POST['carbs_value'],
		'dietary_fiber' 	=> empty($_POST['dietary_fiber_value']) ? 0 : $_POST['dietary_fiber_value'],
		'sugar' 			=> empty($_POST['total_sugar_value']) ? 0 : $_POST['total_sugar_value'],
		'added_sugar' 		=> empty($_POST['added_sugar_value']) ? 0 : $_POST['added_sugar_value'],
		'protein' 			=> empty($_POST['protein_value']) ? 0 : $_POST['protein_value']
	));
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/nutrition.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<title>Nutrition Planner</title>
	</head>
	<body>
		<div class="jumbotron">
			<h1>Welcome!</h1>
		</div>

		<div class="container">
			<ul class="nav nav-pills">
				<li class="nav-item" onclick="loadIngredientInput()">
					<a id="tab-ingredient-input" class="nav-link" href="javascript:;">Add Ingredients</a>
				</li>
				<li class="nav-item" onclick="loadRecipeInput()">
					<a id="tab-recipe-input" class="nav-link" href="javascript:;">Build a Recipe</a>
				</li>
				<li class="nav-item" onclick="loadReviewPanel()">
					<a id="tab-review" class="nav-link" href="javascript:;">Review</a>
				</li>
			</ul>
		</div>

		<div class="container" id="main-content">
		</div>

		<script type="text/javascript">
			function loadIngredientInput() {
				<?php 
					$JS_POST = json_encode($_POST); 
					echo "var JS_POST = ". $JS_POST . ";\n";
				?>
				clearActive();
				$("#main-content").empty();
				$("#tab-ingredient-input").addClass('active');
				$.post("ingredient_input.php", ({'post' : JS_POST}), function(result) {
					$("#main-content").html(result);
				});
			}

			function loadRecipeInput() {
				clearActive();
				$("#main-content").empty();
				$("#tab-recipe-input").addClass('active');
				$.get("recipe_input.php", ({}), function(result) {
					$("#main-content").html(result);
				});
			}
			
			function loadReviewPanel() {
				clearActive();
				$("#main-content").empty();
				$("#tab-review").addClass('active');
				$.get("review.php", ({}), function(result) {
					$("#main-content").html(result);
				});
			}
			
			function clearActive() {
				$(".nav-link").removeClass("active");
			}

			loadIngredientInput();
		</script>

		<div class="footer"></div>
	</body>
</html>