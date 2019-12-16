<?php
namespace Tinyu0\Laravels\Monitor;

use Hhxsv5\LaravelS\Swoole\Events\WorkerStartInterface;
use Swoole\Http\Server;

class Monitor implements WorkerStartInterface
{
    private $monitorPath = [];
    private $monitorInterval;
    protected $monitor = false;
    protected $lastMtime = null;

    public function __construct()
    {
        $this->monitor = app('config')->get('monitor.enable', env('APP_DEBUG', false));
        $this->monitorPath = app('config')->get('monitor.path', [
            app()->path(),
            app()->getConfigurationPath(),
            app()->basePath().DIRECTORY_SEPARATOR.'routes'
        ]);
        $this->monitorInterval = app('config')->get('monitor.interval', 2);
        $this->lastMtime = time();
    }

    /**
     * @param \Swoole\Http\Server $server
     * @param int                 $workerId
     */
    public function handle(Server $server, $workerId)
    {
        //first worker running
        if($this->monitor && 0 == $workerId) {
            $paths = $this->monitorPath;

            $server->tick($this->monitorInterval * 1000, function () use ($paths, $server) {
                foreach ($paths as $path) {
                    $dir = new \RecursiveDirectoryIterator($path);
                    $iterator = new \RecursiveIteratorIterator($dir);

                    foreach ($iterator as $file) {
                        if (pathinfo($file, PATHINFO_EXTENSION) != 'php') {
                            continue;
                        }

                        if ($this->lastMtime < $file->getMTime()) {
                            $this->lastMtime = $file->getMTime();
                            echo '[update]' . $file . " reload...\n";
                            $server->reload();
                            $server->stop();
                            return;
                        }
                    }
                }
            });
        }
    }
}
