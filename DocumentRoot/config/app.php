<?php

// baseUrl für alle relativen URLs welche von diesem Pfad aus berechnet werden
return [
    'baseUrl' => getenv('BASE_URL', true) ?: 'http://localhost/'
];
