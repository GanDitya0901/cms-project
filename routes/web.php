<?php
$routes = [
    "login" => [
        "controller" => "AuthController",
        "method" => "loginForm"
    ],
    "register" => [
        "controller" => "AuthController",
        "method" => "regForm",
    ],
    "landing-page" => [
        "controller" => "GuestController",
        "method" => "landingPage",
    ],
    "master-dashboard" => [
        "controller" => "MasterController",
        "method" => "masterDashboard",
    ],
    "admin-dashboard" => [
        "controller"=> "AdminController",
        "method"=> "adminDashboard"
    ],
    "reg-form" => [
        "controller" => "MasterController",
        "method" => "adminRegistration",
    ],
    "update-form" => [
        "controller" => "MasterController",
        "method" => "showAdmin",
    ],
    "admin-update" => [
        "controller" => "MasterController",
        "method" => "adminUpdate"
    ],
    "delete-admin" => [
        "controller" => "MasterController",
        "method" => "deleteAdmin"
    ], 
    "logout" => [
        "controller"=> "AuthController",
        "method"=> "logout"
    ], 
    "createRoom-form" => [
        "controller"=> "AdminController",
        "method"=> "roomCreation"
    ], 
    "updateRoom-form" => [
        "controller"=> "AdminController",
        "method"=> "showRooms"
    ], 
    "room-update" => [
        "controller"=> "AdminController",
        "method" => "roomUpdate"
    ], 
    "delete-room" => [
        "controller"=> "AdminController",
        "method"=> "deleteRoom"
    ], 
    "room-page"=> [
        "controller"=> "GuestController",
        "method"=> "showRoomGuest"
    ], 
    "book-room"=> [
        "controller"=> "GuestController",
        "method"=> "bookRoom"
    ],
    "createPost-form"=> [
        "controller"=> "AdminController",
        "method"=> "postCreation"
    ],

    "postUpdate-form"=> [
        "controller"=> "AdminController",
        "method"=> "showPost"
    ], 
    "update-post"=> [
        "controller"=> "AdminController",
        "method"=> "updatePost"
    ], 
    "delete-post"=> [
        "controller"=> "AdminController",
        "method"=> "postDelete"
    ], 
    "view-post"=> [
        "controller"=> "GuestController", 
        "method"=> "showPost"
    ], 
    "make-comment"=> [
        "controller"=> "GuestController", 
        "method"=> "makeComment"
    ]
];
?>