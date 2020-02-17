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
    -getId(): string: "Mojang"
    -getUrl(): string: "https://play.google.com/store/apps/developer?id=Mojang"
    -getName(): string: "Mojang"
    -getDescription(): ?string: null
    -getWebsite(): ?string: "http://help.mojang.com"
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: "android-help@mojang.com"
    -getAddress(): ?string: """
      Mojang\n
      Maria Skolgata 83\n
      118 53\n
      Stockholm\n
      Sweden
      """
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
  }
  -getScore(): float: 4.4607687
  -getPriceText(): ?string: "123,50 грн."
  -isFree(): bool: false
  -jsonSerialize(): mixed: …
  -getDescription(): string: """
    Досліджуйте безкінечні світи та будуйте що завгодно: від простих хижок до розкішних замків. Грайте у творчому режимі з необмеженими ресурсами або вибе…
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
  }
  -getScreenshots(): array:8 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/Gfor63rEjzuN5gLTd4CjFV5O9T9YF5IVrRrmimqJm2Tct0GSnagoFOHPFpE3Ter7JA"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Gfor63rEjzuN5gLTd4CjFV5O9T9YF5IVrRrmimqJm2Tct0GSnagoFOHPFpE3Ter7JA=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/Gfor63rEjzuN5gLTd4CjFV5O9T9YF5IVrRrmimqJm2Tct0GSnagoFOHPFpE3Ter7JA"
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/Qre0-8iRhd7iu2AV4GqofQFU1QiKCvET752u32VjZHmMvlo_8W5JX07qAKavcpmis7Zk"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Qre0-8iRhd7iu2AV4GqofQFU1QiKCvET752u32VjZHmMvlo_8W5JX07qAKavcpmis7Zk=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/Qre0-8iRhd7iu2AV4GqofQFU1QiKCvET752u32VjZHmMvlo_8W5JX07qAKavcpmis7Zk"
    }
    …
  ]
  -getCategory(): Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_ARCADE"
    -getName(): string: "Аркади"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: {
    -getImageUrl(): string: "https://i.ytimg.com/vi/5nWMr2njHiA/hqdefault.jpg"
    -getVideoUrl(): string: "https://www.youtube.com/embed/5nWMr2njHiA?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    -getYoutubeId(): ?string: "5nWMr2njHiA"
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getRecentChanges(): ?string: """
    Що нового в 1.14.30:\n
    Різні виправлення помилок
    """
  -isEditorsChoice(): bool: true
  -getInstalls(): int: 27372757
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 2414726
    -getFourStars(): int: 246520
    -getThreeStars(): int: 118458
    -getTwoStars(): int: 65428
    -getOneStar(): int: 246899
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getPrice(): float: 123.5
  -getCurrency(): string: "UAH"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "9,36 грн. – 1 349,99 грн. за продукт"
  -isContainsAds(): bool: false
  -getSize(): ?string: null
  -getAppVersion(): ?string: "1.14.30.2"
  -getAndroidVersion(): ?string: "4.2 і новіших версій"
  -getMinAndroidVersion(): ?string: "4.2"
  -getContentRating(): ?string: "Від 7 років"
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313366400 {
    date: 2011-08-15T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1581031098 {
    date: 2020-02-06T23:18:18+00:00
  }
  -getNumberVoters(): int: 3092034
  -getNumberReviews(): int: 1599715
  -getReviews(): array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOEk-B-eP-WonMwF1mJJ5ki7W8GFSWJ764ctKyedW8kgZod2Th98ipVnpUGm7Bgew1mJ8rH-3ncav6WVcxE"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOEk-B-eP-WonMwF1mJJ5ki7W8GFSWJ764ctKyedW8kgZod2Th98ipVnpUGm7Bg…"
      -getUserName(): string: "IllyaBoy"
      -getText(): string: "Дуже класно! Але я хочу вам допомогти з обновленням. Добавити мавп, акул, ще щоб жителі розмовляли. Також різні вулики з бджолами! Дякую що прочитали."
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBivXPbfbLUOmfqIBwXodG2aMfqfdhNhoQVro2_mQ=s64"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBivXPbfbLUOmfqIBwXodG2aMfqfdhNhoQVro2_mQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBivXPbfbLUOmfqIBwXodG2aMfqfdhNhoQVro2_mQ=s64"
      }
      -getDate(): ?DateTimeInterface: @1568365109 {
        date: 2019-09-13T08:58:29+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 10084
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHFoqm_MOzJ5wqmPTpcIR_5A7-EYFOXSOaL70oN32z6HhNDpMHIUrqA4nG_p3QhA0tfb6DSW67Mjdd4Qqs"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHFoqm_MOzJ5wqmPTpcIR_5A7-EYFOXSOaL70oN32z6HhNDpMHIUrqA4nG_p3Q…"
      -getUserName(): string: "Вова Сапсан"
      -getText(): string: "Я купив Minecraft с початку була версія 1.14.1 а потім стала версія 1.12.1 іяк це зрозуміти? ПОВЕРНІТЬ ГРОШІ! ЧЕКАЮ 29 ВЕРЕСНЯ О 12:00 2019 РОКУ"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-EBQ9JSu3bPI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcgqq6wcx3NjHMQXsn2pL7yE1PVCA/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-EBQ9JSu3bPI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcgqq6wcx3NjHMQXsn2pL7yE1PVCA/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-EBQ9JSu3bPI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcgqq6wcx3NjHMQXsn2pL7yE1PVCA/s64/"
      }
      -getDate(): ?DateTimeInterface: @1569700945 {
        date: 2019-09-28T20:02:25+00:00
      }
      -getScore(): int: 1
      -getCountLikes(): int: 4316
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
  -asArray(): array: …
}
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfo**
