<?php

class RecipesSQL {

    private static $hostname = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname   = "recipe_nutrition";
    private static $dbh;

    private static function connect() {
        try {
            $dbh = new PDO('mysql:host=' . self::$hostname . ';dbname='. self::$dbname, self::$username, self::$password);
            return $dbh;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getUOMs() {

        try {
            $dbh = self::connect();
            $query = $dbh->prepare("SELECT * FROM uoms ORDER BY uom_uid");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $val) {
                $array[$val['uom_uid']] = $result[$key];
            }

            $dbh = null;
            return $array;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getIngredients($uid = null) {

        try {
            $dbh = self::connect();
            if ($uid) {
                $query = $dbh->prepare("SELECT * FROM ingredients WHERE ingredient_uid = " . $uid);
            } else {
                $query = $dbh->prepare("SELECT * FROM ingredients ORDER BY ingredient_uid");
            }
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $val) {
                $array[$val['ingredient_uid']] = $result[$key];
            }

            $dbh = null;
            return $array;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRecipes() {

        try {
            $dbh = self::connect();
            $query = $dbh->prepare("SELECT * FROM recipes ORDER BY irecipe_uid");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $val) {
                $array[$val['recipe_uid']] = $result[$key];
            }

            $dbh = null;
            return $array;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getIngredientNutrition($uid = null) {

        try {
            $dbh = self::connect();
            if ($uid) {
                $query = $dbh->prepare("SELECT * FROM ingredient_nutrition WHERE ingredient_uid = " . $uid);
            } else {
                $query = $dbh->prepare('SELECT * FROM ingredient_nutrition ORDER BY ingredient_uid');
            }
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $val) {
                $array[$val['ingredient_uid']] = $result[$key];
            }

            $dbh = null;
            return $array;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function addIngredient($ingredientArray) {

        $dbh = self::connect();
        try {
            $dbh->beginTransaction();
            $query = $dbh->prepare('INSERT INTO ingredients (
                name, default_uom_uid
            ) VALUES (
                "'. $ingredientArray['name'] .'", 
                '.$ingredientArray['default_uom_uid'].'
            ) ON DUPLICATE KEY UPDATE 
                name=name'
            );
            $query->execute();

            /**
             * PDO's lastInsertId() function unfortunately doesn't work
             * when a key is updated as opposed to inserted; we'll use 
             * a nested select here instead
             */
            $query = $dbh->prepare('INSERT INTO ingredient_nutrition (
                ingredient_uid, 
                uom_uid,
                total_servings,
                calories,
                calories_from_fat,
                fat,
                saturated_fat,
                trans_fat,
                cholesterol,
                sodium,
                carbohydrates,
                dietary_fiber,
                sugar,
                added_sugar,
                protein
            ) VALUES (
                (SELECT ingredient_uid FROM ingredients WHERE name="'.$ingredientArray['name'].'"),
	        	'. $ingredientArray['default_uom_uid'] .',
		        '. $ingredientArray['total_servings'] .',
		        '. $ingredientArray['calories'] .',
		        '. $ingredientArray['calories_from fat'] .',
	        	'. $ingredientArray['fat'] .',
		        '. $ingredientArray['saturated_fat'] .',
		        '. $ingredientArray['trans_fat'] .',
		        '. $ingredientArray['cholesterol'] .',
		        '. $ingredientArray['sodium'] .',
		        '. $ingredientArray['carbohydrates'] .',
		        '. $ingredientArray['dietary_fiber'] .',
		        '. $ingredientArray['sugar'] .',
		        '. $ingredientArray['added_sugar'] .',
		        '. $ingredientArray['protein'] .'
            ) ON DUPLICATE KEY UPDATE
                ingredient_uid=(SELECT ingredient_uid FROM ingredients WHERE name="'.$ingredientArray['name'].'"),
	        	uom_uid='. $ingredientArray['default_uom_uid'] .',
		        total_servings='. $ingredientArray['total_servings'] .',
		        calories='. $ingredientArray['calories'] .',
		        calories_from_fat='. $ingredientArray['calories_from fat'] .',
	        	fat='. $ingredientArray['fat'] .',
		        saturated_fat='. $ingredientArray['saturated_fat'] .',
		        trans_fat='. $ingredientArray['trans_fat'] .',
		        cholesterol='. $ingredientArray['cholesterol'] .',
		        sodium='. $ingredientArray['sodium'] .',
		        carbohydrates='. $ingredientArray['carbohydrates'] .',
		        dietary_fiber='. $ingredientArray['dietary_fiber'] .',
		        sugar='. $ingredientArray['sugar'] .',
		        added_sugar='. $ingredientArray['added_sugar'] .',
		        protein='. $ingredientArray['protein'] .'
            ');
            $query->execute();
            $dbh->commit();

            $dbh = null;
        } catch(PDOException $e) {
            $dbh->rollback();

            print "Error!: " . $e->getMessage() . "</br>";
        }
    }

    public static function deleteIngredient($uid) {

        $dbh = self::connect();
        try {
            $dbh->beginTransaction();
            /* TODO: Check first recipe_ingredients to ensure we're not deleting an ingredient that is being used */
            $query = $dbh->prepare('DELETE from ingredients where ingredient_uid = ' . $uid);
            $query->execute();
            $query = $dbh->prepare('DELETE from ingredient_nutrition where ingredient_uid = ' . $uid);
            $query->execute();
            $dbh->commit();
            $dbh = null;
        } catch(PDOException $e) {
            $dbh->rollback();

            print "Error!: " . $e->getMessage() . "</br>";
        }
    }












}

?>