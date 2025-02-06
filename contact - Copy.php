<?php 
require_once("mysql_connect.php");
require_once("includes/a_config.php");

print '
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<title>' . $PAGE_TITLE . '></title>';

if ($CURRENT_PAGE == "Index") {
	print '<meta name="description" content="" />';
	print '<meta name="keywords" content="" /> ';
}

print '
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>
	#main-content {
		margin-top:20px;
	}
	.footer {
		font-size: 14px;
		text-align: center;
	}














	.performance-facts {
  border: 1px solid black;
  margin: 20px;
  float: left;
  width: 350px;
  padding: 0.5rem;
  table {
    border-collapse: collapse;
  }
}
.performance-facts__title {
  font-weight: bold;
  font-size: 2rem;
  margin: 0 0 0.25rem 0;
}
.performance-facts__header {
  border-bottom: 10px solid black;
  padding: 0 0 0.25rem 0;
  margin: 0 0 0.5rem 0;
  p {
    margin: 0;
  }
}
.performance-facts__table {
  width: 100%;
  thead tr {
    th,
    td {
      border: 0;
    }
  }
  th,
  td {
    font-weight: normal;
    text-align: left;
    padding: 0.25rem 0;
    border-top: 1px solid black;
    white-space: nowrap;
  }
  td {
    &:last-child {
      text-align: right;
    }
  }
  .blank-cell {
    width: 1rem;
    border-top: 0;
  }
  .thick-row {
    th,
    td {
      border-top-width: 5px;
    }
  }
}
.small-info {
  font-size: 0.7rem;
}

.performance-facts__table--small {
  @extend .performance-facts__table;
  border-bottom: 1px solid #999;
  margin: 0 0 0.5rem 0;
  thead {
    tr {
      border-bottom: 1px solid black;
    }
  }
  td {
    &:last-child {
      text-align: left;
    }
  }
  th,
  td {
    border: 0;
    padding: 0;
  }
}

.performance-facts__table--grid {
  @extend .performance-facts__table;
  margin: 0 0 0.5rem 0;
  td {
    &:last-child {
      text-align: left;
      &::before {
        content: "•";
        font-weight: bold;
        margin: 0 0.25rem 0 0;
      }
    }
  }
}

.text-center {
  text-align: center;
}
.thick-end {
  border-bottom: 10px solid black;
}
.thin-end {
  border-bottom: 1px solid black;
}












	</style>
	</head>
<body>';

include("includes/design-top.php");
include("includes/navigation.php");

$selected = '';

print '
<div class="container" id="main-content">
	<h2>Contact Us</h2>
	<p>"Contact Us" content goes here.</p>';

print '
	<label for="ingredients" id="ingredients">Ingredient:</label>
	<select id="uoms" name="uoms">';
		
		$uoms = RecipesSQL::getIngredients();
		foreach ($uoms as $key => $arr) {
			if ($arr['ingredient_uid'] === 2) {
				$selected = 'selected';
			}
			echo '<option onchange="loadNutritionalPanel()" id="' . $arr['ingredient_uid'] . '" value="' . $arr['name'] . '">' . $arr['name'] .'</option>';
		}
print '</select>';

// print '
// 	<label for="quantity" id="quantity">Quantity:</label>
// 	<input type="number" name="quantity" />';

// print '
// 	<label for="uoms" id="uoms">UOM:</label>
// 	<select name="uoms">';
		
// 		$uoms = RecipesSQL::getUOMS();
// 		foreach ($uoms as $key => $arr) {
// 			echo '<option id="' . $arr['uom_uid'] . '" value="' . $arr['name'] . '">' . $arr['name'] .'</option>';
// 		}
// print '</select>';




print '</div>';

$ingredientNutrition = RecipesSQL::getIngredientNutrition();
// print_r($ingredientNutrition[0]);


print '
<section id="nutritional-panel" class="performance-facts">
</section>
';
























print '
<script type="text/javascript">
var yourSelect = document.getElementById( "uoms" );
alert( yourSelect.options[ yourSelect.selectedIndex ].value )



var loadNutritionalPanel = function() {
$("#nutritional-panel").html(\'<header class="performance-facts__header"><h1 class="performance-facts__title">Nutrition Facts</h1>
    <p>Serving Size 1/2 cup 
      <p>Serving Per Container 8</p>
  </header>
  <table class="performance-facts__table">
    <thead>
      <tr>
        <th colspan="3" class="small-info">
          Amount Per Serving
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th colspan="2">
          <b>Calories</b>
          200
        </th>
        <td>
          Calories from Fat
          130
        </td>
      </tr>
      <tr class="thick-row">
        <td colspan="3" class="small-info">
          <b>% Daily Value*</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Total Fat</b>
          14g
        </th>
        <td>
          <b>22%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Saturated Fat
          9g
        </th>
        <td>
          <b>22%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Trans Fat
          0g
        </th>
        <td>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Cholesterol</b>
          55mg
        </th>
        <td>
          <b>18%</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Sodium</b>
          40mg
        </th>
        <td>
          <b>2%</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Total Carbohydrate</b>
          17g
        </th>
        <td>
          <b>6%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Dietary Fiber
          1g
        </th>
        <td>
          <b>4%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Sugars
          14g
        </th>
        <td>
        </td>
      </tr>
      <tr class="thick-end">
        <th colspan="2">
          <b>Protein</b>
          3g
        </th>
        <td>
        </td>
      </tr>
    </tbody>
  </table>

  <table class="performance-facts__table--grid">
    <tbody>
      <tr>
        <td colspan="2">
          Vitamin A
          10%
        </td>
        <td>
          Vitamin C
          0%
        </td>
      </tr>
      <tr class="thin-end">
        <td colspan="2">
          Calcium
          10%
        </td>
        <td>
          Iron
          6%
        </td>
      </tr>
    </tbody>
  </table>

  <p class="small-info">* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs:</p>

  <table class="performance-facts__table--small small-info">
    <thead>
      <tr>
        <td colspan="2"></td>
        <th>Calories:</th>
        <th>2,000</th>
        <th>2,500</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th colspan="2">Total Fat</th>
        <td>Less than</td>
        <td>65g</td>
        <td>80g</td>
      </tr>
      <tr>
        <td class="blank-cell"></td>
        <th>Saturated Fat</th>
        <td>Less than</td>
        <td>20g</td>
        <td>25g</td>
      </tr>
      <tr>
        <th colspan="2">Cholesterol</th>
        <td>Less than</td>
        <td>300mg</td>
        <td>300 mg</td>
      </tr>
      <tr>
        <th colspan="2">Sodium</th>
        <td>Less than</td>
        <td>2,400mg</td>
        <td>2,400mg</td>
      </tr>
      <tr>
        <th colspan="3">Total Carbohydrate</th>
        <td>300g</td>
        <td>375g</td>
      </tr>
      <tr>
        <td class="blank-cell"></td>
        <th colspan="2">Dietary Fiber</th>
        <td>25g</td>
        <td>30g</td>
      </tr>
    </tbody>
  </table>

  <p class="small-info">
    Calories per gram:
  </p>
  <p class="small-info text-center">
    Fat 9
    &bull;
    Carbohydrate 4
    &bull;
    Protein 4
  </p>

  \');

</script>
<!--<script type="text/javascript">$("#uoms").append("SDFSDF");</script>-->
<div class="footer">&copy;'. date("Y") . '</div>
</body>
</html>';