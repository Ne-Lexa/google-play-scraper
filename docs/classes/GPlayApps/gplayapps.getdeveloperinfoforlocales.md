[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperInfoForLocales**

# Nelexa\GPlay\GPlayApps::getDeveloperInfoForLocales
`Nelexa\GPlay\GPlayApps::getDeveloperInfoForLocales` — Returns information about the developer for the specified locales.

## Description
```php
Nelexa\GPlay\GPlayApps::getDeveloperInfoForLocales ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId [, string[] $locales = array() ] ) : Nelexa\GPlay\Model\Developer[]
```

## Parameters
* **$developerId** (string | [Nelexa\GPlay\Model\Developer](../Developer/README.md) | [Nelexa\GPlay\Model\App](../App/README.md))  
developer id as string, [Nelexa\GPlay\Model\Developer](../Developer/README.md) or [Nelexa\GPlay\Model\App](../App/README.md) object
* **$locales** (string[])  
array of locales

## Return Values
an array with information about the application developer
for each requested locale


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$gplay->setConcurrency(4); // limit parallel HTTP requests

$devId = '5700313618786177705';
// either
$devId = $gplay->getAppInfo('com.android.chrome');
// or
$devId = $gplay->getAppInfo('com.android.chrome')->getDeveloper();

$developerInfoList = $gplay->getDeveloperInfoForLocales($devId, ['en', 'es', 'ru', 'fr']);
```
<details>
  <summary>Results</summary>

```php
array:4 [
    "en_US" => class Nelexa\GPlay\Model\Developer {
      -getId(): string: "5700313618786177705"
      -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
      -getName(): string: "Google LLC"
      -getDescription(): ?string: "Apps from Google to help you get the most out of your day, across all your devices."
      -getWebsite(): ?string: null
      -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
      }
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
      }
      -getEmail(): ?string: null
      -getAddress(): ?string: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "es_ES" => class Nelexa\GPlay\Model\Developer {
      -getId(): string: "5700313618786177705"
      -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
      -getName(): string: "Google LLC"
      -getDescription(): ?string: "Apps from Google to help you get the most out of your day, across all your devices."
      -getWebsite(): ?string: null
      -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
      }
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
      }
      -getEmail(): ?string: null
      -getAddress(): ?string: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.
* [Nelexa\GPlay\GPlayApps::getDeveloperInfo()](gplayapps.getdeveloperinfo.md) - Returns information about the developer: name, icon, cover, description and website address.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperInfoForLocales**
