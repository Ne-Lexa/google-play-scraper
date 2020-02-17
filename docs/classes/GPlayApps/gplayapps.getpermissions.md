[Documentation](../../README.md) > [GPlayApps](README.md) > **getPermissions**

# Nelexa\GPlay\GPlayApps::getPermissions
`Nelexa\GPlay\GPlayApps::getPermissions` — Returns a list of permissions for the application.

## Description
```php
Nelexa\GPlay\GPlayApps::getPermissions ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\Permission[]
```

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object

## Return Values
an array of permissions for the application


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
```php
$appInfo = 'com.google.android.webview';
// either
$appInfo = new \Nelexa\GPlay\Model\AppId('com.google.android.webview', 'en');
// or
$appInfo = $gplay->getAppInfo('com.google.android.webview');

$permissions = $gplay->getPermissions($appInfo);
```
<details>
  <summary>Results</summary>

```php
array:1 [
    "Other" => class Nelexa\GPlay\Model\Permission {
      -getLabel(): string: "Other"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
      }
      -getPermissions(): array:2 [
        0 => "view network connections"
        1 => "full network access"
      ]
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getPermissions**
