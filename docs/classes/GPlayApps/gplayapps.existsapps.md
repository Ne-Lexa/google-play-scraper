[Documentation](../../README.md) > [GPlayApps](README.md) > **existsApps**

# Nelexa\GPlay\GPlayApps::existsApps
`Nelexa\GPlay\GPlayApps::existsApps` — Checks if the specified applications exist in the Google Play store.

## Description
```php
Nelexa\GPlay\GPlayApps::existsApps ( string[] | Nelexa\GPlay\Model\AppId[] $appIds ) : bool[]
```
HTTP requests are executed in parallel.

## Parameters
* **$appIds** (string[] | [Nelexa\GPlay\Model\AppId](../AppId/README.md)[])  
Array of application identifiers.
The keys of the returned array correspond to the transferred array.

## Return Values
An array of information about the existence of each
application in the store Google Play. The keys of the returned
array matches to the passed array.


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if an HTTP error other than 404 is received
## Examples
```php
$gplay->setConcurrency(8);

$exists = $gplay->existsApps([
    'maps' => 'com.google.android.apps.maps',
    'docs' => new \Nelexa\GPlay\Model\AppId('com.google.android.apps.docs'),
    /* 0 => */ 'com.google.android.apps.googleassistant',
    /* 1 => */ 'com.google.android.keep',
    'invalid' => 'com.android.test',
    'com.google.android.apps.authenticator2' => 'com.google.android.apps.authenticator2',
]);
```
<details>
  <summary>Results</summary>

```php
array:6 [
    "maps" => true
    "docs" => true
    0 => true
    1 => true
    "invalid" => false
    "com.google.android.apps.authenticator2" => true
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **existsApps**
