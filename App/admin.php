<?php

class admin {
    function login($f3, $args) {
        // Set the title and content for the admin index page
        $f3->set('title', 'Admin Dashboard');
        $f3->set('content', 'Welcome to the admin dashboard. Manage your site here.');

        // Render the admin index template
        //echo $f3->get('twig')->render('templates/admin_index.html');
        echo "Admin Dashboard</p>";
    }
}