[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppsInfo**

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

$apps = $gplay->getAppsInfo([
    'chrome' => 'com.android.chrome',
    'minecraft' => new \Nelexa\GPlay\Model\AppId('com.mojang.minecraftpe', 'pt_BR', 'br'),
]);
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
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:14 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/zNteEAWnOwZ9rSewvLziSgcK-jApPMf3SouV8e0aaDpSq71IKa82_PSguI63CWEjV2M"
          -getUrl(): string: "https://play-lh.googleusercontent.com/zNteEAWnOwZ9rSewvLziSgcK-jApPMf3SouV8e0aaDpSq71IKa82_PSguI63CWEjV2M"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/zNteEAWnOwZ9rSewvLziSgcK-jApPMf3SouV8e0aaDpSq71IKa82_PSguI63CWEjV2M=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/lMbdwtu9mb66J9xRxxYH9vtobiZl_cnGfnHhguDkKb9LxJQUAS_UtaYzI8K0NS5QftE"
          -getUrl(): string: "https://play-lh.googleusercontent.com/lMbdwtu9mb66J9xRxxYH9vtobiZl_cnGfnHhguDkKb9LxJQUAS_UtaYzI8K0NS5QftE"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/lMbdwtu9mb66J9xRxxYH9vtobiZl_cnGfnHhguDkKb9LxJQUAS_UtaYzI8K0NS5QftE=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.1628103
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10,000,000,000+"
      -jsonSerialize(): array: …
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
        -jsonSerialize(): array: …
      }
      -getDeveloperName(): mixed: "Google LLC"
      -getSummary(): string: "Fast, simple, and secure. Google Chrome browser for Android phones and tablets."
      -getTranslatedFromLocale(): mixed: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
      }
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "COMMUNICATION"
        -getName(): string: "Communication"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: "Thanks for choosing Chrome! This release includes stability and performance improvements."
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 11148872337
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 4486994
        -getFourStars(): int: 1503208
        -getThreeStars(): int: 2579594
        -getTwoStars(): int: 4886732
        -getOneStar(): int: 25368105
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: false
      -getSize(): mixed: null
      -getAppVersion(): ?string: null
      -getAndroidVersion(): ?string: null
      -getMinAndroidVersion(): ?string: null
      -getContentRating(): ?string: ""
      -getPrivacyPoliceUrl(): ?string: "http://www.google.com/chrome/intl/en/privacy.html"
      -getReleased(): ?DateTimeInterface: @1328634643 {
        date: 2012-02-07T17:10:43+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1654187450 {
        date: 2022-06-02T16:30:50+00:00
      }
      -getNumberVoters(): int: 38824672
      -getNumberReviews(): int: 893737
      -getReviews(): array: array:40 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOH14rB-VncCI2jhw2kiT_MV5g5daUbNGTak6dySlV-wGAUL_1M-DW0K7f_Es0OEXYFOc0-SKBSWxnHsCXU"
          -getUrl(): mixed: ""
          -getUserName(): string: "Kendra McCool"
          -getText(): string: "The app has been malfunctioning. It's been making my other apps crash or lag, and has been giving me random pop ups. I tried restarting my phone, upda…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgjDGLMmRMznkH9h8I95v0MQ3bDUqneFlaPYOJKdA=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgjDGLMmRMznkH9h8I95v0MQ3bDUqneFlaPYOJKdA=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgjDGLMmRMznkH9h8I95v0MQ3bDUqneFlaPYOJKdA=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1652244609 {
            date: 2022-05-11T04:50:09+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 10149
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "101.0.4951.61"
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOEuvMfRNC2Zh0nA7FKeni28xcoEtoo_K872GaUrKT4UbB9To2n4ThTYyN6WZ4EcuS0Y3MqC18sKVmOv2RQ"
          -getUrl(): mixed: ""
          -getUserName(): string: "Ryan Volkert"
          -getText(): string: "A bug has recently been introduced to Chrome, namely that every time I try to change the "parent folder" when creating a new bookmark folder, Chrome i…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJyNLTx3fuRcFPRBucyduDRTDXitSxochqkvut5q=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJyNLTx3fuRcFPRBucyduDRTDXitSxochqkvut5q=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJyNLTx3fuRcFPRBucyduDRTDXitSxochqkvut5q=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1654346625 {
            date: 2022-06-04T12:43:45+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 353
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "102.0.5005.78"
          -asArray(): array: …
          -jsonSerialize(): array: …
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
      -getDescription(): string: """
        Explore mundos infinitos e construa desde simples casas a grandiosos castelos. Jogue no modo criativo com recursos ilimitados ou minere fundo no mundo…
        """
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
        -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:12 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/kwKiFARq0lUM_PrvxnOitjx_oh_0Z1_foxUU2AVttbj1Xiev7EbgPrYuWauvc0N9t4E"
          -getUrl(): string: "https://play-lh.googleusercontent.com/kwKiFARq0lUM_PrvxnOitjx_oh_0Z1_foxUU2AVttbj1Xiev7EbgPrYuWauvc0N9t4E"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/kwKiFARq0lUM_PrvxnOitjx_oh_0Z1_foxUU2AVttbj1Xiev7EbgPrYuWauvc0N9t4E=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/f00u4e1QwQGhdNLymA-_7LwQGRmX7a4kcTeMbLRFcRSWDQOeNAcLQcQByzcFnPdX8_Y"
          -getUrl(): string: "https://play-lh.googleusercontent.com/f00u4e1QwQGhdNLymA-_7LwQGRmX7a4kcTeMbLRFcRSWDQOeNAcLQcQByzcFnPdX8_Y"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/f00u4e1QwQGhdNLymA-_7LwQGRmX7a4kcTeMbLRFcRSWDQOeNAcLQcQByzcFnPdX8_Y=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.636201
      -getPriceText(): ?string: "R$ 37,99"
      -isFree(): bool: false
      -getInstallsText(): string: "10.000.000+"
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
      -getSummary(): string: "Minecraft é um jogo sobre blocos e aventuras!"
      -getTranslatedFromLocale(): mixed: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
        -getBinaryImageContent(): string: …
      }
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "GAME_ARCADE"
        -getName(): string: "Arcade"
        -isGamesCategory(): bool: true
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: false
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "GAME_SIMULATION"
        -getName(): string: "Simulação"
        -isGamesCategory(): bool: true
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: false
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: """
        Novidades na versão 1.18.32:\n
        Correção de diversos erros
        """
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 42698734
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 237088
        -getFourStars(): int: 66225
        -getThreeStars(): int: 124403
        -getTwoStars(): int: 278526
        -getOneStar(): int: 3896259
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 37.99
      -getCurrency(): string: "BRL"
      -isContainsIAP(): bool: true
      -getOffersIAPCost(): ?string: "R$ 1,33 – R$ 179,99 por item"
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
      -getNumberVoters(): int: 4602522
      -getNumberReviews(): int: 283192
      -getReviews(): array: array:40 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGvo6tKp6yEY1gfAc--RizRY6u3QcIrPeD6WZxqPoat6eJuoODGEQmBjUBHDHbRtd-QB3oLhMs2kwTMQjA"
          -getUrl(): mixed: ""
          -getUserName(): string: "Brayan Buchmann"
          -getText(): string: "O que eu preciso dizer‽ O jogo é perfeito, e obviamente muitos conhecem, então eu nem preciso elogiá-lo ou descrevê-lo, mas gostaria de reportar um pr…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgvklYmVLcaeGXC6_CBXCHv87FVk_3nYrxIUBRK=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgvklYmVLcaeGXC6_CBXCHv87FVk_3nYrxIUBRK=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgvklYmVLcaeGXC6_CBXCHv87FVk_3nYrxIUBRK=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1654227404 {
            date: 2022-06-03T03:36:44+00:00
          }
          -getScore(): int: 5
          -getCountLikes(): int: 1253
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "1.18.32.02"
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOF1lO4-Jkss_lvWCdbhk444TR36w02v5hcnQfhqHsI3knOm031R33ex7tKq6BftxwhwZ08Zd0lRQUlI85U"
          -getUrl(): mixed: ""
          -getUserName(): string: "Kobayashii"
          -getText(): string: "Mine é uns dos meus jogos favoritos, o jogo é simplesmente perfeito! Só acho que deveria ter controles melhores na tela, eu acho muito difícil jogar d…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW-9lDuXjNL3fy8cwDIiG1KB-OpEFnMwl7ap73=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW-9lDuXjNL3fy8cwDIiG1KB-OpEFnMwl7ap73=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW-9lDuXjNL3fy8cwDIiG1KB-OpEFnMwl7ap73=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1653207630 {
            date: 2022-05-22T08:20:30+00:00
          }
          -getScore(): int: 3
          -getCountLikes(): int: 4911
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "1.18.32.02"
          -asArray(): array: …
          -jsonSerialize(): array: …
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

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppsInfo**
