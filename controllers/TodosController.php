<?php

    require_once("./models/TodoModel.php");
    require_once("./models/StatusModel.php");

    function index () {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $todos = TodoModel::findAll($_SESSION['user']['id']);

        render("todos/index", [
            "todos" => $todos,
            "title" => "Todos"
        ]);
    }

    function _new () {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $statuses = StatusModel::findAll($_SESSION['user']['id']);

        render("todos/new", [
            "title" => "New Todo",
            "action" => "create",
            "statuses" => $statuses
        ]);
    }

    function edit ($request) {
        if (!isset($request["params"]["id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $todo = TodoModel::find($request["params"]["id"], $_SESSION['user']['id']);
        if (!$todo) {
            return redirect("", ["errors" => "Todo does not exist"]);
        }

        $statuses = StatusModel::findAll($_SESSION['user']['id']);

        render("todos/edit", [
            "title" => "Edit Todo",
            "todo" => $todo,
            "edit_mode" => true,
            "action" => "update",
            "statuses" => $statuses
        ]);
    }

    function create () {
        // Validate field requirements
        validate($_POST, "todos/new");

        
        // Write to database if good
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_POST['user_id'] = $_SESSION['user']['id'];;
        TodoModel::create($_POST);

        redirect("todos", ["success" => "Todo was created successfully"]);
    }

    function update () {
        // Missing ID
        if (!isset($_POST['id'])) {
            return redirect("todos", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "todos/edit/{$_POST['id']}");

        // Write to database if good
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_POST['user_id'] = $_SESSION['user']['id'];
        TodoModel::update($_POST);
        redirect("todos", ["success" => "Todo was updated successfully"]);
    }

    function delete ($request) {
        // Missing ID
        if (!isset($request["params"]["id"])) {
            return redirect("todos", ["errors" => "Missing required ID parameter"]);
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        TodoModel::delete($request["params"]["id"], $_SESSION['user']['id']);

        redirect("todos", ["success" => "Todo was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["item", "completed_datetime"];
        $errors = [];

        // No empty fields
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
        }

        // Completed date must be in the future
        if (strtotime($package["completed_datetime"]) < strtotime("now")) {
            $errors[]= "Completed Date must be in the future";
        }

        if (count($errors)) {
            return redirect($error_redirect_path, ["form_fields" => $package, "errors" => $errors]);
        }
    }

?>