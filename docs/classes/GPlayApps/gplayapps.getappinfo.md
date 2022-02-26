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
  -getSummary(): ?string: "Minecraft – це гра, у якій ви розставляєте блоки та шукаєте пригоди."
  -getDeveloper(): Nelexa\GPlay\Model\Developer: {
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
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
    -getBinaryImageContent(): string: …
  }
  -getScore(): float: 4.5226836
  -getPriceText(): ?string: "209,99 грн"
  -isFree(): bool: false
  -jsonSerialize(): array: …
  -getDescription(): string: """
    Досліджуйте безкінечні світи та будуйте що завгодно: від простих хижок до розкішних замків. Грайте у творчому режимі з необмеженими ресурсами або вибе…
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
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
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_ARCADE"
    -getName(): string: "Аркади"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: {
    -getImageUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getVideoUrl(): string: "https://www.youtube.com/embed/KhPxEWUgZlg?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    -getYoutubeId(): ?string: "KhPxEWUgZlg"
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getRecentChanges(): ?string: """
    Що нового в 1.18.12:\n
    Різні виправлення помилок
    """
  -isEditorsChoice(): bool: false
  -getInstalls(): int: 40328325
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 3584145
    -getFourStars(): int: 368668
    -getThreeStars(): int: 150635
    -getTwoStars(): int: 76037
    -getOneStar(): int: 311351
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getPrice(): float: 209.99
  -getCurrency(): string: "UAH"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "9,36 грн – 1 349,99 грн за продукт"
  -isContainsAds(): bool: false
  -getSize(): ?string: null
  -getAppVersion(): ?string: "1.18.12.01"
  -getAndroidVersion(): ?string: "5.0 і новіших версій"
  -getMinAndroidVersion(): ?string: "5.0"
  -getContentRating(): ?string: "Від 7 років"
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313366400 {
    date: 2011-08-15T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1644890219 {
    date: 2022-02-15T01:56:59+00:00
  }
  -getNumberVoters(): int: 4490983
  -getNumberReviews(): int: 14756
  -getReviews(): array: array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOG7XMyhwj7VRT8zAQ8VnIp31NeTn2taFtOKz9ExUR3tiMAIL7AFG3TtCoewoqsuliAQFHk7ei9uMTYEKhU"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOG7XMyhwj7VRT8zAQ8VnIp31NeTn2taFtOKz9ExUR3tiMAIL7AFG3TtCoewoqs…"
      -getUserName(): string: "Kira Naumets"
      -getText(): string: "Гра просто супер!!!! Я давно її хотіла, але коли я заходжу в майнкрафт то спочатку мій скін стіва або алекса а потім все нормально."
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgNPA60Ok4r6qGM7B5GshrnzC5TL7y5CL0npenLHQ=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgNPA60Ok4r6qGM7B5GshrnzC5TL7y5CL0npenLHQ=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgNPA60Ok4r6qGM7B5GshrnzC5TL7y5CL0npenLHQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645125219 {
        date: 2022-02-17T19:13:39+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 828
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHR-f11MFPOqd3fc9MH61C2ReUdFUtOoUkGknKBZOPSP-9WuK5fuWvZ5Fk0HG1Fwx0CFk54SXYU6rU5YMo"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHR-f11MFPOqd3fc9MH61C2ReUdFUtOoUkGknKBZOPSP-9WuK5fuWvZ5Fk0HG1…"
      -getUserName(): string: "Артем Шестак"
      -getText(): string: "Гра дуже крута мені нравится що можна грати на серверах гра дуже крута а якщо зайти на ноутбук то вобще отвал божки мені нравится що якщо приручити во…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiFmDR_D3agcilAMWtUTkoRblEKM9OrJ65_p8I7=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiFmDR_D3agcilAMWtUTkoRblEKM9OrJ65_p8I7=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiFmDR_D3agcilAMWtUTkoRblEKM9OrJ65_p8I7=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645336398 {
        date: 2022-02-20T05:53:18+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
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
