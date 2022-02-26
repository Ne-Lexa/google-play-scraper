[Documentation](../../README.md) > [GPlayApps](README.md) > **existsApp**

# Nelexa\GPlay\GPlayApps::existsApp
`Nelexa\GPlay\GPlayApps::existsApp` — Checks if the specified application exists in the Google Play store.

## Description
```php
Nelexa\GPlay\GPlayApps::existsApp ( string | Nelexa\GPlay\Model\AppId $appId ) : bool
```

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as
a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object

## Return Values
returns `true` if the application exists, or `false` if not

## Examples
**Example 1 - App exists.**
```php
$appId = 'com.mojang.minecraftpe';
// or
$appId = new \Nelexa\GPlay\Model\AppId('com.mojang.minecraftpe', 'en', 'in');

$exists = $gplay->existsApp($appId);
```
<details>
  <summary>Results</summary>

```php
true
```

</details>

**Example 2 - App doesn't exists.**
```php
$appId = 'com.test.app';
// or
$appId = new \Nelexa\GPlay\Model\AppId('com.test.app', 'fr', 'fr');

$exists = $gplay->existsApp($appId);
```
<details>
  <summary>Results</summary>

```php
false
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **existsApp**
