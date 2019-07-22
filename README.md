# Activation Lock

Library for generating Apple [Activation Lock Bypass](https://developer.apple.com/documentation/devicemanagement/device_assignment/activation_lock_a_device/creating_and_using_bypass_codes) key and hash

## Install

```
composer require proget-hq/apple-activation-token
```

## Usage

```php
require_once __DIR__.'/vendor/autoload.php';

use \Proget\Apple\ActivationLock\ActivationLockHashGenerator;
use \Proget\Apple\ActivationLock\ActivationLockKeyGenerator;
use \Proget\Apple\ActivationLock\ActivationLockRandomBytesGenerator;

$bytes = (new ActivationLockRandomBytesGenerator())->generate();
$hash = (new ActivationLockHashGenerator())->generate($bytes);
$key = (new ActivationLockKeyGenerator())->generate($bytes);

```

## License

MIT
