<?php
// Legacy pages may contain a UTF-8 BOM or emit an early notice. Buffer output
// so their header()/session redirects keep working under PHP-FPM.
if (ob_get_level() === 0) {
    ob_start();
}
