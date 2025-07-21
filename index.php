<?php 

require 'vendor/autoload.php';
$f3 = Base::instance();

$f3->set('AUTOLOAD', 'vendor; '. 'App/;'  );

$f3->set('DEBUG',3);
 
$f3->config('config.ini');

$db = new DB\SQL("mysql:host={$f3->DB['HOST']};port={$f3->DB['PORT']};dbname={$f3->DB['DB']};", $f3->DB['USER'], $f3->DB['PASS']);
$f3->set('db', $db);

$template_path = __DIR__ . '/' . $f3->get('UI');

$twig_loader = new \Twig\Loader\FilesystemLoader($template_path);

$cache_dir = getenv('TMP') ?: getenv('TEMP');
if (!$cache_dir) {
    $cache_dir = __DIR__ . '/tmp/twig_cache';
} else {
    $cache_dir .= '/twig_cache';
}

//Initialize Twig Environment
$twig = new \Twig\Environment($twig_loader, [
    'cache' => $cache_dir, // Optional: path to Twig cache directory
    'auto_reload' => true, // Set to false in production for better performance
    // 'debug' => true, // Uncomment for debugging Twig templates
]);

$twig->addGlobal('current_year', date('Y'));

// Make the Twig environment globally accessible via F3 (optional, but convenient)
$f3->set('twig', $twig);

$f3->run();