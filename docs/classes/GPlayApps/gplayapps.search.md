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
array:30 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.maps"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps&hl=en_US&gl=us"
      -getName(): string: "Google Maps"
      -getDescription(): string: """
        Navigate your world faster and easier with Google Maps. Over 220 countries and territories mapped and hundreds of millions of businesses and places on…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:31 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/FK7X8M1BCF0Ji6-TkHaww2qP8FEdIrvofW6qDRMCNjszqq5XiVmGNCV00KXSSuETMS8"
          -getUrl(): string: "https://play-lh.googleusercontent.com/FK7X8M1BCF0Ji6-TkHaww2qP8FEdIrvofW6qDRMCNjszqq5XiVmGNCV00KXSSuETMS8"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/FK7X8M1BCF0Ji6-TkHaww2qP8FEdIrvofW6qDRMCNjszqq5XiVmGNCV00KXSSuETMS8=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/PJkiXQiABQxpVdHMpvOux53wP2TVuYg0fq9K5JYYDO336nvbX-0ShhHWzZGnagmWlw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/PJkiXQiABQxpVdHMpvOux53wP2TVuYg0fq9K5JYYDO336nvbX-0ShhHWzZGnagmWlw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/PJkiXQiABQxpVdHMpvOux53wP2TVuYg0fq9K5JYYDO336nvbX-0ShhHWzZGnagmWlw=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 3.9432514
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10,000,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.mapslite"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite&hl=en_US&gl=us"
      -getName(): string: "Google Maps Go"
      -getDescription(): string: """
        Google Maps Go is the lightweight Progressive Web App variation of the original Google Maps app, now with navigation support!\n
        \n
        This version requires C…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/3vPSgESCm8Js8Rc4aQpyhTW4jDw1c2Byo5-GqJvOZK-ZLCxM4uUw04cQ_BqtEXbmQ2k"
          -getUrl(): string: "https://play-lh.googleusercontent.com/3vPSgESCm8Js8Rc4aQpyhTW4jDw1c2Byo5-GqJvOZK-ZLCxM4uUw04cQ_BqtEXbmQ2k"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3vPSgESCm8Js8Rc4aQpyhTW4jDw1c2Byo5-GqJvOZK-ZLCxM4uUw04cQ_BqtEXbmQ2k=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/DroqcHHG9bjFKR9DxP8iNQI_ziraiu8aVH-FoHmJNN0ex9hA5BmC5MA3DOOdqojYCI0D"
          -getUrl(): string: "https://play-lh.googleusercontent.com/DroqcHHG9bjFKR9DxP8iNQI_ziraiu8aVH-FoHmJNN0ex9hA5BmC5MA3DOOdqojYCI0D"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/DroqcHHG9bjFKR9DxP8iNQI_ziraiu8aVH-FoHmJNN0ex9hA5BmC5MA3DOOdqojYCI0D=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3651714
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\Enum\PriceEnum](../PriceEnum/README.md) - Contains all valid values for the "price" parameter.
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **search**
