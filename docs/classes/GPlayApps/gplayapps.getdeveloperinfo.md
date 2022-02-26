[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperInfo**

# Nelexa\GPlay\GPlayApps::getDeveloperInfo
`Nelexa\GPlay\GPlayApps::getDeveloperInfo` — Returns information about the developer: name, icon, cover, description and website address.

## Description
```php
Nelexa\GPlay\GPlayApps::getDeveloperInfo ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId ) : Nelexa\GPlay\Model\Developer
```

## Parameters
* **$developerId** (string | [Nelexa\GPlay\Model\Developer](../Developer/README.md) | [Nelexa\GPlay\Model\App](../App/README.md))  
developer id as
string, [Nelexa\GPlay\Model\Developer](../Developer/README.md)
or [Nelexa\GPlay\Model\App](../App/README.md) object

## Return Values
information about the application developer


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$devId = '5700313618786177705';
// either
$devId = $gplay->getAppInfo('com.android.chrome');
// or
$devId = $gplay->getAppInfo('com.android.chrome')->getDeveloper();

$developerInfo = $gplay->getDeveloperInfo($devId);
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\Developer {
  -getId(): string: "5700313618786177705"
  -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
  -getName(): string: "Google LLC"
  -getDescription(): ?string: "Apps from Google to help you get the most out of your day, across all your devices."
  -getWebsite(): ?string: null
  -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
    -getUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
    -getBinaryImageContent(): string: …
  }
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
    -getUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
    -getBinaryImageContent(): string: …
  }
  -getEmail(): ?string: null
  -getAddress(): ?string: null
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::getDeveloperInfoForLocales()](gplayapps.getdeveloperinfoforlocales.md) - Returns information about the developer for the locale array.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperInfo**
