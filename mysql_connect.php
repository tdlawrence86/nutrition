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

    public static function getRecipes() {

        try {
            $dbh = self::connect();
            $query = $dbh->prepare("SELECT * FROM recipes ORDER BY recipe_uid");
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

    public static function getIngredients() {

        try {
            $dbh = self::connect();
            $query = $dbh->prepare("SELECT * FROM ingredients ORDER BY ingredient_uid");
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

    public static function getIngredientNutrition() {

        try {
            $dbh = self::connect();
            $query = $dbh->prepare("SELECT * FROM ingredient_nutrition ORDER BY ingredient_uid");
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

}

?>