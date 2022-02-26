[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategoriesForLocales**

# Nelexa\GPlay\GPlayApps::getCategoriesForLocales
`Nelexa\GPlay\GPlayApps::getCategoriesForLocales` — Returns an array of application categories from the Google Play store for the specified locales.

## Description
```php
Nelexa\GPlay\GPlayApps::getCategoriesForLocales ( string[] $locales ) : Nelexa\GPlay\Model\Category[][]
```
HTTP requests are executed in parallel.

## Parameters
* **$locales** (string[])  
array of locales

## Return Values
array of application categories by locale


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$gplay->setConcurrency(4);
$categories = $gplay->getCategoriesForLocales(['en', 'pt_PT', 'pt_BR', 'fr']);
```
<details>
  <summary>Results</summary>

```php
array:4 [
    "en_US" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_PT" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentação e bebida"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de relógio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_BR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps para smartwatch"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fr_FR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Applications montre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategoriesForLocales**
