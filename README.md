# laravels-file-monitor

[![Latest Stable Version](https://poser.pugx.org/tinyu0/laravels-file-monitor/v/stable.svg)](https://packagist.org/packages/tinyu0/laravels-file-monitor)
[![Latest Unstable Version](https://poser.pugx.org/tinyu0/laravels-file-monitor/v/unstable.svg)](https://packagist.org/packages/tinyu0/laravels-file-monitor)
[![Total Downloads](https://poser.pugx.org/tinyu0/laravels-file-monitor/downloads.svg)](https://packagist.org/packages/tinyu0/laravels-file-monitor)
[![License](https://poser.pugx.org/tinyu0/laravels-file-monitor/license.svg)](https://github.com/tinyu0/laravels-file-monitor/blob/master/LICENSE)

1.Require package via Composer(packagist).
```
composer require "tinyu0/laravels-file-monitor"
```

2.Publish configuration and binaries.

Suggest that do publish after upgrade LaravelS every time
```
php artisan laravels publish
# Configuration: config/laravels.php
# Binary: bin/laravels bin/fswatch
```

3.Change `config/laravels.php`: event_handlers [Settings](https://github.com/tinyu0/laravels-file-monitor/blob/master/Settings.md).
```php
    'event_handlers'           => [
        'WorkerStart' => \Tinyu0\Laravels\Monitor\monitor::class
    ],
```

4.Run
```bash
php bin/laravels {start|stop|restart|reload|info|help}
```
