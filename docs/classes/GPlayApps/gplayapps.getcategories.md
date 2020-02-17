[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategories**

# Nelexa\GPlay\GPlayApps::getCategories
`Nelexa\GPlay\GPlayApps::getCategories` — Returns an array of application categories from the Google Play store.

## Description
```php
Nelexa\GPlay\GPlayApps::getCategories ( void ) : Nelexa\GPlay\Model\Category[]
```

## Parameters
This function has no parameters.

## Return Values
array of application categories


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$categories = $gplay
//    ->setDefaultLocale('fr') // can set locale
    ->getCategories()
;
```
<details>
  <summary>Results</summary>

```php
array:58 [
    0 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "ART_AND_DESIGN"
      -getName(): string: "Art & Design"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "AUTO_AND_VEHICLES"
      -getName(): string: "Auto & Vehicles"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategories**
