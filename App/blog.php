<?php
// Blog index page

class blog {
    function index($f3, $args) {
        // Set the title and content for the index page
        $f3->set('title', 'Welcome to My Blog');
        $f3->set('content', 'This is the home page of my blog. Stay tuned for more updates!');

        // Render the index template
        //echo $f3->get('twig')->render('templates/index.html');
        echo "test</p>";
    }
} 