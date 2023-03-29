<?php

    function index () {
        render("pages/index", [
            "title" => "The Todo Application",
            "page_stylesheet" => "home"
        ]);
    }

?>