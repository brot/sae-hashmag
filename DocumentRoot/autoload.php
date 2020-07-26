<?php
/**
 * spl_autoload_register Funktion akzeptiert einen Parameter, eine Funktion. Diese Funktion wird aufgerufen, wenn eine
 * Klasse verwendet werden soll, die noch nicht importiert wurde. Diese Funktion erhält den kompletten Klassennamen
 * inkl. Namespace übergeben.
 */
spl_autoload_register(function ($namespaceAndClassname) {
    /**
     * Hier versuchen wir den Namespace in einen validen Dateipfad umzuwandeln. Daher ist es wichtig, dass der
     * Klassenname und der Dateiname ident sind.
     *
     * z.B.:
     * + Core\Bootstrap => core/Bootstrap.php
     * + App\Models\User => app/Models/User.php
     */
    $namespaceAndClassname = str_replace('Core', 'core', $namespaceAndClassname);
    $namespaceAndClassname = str_replace('App', 'app', $namespaceAndClassname);
    $filepath = str_replace('\\', '/', $namespaceAndClassname);

    $php_file = __DIR__ . "/{$filepath}.php";
    if (file_exists ($php_file)) {
        require_once $php_file;
    }
});