<?php

    /**
     * Routes are responsible for matching a requested path
     * with a controller and an action. The controller represents
     * a collection of functions you want associated, usually, with
     * a resource. The action is the specific function you want to call.
     */

    $routes = [
        "get" => [
            [
                "pattern" => "/",
                "controller" => "PagesController",
                "action" => "index"
            ],
            [
                "pattern" => "/todos",
                "controller" => "TodosController",
                "action" => "index"
            ],
            [
                "pattern" => "/todos/new",
                "controller" => "TodosController",
                "action" => "_new"
            ],
            [
                "pattern" => "/todos/:id",
                "controller" => "TodosController",
                "action" => "show"
            ],
            [
                "pattern" => "/todos/edit/:id",
                "controller" => "TodosController",
                "action" => "edit"
            ],
            [
                "pattern" => "/todos/delete/:id",
                "controller" => "TodosController",
                "action" => "delete"
            ],
            [
                "pattern" => "/statuses",
                "controller" => "StatusesController",
                "action" => "index"
            ],
            [
                "pattern" => "/statuses/new",
                "controller" => "StatusesController",
                "action" => "_new"
            ],
            [
                "pattern" => "/statuses/edit/:id",
                "controller" => "StatusesController",
                "action" => "edit"
            ],
            [
                "pattern" => "/statuses/delete/:id",
                "controller" => "StatusesController",
                "action" => "delete"
            ],
            [
                "pattern" => "/users/new",
                "controller" => "UsersController",
                "action" => "_new"
            ],
            [
                "pattern" => "/login",
                "controller" => "UsersController",
                "action" => "login"
            ],
            [
                "pattern" => "/logout",
                "controller" => "UsersController",
                "action" => "logout"
            ],
        ],
        "post" => [
            [
                "pattern" => "/todos/create",
                "controller" => "TodosController",
                "action" => "create"
            ],
            [
                "pattern" => "/todos/update",
                "controller" => "TodosController",
                "action" => "update"
            ],
            [
                "pattern" => "/statuses/create",
                "controller" => "StatusesController",
                "action" => "create"
            ],
            [
                "pattern" => "/statuses/update",
                "controller" => "StatusesController",
                "action" => "update"
            ],
            [
                "pattern" => "/users/create",
                "controller" => "UsersController",
                "action" => "create"
            ],
            [
                "pattern" => "/authenticate",
                "controller" => "UsersController",
                "action" => "authenticate"
            ],
        ]
    ];

?>