<?php
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/ingredient_input.php":
			$CURRENT_PAGE = "Ingredients"; 
			$PAGE_TITLE = "Add New Ingredients";
			break;
		case "/review.php":
			$CURRENT_PAGE = "Review"; 
			$PAGE_TITLE = "Review";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Tim's Recipe Builder!";
	}
?>