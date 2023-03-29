<?php

    class StatusModel {

        private static $_table = "statuses";

        public static function findAll ($user_id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table} WHERE user_id = {$user_id}";

            $statuses = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $statuses;
        }

        public static function find ($id, $user_id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table} WHERE id = :id AND user_id = :user_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $status = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $status;
        }

        public static function create ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                name,
                user_id
            ) VALUES (
                :name,
                :user_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $package["name"], PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $package['user_id'], PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

        public static function update ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                name = :name,
            WHERE id = :id AND user_id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $package['name'], PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $package['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(":id", $package['id'], PDO::PARAM_INT);
            
            $stmt->execute();
            $conn = null;
        }

        public static function delete ($id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "DELETE FROM {$table} WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

    }

?>