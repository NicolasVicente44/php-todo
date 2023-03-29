<?php

    class TodoModel {

        private static $_table = "todos";

        public static function findAll ($user_id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT {$table}.id, item, completed_datetime, status_id, statuses.name as status FROM {$table}
                JOIN statuses ON {$table}.status_id = statuses.id
            WHERE {$table}.user_id = {$user_id}";

            $todos = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $todos;
        }

        public static function find ($id, $user_id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT {$table}.id, item, completed_datetime, status_id, statuses.name as status FROM {$table}
                JOIN statuses ON {$table}.status_id = statuses.id
            WHERE {$table}.id = :id AND {$table}.user_id = {$user_id}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $todo = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $todo;
        }

        public static function create ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                item,
                completed_datetime,
                status_id,
                user_id
            ) VALUES (
                :item,
                :completed_datetime,
                :status_id,
                :user_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":item", $package["item"], PDO::PARAM_STR);
            $stmt->bindParam(":completed_datetime", $package["completed_datetime"], PDO::PARAM_STR);
            $stmt->bindParam(":status_id", $package["status_id"], PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $package["user_id"], PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

        public static function update ($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                item = :item,
                completed_datetime = :completed_datetime,
                status_id = :status_id
            WHERE id = :id AND user_id = :user_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":item", $package['item'], PDO::PARAM_STR);
            $stmt->bindParam(":completed_datetime", $package['completed_datetime'], PDO::PARAM_STR);
            $stmt->bindParam(":status_id", $package["status_id"], PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $package["user_id"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $package['id'], PDO::PARAM_INT);
            
            $stmt->execute();
            $conn = null;
        }

        public static function delete ($id, $user_id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "DELETE FROM {$table} WHERE id = :id AND user_id = :user_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

    }

?>