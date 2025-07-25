<?php

namespace App\Helpers;

use InvalidArgumentException;

class TimeHelper
{
    /**
     * Convierte tiempo en formato HH:MM a minutos totales
     * @param string $time Tiempo en formato "HH:MM"
     * @return int Minutos totales
     * @throws InvalidArgumentException si el formato es inválido
     */
    public function timeToMinutes(string $time): int
    {
        // Validar el formato (ahora acepta 00:MM)
        if (!preg_match('/^([0-9]{2}):([0-5][0-9])$/', $time, $matches)) {
            throw new InvalidArgumentException('Formato de tiempo inválido. Use HH:MM (ejemplo: 00:30, 01:45)');
        }

        $hours = (int) $matches[1];
        $minutes = (int) $matches[2];

        return ($hours * 60) + $minutes;
    }

    /**
     * Convierte minutos totales a formato HH:MM
     * @param int $minutes Minutos totales
     * @return string Tiempo en formato "HH:MM"
     * @throws InvalidArgumentException si los minutos son negativos
     */
    public function minutesToTime(int $minutes): string
    {
        if ($minutes < 0) {
            throw new InvalidArgumentException('Los minutos no pueden ser negativos');
        }

        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        return sprintf('%02d:%02d', $hours, $mins);
    }

    /**
     * Formatea horas y minutos a un string en formato HH:MM
     * @param int $hour Horas
     * @param int $minute Minutos
     * @return string Tiempo formateado
     */
    public function formatTime(int $hour, int $minute): string
    {
        return sprintf('%02d:%02d', $hour, $minute);
    }

    /**
     * Verifica si el tiempo es cero o vacío
     * @param string $time Tiempo en formato "HH:MM"
     * @return bool
     */
    public function isEmptyTime(string $time): bool
    {
        return $time === '00:00' || empty($time);
    }
}