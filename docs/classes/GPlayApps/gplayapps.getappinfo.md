[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfo**

# Nelexa\GPlay\GPlayApps::getAppInfo
`Nelexa\GPlay\GPlayApps::getAppInfo` — Returns the full detail of an application.

## Description
```php
Nelexa\GPlay\GPlayApps::getAppInfo ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\AppInfo
```
For information, you must specify the application ID (android package name).
The application ID can be viewed in the Google Play store:
`https://play.google.com/store/apps/details?id=XXXXXX` , where
XXXXXX is the application id.

Or it can be found in the APK file.
```shell
aapt dump badging file.apk | grep package | awk '{print $2}' | sed s/name=//g | sed s/\'//g
```

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
google play app id (Android package name)

## Return Values
full detail of an application or exception


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
**Example 1 - Use the default locale and country to request information.**
```php
$appInfo = $gplay->getAppInfo('com.mojang.minecraftpe');
```

**Example 2 - Specify the locale and country to request information.**
```php
$appInfo = $gplay->getAppInfo(
    new \Nelexa\GPlay\Model\AppId(
        'com.mojang.minecraftpe', // id
        'uk', // locale
        'ua' // country
    )
);
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\AppInfo {
  -getId(): string: "com.mojang.minecraftpe"
  -getLocale(): string: "uk"
  -getCountry(): string: "ua"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&hl=uk&gl=ua"
  -getName(): string: "Minecraft"
  -getDescription(): string: """
    Досліджуйте безкінечні світи та будуйте що завгодно: від простих хижок до розкішних замків. Грайте у творчому режимі з необмеженими ресурсами або вибе…
    """
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
    -getBinaryImageContent(): string: …
  }
  -getScreenshots(): array: array:12 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/2Qhsn-Uo3HjXKa5tJErKbSuoiHKO5M2gpD1dANPcHfLHFaEDUIOZpd5M0v_ois_c_n8"
      -getUrl(): string: "https://play-lh.googleusercontent.com/2Qhsn-Uo3HjXKa5tJErKbSuoiHKO5M2gpD1dANPcHfLHFaEDUIOZpd5M0v_ois_c_n8"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/2Qhsn-Uo3HjXKa5tJErKbSuoiHKO5M2gpD1dANPcHfLHFaEDUIOZpd5M0v_ois_c_n8=s0"
      -getBinaryImageContent(): string: …
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/8ZAmvKPwrGfx-4eTBuU_h4-XlxLOcJM6zjMscVJUHHP8mb1ENo9sOMh9Ul4nTdGuW7M"
      -getUrl(): string: "https://play-lh.googleusercontent.com/8ZAmvKPwrGfx-4eTBuU_h4-XlxLOcJM6zjMscVJUHHP8mb1ENo9sOMh9Ul4nTdGuW7M"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/8ZAmvKPwrGfx-4eTBuU_h4-XlxLOcJM6zjMscVJUHHP8mb1ENo9sOMh9Ul4nTdGuW7M=s0"
      -getBinaryImageContent(): string: …
    }
    …
  ]
  -getScore(): float: 4.4919477
  -getPriceText(): ?string: "209,99 грн"
  -isFree(): bool: false
  -getInstallsText(): string: "10 000 000+"
  -jsonSerialize(): array: …
  -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
    -getId(): string: "4772240228547998649"
    -getUrl(): string: "https://play.google.com/store/apps/dev?id=4772240228547998649"
    -getName(): string: "Mojang"
    -getDescription(): ?string: null
    -getWebsite(): ?string: "http://help.mojang.com"
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: "help@minecraft.net"
    -getAddress(): ?string: """
      Mojang\n
      Maria Skolgata 83\n
      118 53\n
      Stockholm\n
      Sweden
      """
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getDeveloperName(): mixed: "Mojang"
  -getSummary(): string: "Minecraft – це гра, у якій ви розставляєте блоки та шукаєте пригоди."
  -getTranslatedFromLocale(): mixed: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
    -getBinaryImageContent(): string: …
  }
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_ARCADE"
    -getName(): string: "Аркади"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_SIMULATION"
    -getName(): string: "Симулятори"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getVideo(): ?Nelexa\GPlay\Model\Video: null
  -getRecentChanges(): ?string: """
    Що нового в 1.18.32:\n
    Різні виправлення помилок
    """
  -isEditorsChoice(): bool: false
  -getInstalls(): int: 42698734
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 338429
    -getFourStars(): int: 85306
    -getThreeStars(): int: 173410
    -getTwoStars(): int: 381782
    -getOneStar(): int: 3623437
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getPrice(): float: 209.99
  -getCurrency(): string: "UAH"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "9,36 грн – 1 349,99 грн за продукт"
  -isContainsAds(): bool: false
  -getSize(): mixed: null
  -getAppVersion(): ?string: "1.18.32.02"
  -getAndroidVersion(): ?string: "5.0"
  -getMinAndroidVersion(): ?string: "5.0"
  -getContentRating(): ?string: ""
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313475441 {
    date: 2011-08-16T06:17:21+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1651770636 {
    date: 2022-05-05T17:10:36+00:00
  }
  -getNumberVoters(): int: 4602507
  -getNumberReviews(): int: 15548
  -getReviews(): array: array:40 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHh4V5ct0qTBE4SFSkJeGICh2eSzzuDD-6iGMql52mF8A8GwJ6VlKtDdM7slZ0cHlnU2ReOc-j7-WLAbvQ"
      -getUrl(): mixed: ""
      -getUserName(): string: "Мангли"
      -getText(): string: "Гра чудова мені подобається 😁"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghgk5ZshoNrKtQGrcAJkFicpeXqq_YXmqcP_BPJZA=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghgk5ZshoNrKtQGrcAJkFicpeXqq_YXmqcP_BPJZA=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghgk5ZshoNrKtQGrcAJkFicpeXqq_YXmqcP_BPJZA=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652859421 {
        date: 2022-05-18T07:37:01+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 769
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: "1.18.32.02"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOFjX8MX-dIrpBWlo70C9RtYKsvwJEreIzhVdj6eS0rPgwdTRH2lNVZ6pnXw7nBWmGICJ_FbFb-FY-NJAwE"
      -getUrl(): mixed: ""
      -getUserName(): string: "GM LX"
      -getText(): string: "Прікольна гра, тільки загрузуа довговата стала раніше була краще, хімія вабще супер!👍!"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiwgvL2ui8R3mJEZkQ3VAV-AJG97w-ZepDFG4wNZg=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiwgvL2ui8R3mJEZkQ3VAV-AJG97w-ZepDFG4wNZg=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiwgvL2ui8R3mJEZkQ3VAV-AJG97w-ZepDFG4wNZg=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652444165 {
        date: 2022-05-13T12:16:05+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 723
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: "1.18.32.02"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
  -asArray(): array: …
}
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfo**
