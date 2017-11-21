<?php
namespace abraovic\inspector;


class Memory
{
    /**
     * @param $realUsage
     * @return string
     */
    public static function printMemoryStats($realUsage = false): string
    {
        $currMemory = self::humanReadableMemory(memory_get_usage($realUsage));
        $currMemoryPeak = self::humanReadableMemory(memory_get_peak_usage($realUsage));

        $output = "Memory usage : " . $currMemory . "\n";
        $output .= "Memory peak usage : " . $currMemoryPeak . "\n";

        return $output;
    }

    /**
     * Credits http://php.net/manual/de/function.filesize.php#106569
     *         rommel at rommelsantor dot com
     * @param int $bytes
     * @param int $decimals = 2 -> precision
     * @return string -> human readable value with unit string
     */
    private static function humanReadableMemory(int $bytes, int $decimals = 2): string
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
}