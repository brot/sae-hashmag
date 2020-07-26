<?php
/**
 * [x] Bootstrap file laden & anstarten
 * [x] Autoloader starten
 */
require_once __DIR__ . "/autoload.php";

/**
 * MVC "anstarten"
 */
$app = new \Core\Bootstrap();
