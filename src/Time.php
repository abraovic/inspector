<?php
namespace abraovic\inspector;


class Time
{
    private static $timeInspectorStart;
    private  static $classicStart;

    public static function startTimeInspector()
    {
        self::$timeInspectorStart = getrusage();
        self::$classicStart = microtime(true);
    }

    /**
     * Credits https://stackoverflow.com/questions/535020/tracking-the-script-execution-time-in-php
     *         phihag
     *
     * @return string
     */
    public static function getTimeStats(): string
    {
        $end = getrusage();
        $endMicrotime = microtime(true);
        $classicEnd = $endMicrotime - self::$classicStart;
        $classicBeginToEnd = $endMicrotime - $_SERVER["REQUEST_TIME_FLOAT"];

        $output = "This process used " . self::ruTime($end, 'utime') . " ms for its computations\n";
        $output .= "It spent " . self::ruTime($end, 'stime') . " ms in system calls\n";
        $output .= "Microtime: " . $classicEnd . " s\n";
        $output .= "Microtime (from the beginning of the request): " . $classicBeginToEnd . " s\n";

        return $output;
    }

    /**
     * Credits https://stackoverflow.com/questions/535020/tracking-the-script-execution-time-in-php
     *         phihag
     *
     * @param array $end
     * @param string $index
     * @return string
     */
    private static function ruTime(array $end, string $index): string
    {
        return ($end["ru_$index.tv_sec"]*1000 + intval($end["ru_$index.tv_usec"]/1000))
            -  (self::$timeInspectorStart["ru_$index.tv_sec"]*1000 + intval(self::$timeInspectorStart["ru_$index.tv_usec"]/1000));
    }
}