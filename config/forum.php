<?php

return [

    /*
     * Define the path to your master view on your "resources/view" folder.
     */

    'template'  => 'intranet/app',


    /*
     * Define @yield( $content ) area where the forum views will be displayed on your app.
     */

    'content'   => 'content',

    /*
     * Define topics for the forum.
     *
     * Create the key for each topic and assign an array with the name and the icon
     * The icon can be anyone of your prefer css framework like glyphicon or Font Awesome
     * Also you can and the key color, with the value of the representative color of the topic.
     */

    'topics' => [
        '1' => ['name' => 'General', 'icon' => 'glyphicon glyphicon-tags', 'color' => '#CC0000'],
        '2' => ['name' => 'Carreras', 'icon' => 'glyphicon glyphicon-tags', 'color' => '#33CC00']
    ],


    /**
     * User settings
     */

    'user' => [

        /**
         * Path to your user model.
         */

        'model'         => \App\User::class,

        /**
         * Define the field on your table user that the forum will use to display the identify user.
         *
         *  examples:
         *
         *  username
         *  name
         *  full_name
         *  email
         *
         *  etc...
         */

        'username'    => 'name',

        /*
         * If you don't want to use gravatar
         * Place this key to true to use your own avatars.
         */

        'avatar'        => true,

        /**
         * Need avatars on your forum.
         */

        'user-avatar'  => 'avatar',

        /**
         * By default the forum uses gravatar.
         *
         * Set this to false to use your own avatars on the users table
         */

        'gravatar' => false,



        /**
         * Require links to user profile
         */

        'profile' => true ,

        /**
         * Route name to user profile.
         * Has to accept one parameter > user ID.
         */

        'profile-route' => 'forum.user.profile',

    ],

    /**
     * User authentication
     */
    'auth' => [

        /**
         * Redirect to the login form.
         */
        'login-url' => 'auth/login'

    ],

    /**
     * Set your own icons of your prefer font
     * By default we use icons from bootstrap
     */
    'icons' => [
        'tags'              => 'glyphicon glyphicon-tags',
        'like'              => 'glyphicon glyphicon-thumbs-up',
        'correct-answer'    => 'glyphicon glyphicon-ok',
        'edit'              => 'glyphicon glyphicon-pencil',
        'delete'            => 'glyphicon glyphicon-trash',
        'home'              => 'glyphicon glyphicon-home',
    ],

    /**
     * Send an email to the conversation owner each time someone left a reply
     */
    'fire' => true,
    'emails' => [

        'fire' => true,

        /**
         * Set the email from
         */
        'from' => '',

        'from-name' => 'Admin',

        'subject' => 'Forum'

    ],

    /**
     * For broadcasting events you must set pusher keys.
     */
    'broadcasting' => false,


];
