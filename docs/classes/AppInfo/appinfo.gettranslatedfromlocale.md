[Documentation](../../README.md) > [AppInfo](README.md) > **getTranslatedFromLocale**

# Nelexa\GPlay\Model\AppInfo::getTranslatedFromLocale
`Nelexa\GPlay\Model\AppInfo::getTranslatedFromLocale` — Returns locale (language) of the original description.

## Description
```php
Nelexa\GPlay\Model\AppInfo::getTranslatedFromLocale ( void ) : string | null
```
Google automatically translates the description of the application if the developer
has not added it to the Play Console in the "Add your own translation text" section.
If a translation is added, the value will be null.

## Parameters
This function has no parameters.

## Return Values
if the developer added a translation of the description, then the
value will be `null`, otherwise the original language of the application description

[Documentation](../../README.md) > [AppInfo](README.md) > **getTranslatedFromLocale**
