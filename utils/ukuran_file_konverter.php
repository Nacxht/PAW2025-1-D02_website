<?php

/**
 * Fungsi untuk mengkonversi dari satuan Byte ke MegaByte
 * 
 * @param float $bit - Ukuran file dalam bentuk bit
 */
function bitKeMegabit(float $bit)
{
    return $bit / (1024 * 1024);
}
