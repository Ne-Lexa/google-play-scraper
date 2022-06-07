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
array:59 [
    0 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "GAME"
      -getName(): string: "Game"
      -isGamesCategory(): bool: true
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: false
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "FAMILY"
      -getName(): string: "Family"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: true
      -isApplicationCategory(): bool: false
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategories**
