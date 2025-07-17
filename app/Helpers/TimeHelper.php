<?php

namespace App\Helpers;

use InvalidArgumentException;

class TimeHelper
{
    /**
     * Convierte tiempo en formato HH:MM a minutos totales
     * @param string $time Tiempo en formato "H:MM"
     * @return int Minutos totales
     * @throws InvalidArgumentException si el formato es inválido
     */
    public function timeToMinutes(string $time): int
    {
        // Validar el formato
        if (!preg_match('/^(\d+):([0-5]\d)$/', $time, $matches)) {
            throw new InvalidArgumentException('Formato de tiempo inválido. Use H:MM (ejemplo: 1:05, 2:15)');
        }

        $hours = (int) $matches[1];
        $minutes = (int) $matches[2];

        return ($hours * 60) + $minutes;
    }

    /**
     * Convierte minutos totales a formato HH:MM
     * @param int $minutes Minutos totales
     * @return string Tiempo en formato "H:MM"
     * @throws InvalidArgumentException si los minutos son negativos
     */
    public function minutesToTime(int $minutes): string
    {
        if ($minutes < 0) {
            throw new InvalidArgumentException('Los minutos no pueden ser negativos');
        }

        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        return sprintf('%d:%02d', $hours, $mins);
    }

    /**
     * Formatea horas y minutos a un string en formato HH:MM
     * @param int $hour Horas
     * @param int $minute Minutos
     * @return string Tiempo formateado
     */
    public function formatTime(int $hour, int $minute): string
    {
        $hour = intval($hour);
        if ($hour < 1) {
            return (string)$minute;
        } else {
            return sprintf('%d:%02d', $hour, $minute);
        }
    }
}