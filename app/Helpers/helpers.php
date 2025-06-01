<?php
// app/Helpers/helpers.php

if (!function_exists('adjustBrightness')) {
    /**
     * Ajusta el brillo de un color hexadecimal
     * @param string $hex Color en formato hexadecimal
     * @param int $steps Pasos para ajustar (-255 a 255)
     * @return string Color ajustado en formato hexadecimal
     */
    function adjustBrightness($hex, $steps) {
        // Eliminar el signo # si existe
        $hex = ltrim($hex, '#');
        
        // Convertir a RGB
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        // Ajustar cada componente
        $r = max(0, min(255, $r + $steps));
        $g = max(0, min(255, $g + $steps));
        $b = max(0, min(255, $b + $steps));
        
        // Convertir de nuevo a hexadecimal
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}