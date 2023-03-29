<?php

    require_once("./models/StatusModel.php");

    function index () {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $statuses = StatusModel::findAll($_SESSION['user']['id']);

        render("statuses/index", [
            "statuses" => $statuses,
            "title" => "statuses"
        ]);
    }

    function _new () {
        render("statuses/new", [
            "title" => "New Status",
            "action" => "create"
        ]);
    }

    function edit ($request) {
        if (!isset($request["params"]["id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $status = StatusModel::find($request["params"]["id"], $_SESSION['user']['id']);
        if (!$status) {
            return redirect("", ["errors" => "Status does not exist"]);
        }

        render("statuses/edit", [
            "title" => "Edit Status",
            "status" => $status,
            "edit_mode" => true,
            "action" => "update"
        ]);
    }

    function create () {
        // Validate field requirements
        validate($_POST, "statuses/new");
        
        // Write to database if good
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_POST['user_id'] = $_SESSION['user']['id'];
        StatusModel::create($_POST);

        redirect("statuses", ["success" => "Status was created successfully"]);
    }

    function update () {
        // Missing ID
        if (!isset($_POST['id'])) {
            return redirect("statuses", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_POST['user_id'] = $_SESSION['user']['id'];
        validate($_POST, "statuses/edit/{$_POST['id']}");

        // Write to database if good
        StatusModel::update($_POST);
        redirect("statuses", ["success" => "Status was updated successfully"]);
    }

    function delete ($request) {
        // Missing ID
        if (!isset($request["params"]["id"])) {
            return redirect("statuses", ["errors" => "Missing required ID parameter"]);
        }

        StatusModel::delete($request["params"]["id"]);

        redirect("statuses", ["success" => "Status was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["name"];
        $errors = [];

        // No empty fields
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
        }

        if (count($errors)) {
            return redirect($error_redirect_path, ["form_fields" => $package, "errors" => $errors]);
        }
    }

?>