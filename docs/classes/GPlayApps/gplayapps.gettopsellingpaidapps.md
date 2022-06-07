[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopSellingPaidApps**

# Nelexa\GPlay\GPlayApps::getTopSellingPaidApps
`Nelexa\GPlay\GPlayApps::getTopSellingPaidApps` — Returns an array of **top selling paid apps** from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getTopSellingPaidApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum $category = "APPLICATION" ] [, int $limit = 500 ] ) : Nelexa\GPlay\Model\App[]
```

## Parameters
* **$category** (string | [Nelexa\GPlay\Model\Category](../Category/README.md) | [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md))  
application category as string, [Nelexa\GPlay\Model\Category](../Category/README.md), [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md), ex. APPLICATION or GAME
* **$limit** (int)  
Limit

## Return Values
App list


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md)
## Examples
**Example 1. Gets top selling paid apps by category.**
```php
$apps = $gplay->getTopSellingPaidApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:38 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.games.nfs13_na"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.nfs13_na"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.nfs13_na&hl=en_US&gl=us"
      -getName(): string: "Need for Speed Most Wanted"
      -getDescription(): string: """
        Google Play Special Offer - Get over 80% off for a limited time only!\n
        \n
        “The graphics are absolutely awesome” (Eurogamer.es)\n
        \n
        “It pushes the mobile pla…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "ELECTRONIC ARTS"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/E0yjOHksPFKkjALyEth4SzpWE_ynsCj5o9w9kIP5zm7QBzbVjF4pUOifiU_q2ecWZplU"
        -getUrl(): string: "https://play-lh.googleusercontent.com/E0yjOHksPFKkjALyEth4SzpWE_ynsCj5o9w9kIP5zm7QBzbVjF4pUOifiU_q2ecWZplU"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/E0yjOHksPFKkjALyEth4SzpWE_ynsCj5o9w9kIP5zm7QBzbVjF4pUOifiU_q2ecWZplU=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:7 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/59zYhJsE3XhzzvQQRSOnIoMssQ6kPJbGaW6fzCC5LgHmmo9K5DXVGJnWWZg6-QV3bg"
          -getUrl(): string: "https://play-lh.googleusercontent.com/59zYhJsE3XhzzvQQRSOnIoMssQ6kPJbGaW6fzCC5LgHmmo9K5DXVGJnWWZg6-QV3bg"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/59zYhJsE3XhzzvQQRSOnIoMssQ6kPJbGaW6fzCC5LgHmmo9K5DXVGJnWWZg6-QV3bg=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/syir6zy2llwJYDt7OyO-SgalgKvLbYXXSTDDtZT4oRekf9D41Haz-D2rvD7gFq5eK85N"
          -getUrl(): string: "https://play-lh.googleusercontent.com/syir6zy2llwJYDt7OyO-SgalgKvLbYXXSTDDtZT4oRekf9D41Haz-D2rvD7gFq5eK85N"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/syir6zy2llwJYDt7OyO-SgalgKvLbYXXSTDDtZT4oRekf9D41Haz-D2rvD7gFq5eK85N=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 3.9224076
      -getPriceText(): ?string: "$4.99"
      -isFree(): bool: false
      -getInstallsText(): string: "1,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.digitaldreamlabs.retrodrive"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.digitaldreamlabs.retrodrive"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.digitaldreamlabs.retrodrive&hl=en_US&gl=us"
      -getName(): string: "Overdrive 2.6 Relaunched by Digital Dream Labs"
      -getDescription(): string: """
        Digital Dream Labs is proud to present Overdrive 2.6, back by popular demand! This version of Overdrive reverts some of the most current changes back …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Digital Dream Labs, Inc."
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/0IEK2PVOicsQIqiKggQRX5JvqSzohlaSG4bIlf4ntG66d0tHCHlJQqnnERJnm1HFc_jE"
        -getUrl(): string: "https://play-lh.googleusercontent.com/0IEK2PVOicsQIqiKggQRX5JvqSzohlaSG4bIlf4ntG66d0tHCHlJQqnnERJnm1HFc_jE"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/0IEK2PVOicsQIqiKggQRX5JvqSzohlaSG4bIlf4ntG66d0tHCHlJQqnnERJnm1HFc_jE=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:5 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/dK_HMrqJbDcwvvTClixDdfxkcatvK0JnS_wW6sFoK7aoNBAMWtp-pLXTQ1z0bbemZW8"
          -getUrl(): string: "https://play-lh.googleusercontent.com/dK_HMrqJbDcwvvTClixDdfxkcatvK0JnS_wW6sFoK7aoNBAMWtp-pLXTQ1z0bbemZW8"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/dK_HMrqJbDcwvvTClixDdfxkcatvK0JnS_wW6sFoK7aoNBAMWtp-pLXTQ1z0bbemZW8=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/XpBHKJBh7HL65S_v_R-nOQ9dCNwsW9-u-oa4Vgs4QnrvftoeYDNe1KlVn202lqjZFw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/XpBHKJBh7HL65S_v_R-nOQ9dCNwsW9-u-oa4Vgs4QnrvftoeYDNe1KlVn202lqjZFw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/XpBHKJBh7HL65S_v_R-nOQ9dCNwsW9-u-oa4Vgs4QnrvftoeYDNe1KlVn202lqjZFw=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 1.95
      -getPriceText(): ?string: "$2.99"
      -isFree(): bool: false
      -getInstallsText(): string: "10,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopSellingPaidApps**
