[Documentation](../../README.md) > [AppInfo](README.md) > **getScreenshots**

# Nelexa\GPlay\Model\AppInfo::getScreenshots
`Nelexa\GPlay\Model\AppInfo::getScreenshots` — Returns screenshots of the application.

## Description
```php
Nelexa\GPlay\Model\AppInfo::getScreenshots ( void ) : Nelexa\GPlay\Model\GoogleImage[]
```
The array must contain at least 2 screenshots.

Google Play screenshots requirements:
* JPEG or 24-bit PNG (no alpha)
* Minimum dimension: 320px
* Maximum dimension: 3840px
* The maximum dimension of the screenshot can't be more than twice as long as the minimum dimension.

## Parameters
This function has no parameters.

## Return Values
array of screenshots

[Documentation](../../README.md) > [AppInfo](README.md) > **getScreenshots**
