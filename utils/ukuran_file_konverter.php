<?php

/**
 * Fungsi untuk mengkonversi dari satuan Byte ke MegaByte.
 * 
 * Rumus dari Byte ke Megabyte adalah:
 * - Jumlah Bit / 1024 ^ 2.
 * 
 * @param float $bit - Ukuran file dalam bentuk bit
 */
function bitKeMegabit(float $bit)
{
    return $bit / (1024 * 1024);
}
