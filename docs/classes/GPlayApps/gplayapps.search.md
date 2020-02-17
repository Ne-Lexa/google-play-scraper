[Documentation](../../README.md) > [GPlayApps](README.md) > **search**

# Nelexa\GPlay\GPlayApps::search
`Nelexa\GPlay\GPlayApps::search` — Returns a list of applications from the Google Play store for a search query.

## Description
```php
Nelexa\GPlay\GPlayApps::search ( string $query [, int $limit = 50 ] [, Nelexa\GPlay\Enum\PriceEnum | null $price = null ] ) : Nelexa\GPlay\Model\App[]
```

## Parameters
* **$query** (string)  
search query
* **$limit** (int)  
the limit on the number of search results
* **$price** ([Nelexa\GPlay\Enum\PriceEnum](../PriceEnum/README.md) | null)  
price category or `null`

## Return Values
an array of applications with basic information


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$apps = $gplay->search(
    $query = 'Maps',
    $limit = 150,
    $price = \Nelexa\GPlay\Enum\PriceEnum::ALL()
);
```
<details>
  <summary>Results</summary>

```php
array:150 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.maps"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps&hl=en_US&gl=us"
      -getName(): string: "Maps - Navigate & Explore"
      -getSummary(): ?string: "Real-time GPS navigation & local suggestions for food, events, & activities"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
      }
      -getScore(): float: 4.3254695
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.mapslite"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite&hl=en_US&gl=us"
      -getName(): string: "Google Maps Go - Directions, Traffic & Transit"
      -getSummary(): ?string: "Get real-time traffic, directions, search and find places"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
      }
      -getScore(): float: 4.3090644
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\Enum\PriceEnum](../PriceEnum/README.md) - Contains all valid values for the "price" parameter.
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **search**
