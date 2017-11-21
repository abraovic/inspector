<?php
namespace abraovic\inspector;

class Inspector
{
    private static $toFile = false;
    private static $filename;

    /**
     * If you want to print stuff into file call init and send path
     *
     * @param string $filename
     */
    public static function init($filename)
    {
        self::$filename = $filename;
        self::$toFile = true;
    }

    /**
     * @param $memoryRealUsage
     */
    public static function printTimeAndMemoryStats($memoryRealUsage = false)
    {
        self::get(
            Time::getTimeStats() . Memory::printMemoryStats()
        );
    }

    /**
     * @param $realUsage
     */
    public static function printMemoryStats($realUsage = false)
    {
        self::get(Memory::printMemoryStats($realUsage));
    }


    public static function startTimeInspector()
    {
        Time::startTimeInspector();
    }

    public static function printTimeStats()
    {
        self::get(Time::getTimeStats());
    }

    /**
     * Determines if data will be saved to file or printed to stdout
     */
    private static function get(string $output)
    {
        if (self::$toFile) {
            self::save($output);
        } else {
            self::print($output);
        }
    }

    /**
     * @param string $output
     */
    private static function print(string $output)
    {
        echo self::format($output);
    }

    private static function save(string $output)
    {
        file_put_contents(self::$filename, self::format($output), FILE_APPEND);
    }

    /**
     * @param string $output
     */
    private static function format(string $output): string
    {
        return "====================== \n" .
            "File: " . basename(__FILE__) . "\n" .
            $output . "\n";
    }
}