<?php
require_once("mysql_connect.php");

$uoms = RecipesSQL::getUOMS();
$ingredients = RecipesSQL::getIngredients();
$ingredientNutrition = RecipesSQL::getIngredientNutrition();
$uid = $_REQUEST['ingredientUID'];

print '<header class="performance-facts__header"><h1 class="performance-facts__title">Nutrition Facts</h1>
    <p>Serving Size '.$uoms[$ingredientNutrition[$uid]['uom_uid']]['name'].' 
      <p>Serving Per Container '.$ingredientNutrition[$uid]['total_servings'].'</p>
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
          '.$ingredientNutrition[$uid]['calories'].'
        </th>
        <td>
          Calories from Fat
          '.$ingredientNutrition[$uid]['total_servings'].'
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
          '.$ingredientNutrition[$uid]['fat'].'g
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
          '.$ingredientNutrition[$uid]['saturated_fat'].'g
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
          '.$ingredientNutrition[$uid]['trans_fat'].'g
        </th>
        <td>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Cholesterol</b>
          '.$ingredientNutrition[$uid]['cholesterol'].'mg
        </th>
        <td>
          <b>18%</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Sodium</b>
          '.$ingredientNutrition[$uid]['sodium'].'mg
        </th>
        <td>
          <b>2%</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Total Carbohydrate</b>
          '.$ingredientNutrition[$uid]['carbohydrates'].'g
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
          '.$ingredientNutrition[$uid]['dietary_fiber'].'g
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
          '.$ingredientNutrition[$uid]['sugar'].'g
        </th>
        <td>
        </td>
      </tr>
      <tr class="thick-end">
        <th colspan="2">
          <b>Protein</b>
          '.$ingredientNutrition[$uid]['protein'].'g
        </th>
        <td>
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
  </p>';
