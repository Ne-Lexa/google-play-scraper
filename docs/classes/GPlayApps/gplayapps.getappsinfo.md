# Nelexa\GPlay\GPlayApps::getAppsInfo
`Nelexa\GPlay\GPlayApps::getAppsInfo` — Returns the full detail of multiple applications.

## Description
```php
Nelexa\GPlay\GPlayApps::getAppsInfo ( string[] | Nelexa\GPlay\Model\AppId[] $appIds ) : Nelexa\GPlay\Model\AppInfo[]
```
The keys of the returned array matches to the passed array.
HTTP requests are executed in parallel.

## Parameters
* **$appIds** (string[] | [Nelexa\GPlay\Model\AppId](../AppId/README.md)[])  
array of application ids

## Return Values
an array of detailed information for each application


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
```php
$gplay->setConcurrency(10);

$apps = $gplay->getAppsInfo(
    [
        'chrome' => 'com.android.chrome',
        'minecraft' => new \Nelexa\GPlay\Model\AppId('com.mojang.minecraftpe', 'pt_BR', 'br'),
    ]
);
```
<details>
  <summary>Results</summary>

```php
array:2 [
    "chrome" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "com.android.chrome"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&hl=en_US&gl=us"
      -getName(): string: "Google Chrome: Fast & Secure"
      -getSummary(): ?string: "Fast, simple, and secure. Google Chrome browser for Android phones and tablets."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: "http://www.google.com/chrome/android"
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: "apps-help@google.com"
        -getAddress(): ?string: "1600 Amphitheatre Parkway, Mountain View 94043"
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
      }
      -getScore(): float: 4.370738
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -jsonSerialize(): mixed: …
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
      }
      -getScreenshots(): array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/MDUDkVeS3rAZ-CeNSAlMM94iQAxCJbthTNK7675leCrIQ3cZ5uVAxrXRRsqanJUHog"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/MDUDkVeS3rAZ-CeNSAlMM94iQAxCJbthTNK7675leCrIQ3cZ5uVAxrXRRsqanJUHog=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/MDUDkVeS3rAZ-CeNSAlMM94iQAxCJbthTNK7675leCrIQ3cZ5uVAxrXRRsqanJUHog"
        }
        …
      ]
      -getCategory(): Nelexa\GPlay\Model\Category: {
        -getId(): string: "COMMUNICATION"
        -getName(): string: "Communication"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: "Thanks for choosing Chrome! This release includes stability and performance improvements."
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 6090507724
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 13585003
        -getFourStars(): int: 2314160
        -getThreeStars(): int: 1114345
        -getTwoStars(): int: 545061
        -getOneStar(): int: 1445057
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: false
      -getSize(): ?string: null
      -getAppVersion(): ?string: null
      -getAndroidVersion(): ?string: null
      -getMinAndroidVersion(): ?string: null
      -getContentRating(): ?string: "Everyone"
      -getPrivacyPoliceUrl(): ?string: "http://www.google.com/chrome/intl/en/privacy.html"
      -getReleased(): ?DateTimeInterface: @1328572800 {
        date: 2012-02-07T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1581455005 {
        date: 2020-02-11T21:03:25+00:00
      }
      -getNumberVoters(): int: 19003628
      -getNumberReviews(): int: 5552461
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOEsmqp5FTgADw-dLlv2Rgdhnr5-aE2Ssv5yUNA55w6xFinXuBYTuUSfyEgpxxUfrRDAiYlEMrPDNyAIXl0"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOEsmqp5FTgADw-dLlv2Rgdhnr5-aE2Ssv5yUNA55w6xFinXuBYTuUSfyEgpxxUfrRD…"
          -getUserName(): string: "Yanaica Reinink"
          -getText(): string: "This app always worked fine but recently it's been having trouble on my device. I even had to switch to a different browser. Chrome won't load my page…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAlgN8IWBo27FAuQv8WTTT4mnEZyzPK5_n6s1wz=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAlgN8IWBo27FAuQv8WTTT4mnEZyzPK5_n6s1wz=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAlgN8IWBo27FAuQv8WTTT4mnEZyzPK5_n6s1wz=s64"
          }
          -getDate(): ?DateTimeInterface: @1581446345 {
            date: 2020-02-11T18:39:05+00:00
          }
          -getScore(): int: 2
          -getCountLikes(): int: 114
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
            -getDate(): DateTimeInterface: @1581447931 {
              date: 2020-02-11T19:05:31+00:00
            }
            -getText(): string: "Hey Yanaica. Let's try resetting Chrome's app data. You can learn how in this help center article under the "Clear the app's cache" section: https://g…"
            -asArray(): array: …
            -jsonSerialize(): mixed: …
          }
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOE0uqCbq9NlXoyjCfnu0l5nRRKybZ0-hwT1T_RpJs7GlxyjtBtvVcL7yJbhY7RilHeMYfUya4gWM6xe0Tw"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOE0uqCbq9NlXoyjCfnu0l5nRRKybZ0-hwT1T_RpJs7GlxyjtBtvVcL7yJbhY7RilHe…"
          -getUserName(): string: "Queen Lie"
          -getText(): string: "Everyone can visit: ( BrowserGood. Com ) to install the best browser app. It's adblock and faster. Everytime I have chrome, and its not by choice, onl…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mADpm9XahajGfNYJRiRpG4lA6F_EU_Mri54vV-Q=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mADpm9XahajGfNYJRiRpG4lA6F_EU_Mri54vV-Q=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mADpm9XahajGfNYJRiRpG4lA6F_EU_Mri54vV-Q=s64"
          }
          -getDate(): ?DateTimeInterface: @1581353069 {
            date: 2020-02-10T16:44:29+00:00
          }
          -getScore(): int: 2
          -getCountLikes(): int: 77
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        …
      ]
      -asArray(): array: …
    }
    "minecraft" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "com.mojang.minecraftpe"
      -getLocale(): string: "pt_BR"
      -getCountry(): string: "br"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&hl=pt_BR&gl=br"
      -getName(): string: "Minecraft"
      -getSummary(): ?string: "Minecraft é um jogo sobre blocos e aventuras!"
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
      -getScore(): float: 4.4578714
      -getPriceText(): ?string: "R$ 19,99"
      -isFree(): bool: false
      -jsonSerialize(): mixed: …
      -getDescription(): string: """
        Explore mundos infinitos e construa desde simples casas a grandiosos castelos. Jogue no modo criativo com recursos ilimitados ou minere fundo no mundo…
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
          -getUrl(): string: "https://lh3.googleusercontent.com/FCSsEdBLAlFANDRAj8N7Azn_zffiK2Qf6FtlTLXRrfTRT7_Zzz4Ys2239WRXm78ZNQ"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/FCSsEdBLAlFANDRAj8N7Azn_zffiK2Qf6FtlTLXRrfTRT7_Zzz4Ys2239WRXm78ZNQ=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/FCSsEdBLAlFANDRAj8N7Azn_zffiK2Qf6FtlTLXRrfTRT7_Zzz4Ys2239WRXm78ZNQ"
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/FLM1WbKTa8zW98zrGUQp0ZHWDGLbZRLjIpsqXrd9oFFTIFFPZOlIYbGtH0C305xxXcc"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/FLM1WbKTa8zW98zrGUQp0ZHWDGLbZRLjIpsqXrd9oFFTIFFPZOlIYbGtH0C305xxXcc=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/FLM1WbKTa8zW98zrGUQp0ZHWDGLbZRLjIpsqXrd9oFFTIFFPZOlIYbGtH0C305xxXcc"
        }
        …
      ]
      -getCategory(): Nelexa\GPlay\Model\Category: {
        -getId(): string: "GAME_ARCADE"
        -getName(): string: "Arcade"
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
        Novidades na versão 1.14.30:\n
        Correção de diversos erros
        """
      -isEditorsChoice(): bool: true
      -getInstalls(): int: 27323886
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 2405991
        -getFourStars(): int: 246493
        -getThreeStars(): int: 118772
        -getTwoStars(): int: 65780
        -getOneStar(): int: 247742
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getPrice(): float: 19.99
      -getCurrency(): string: "BRL"
      -isContainsIAP(): bool: true
      -getOffersIAPCost(): ?string: "R$ 1,33 – R$ 179,99 por item"
      -isContainsAds(): bool: false
      -getSize(): ?string: null
      -getAppVersion(): ?string: "1.14.30.2"
      -getAndroidVersion(): ?string: "4.2 ou superior"
      -getMinAndroidVersion(): ?string: "4.2"
      -getContentRating(): ?string: "Classificação Livre"
      -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
      -getReleased(): ?DateTimeInterface: @1313366400 {
        date: 2011-08-15T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1581031098 {
        date: 2020-02-06T23:18:18+00:00
      }
      -getNumberVoters(): int: 3084780
      -getNumberReviews(): int: 1595838
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHXInX9_Y5AfQjP7N1nb71L_VaOG9CKzF3gtEefqCVZYvTocYmp5mVge3QHh0-QrIpuEj4lIzSpR1iwz5U"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHXInX9_Y5AfQjP7N1nb71L_VaOG9CKzF3gtEefqCVZYvTocYmp5mVge3QHh0-…"
          -getUserName(): string: "rafa fabi"
          -getText(): string: "muito decepcionante pagar pelo jogo e mesmo assim deparar-se com problemas de jogabilidade. jogar online em endereços diferentes é praticamente imposs…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAU5Be_53SOaVPuVirDHDE6iTyK0vCefsgK-VVUjA=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAU5Be_53SOaVPuVirDHDE6iTyK0vCefsgK-VVUjA=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAU5Be_53SOaVPuVirDHDE6iTyK0vCefsgK-VVUjA=s64"
          }
          -getDate(): ?DateTimeInterface: @1581385130 {
            date: 2020-02-11T01:38:50+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 64
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGccABYmTwtROuk6toEz8s3tkbKyeF_xnN56glRuELrr0bWvBi0m71So26rs3w3ji5degaHBw5V2mAmYFI"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOGccABYmTwtROuk6toEz8s3tkbKyeF_xnN56glRuELrr0bWvBi0m71So26rs3w…"
          -getUserName(): string: "Andressa Santos"
          -getText(): string: "Depois da última atualização, Não consigo conectar ao jogo/mundo multiplayer. Há erros na conexão por servidor e também não consigo conectar ao multip…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAtL3gJ8zGBmOeb6FGh7myKTfSlMEonTm9d2fko4g=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAtL3gJ8zGBmOeb6FGh7myKTfSlMEonTm9d2fko4g=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAtL3gJ8zGBmOeb6FGh7myKTfSlMEonTm9d2fko4g=s64"
          }
          -getDate(): ?DateTimeInterface: @1580688212 {
            date: 2020-02-03T00:03:32+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 626
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        …
      ]
      -asArray(): array: …
    }
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.
