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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.126106
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
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
      -getInstalls(): int: 10546228660
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 23719921
        -getFourStars(): int: 4688358
        -getThreeStars(): int: 2543567
        -getTwoStars(): int: 1510499
        -getOneStar(): int: 4498126
        -asArray(): array: …
        -jsonSerialize(): array: …
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
      -getUpdated(): ?DateTimeInterface: @1645554664 {
        date: 2022-02-22T18:31:04+00:00
      }
      -getNumberVoters(): int: 36960498
      -getNumberReviews(): int: 864115
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy3rKUvr5Xxj3NmgIk"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy…"
          -getUserName(): string: "Two Fisted Betty"
          -getText(): string: "Have been a VERY long time user and absolutely love Google and everything it has to offer. It's had it's glitches but all software has it's issues fro…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645673394 {
            date: 2022-02-24T03:29:54+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJgdGRhoG205Y_Dw-s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJ…"
          -getUserName(): string: "Renae"
          -getText(): string: "I typically have no issues with the app, but this update seems to have broken it (though it was fine at first). For a few days now whenever I try to u…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1644211105 {
            date: 2022-02-07T05:18:25+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 1655
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
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
      -getSummary(): ?string: "Minecraft é um jogo sobre blocos e aventuras!"
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
      -getScore(): float: 4.5828166
      -getPriceText(): ?string: "R$ 37,99"
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Explore mundos infinitos e construa desde simples casas a grandiosos castelos. Jogue no modo criativo com recursos ilimitados ou minere fundo no mundo…
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
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "GAME_ARCADE"
        -getName(): string: "Arcade"
        -isGamesCategory(): bool: true
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: false
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: {
        -getImageUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getVideoUrl(): string: "https://www.youtube.com/embed/6Aaw7LzNQ88?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
        -getYoutubeId(): ?string: "6Aaw7LzNQ88"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getRecentChanges(): ?string: """
        Novidades na versão 1.18.12:\n
        Correção de diversos erros
        """
      -isEditorsChoice(): bool: true
      -getInstalls(): int: 40328325
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 3696870
        -getFourStars(): int: 312998
        -getThreeStars(): int: 142202
        -getTwoStars(): int: 79491
        -getOneStar(): int: 259418
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 37.99
      -getCurrency(): string: "BRL"
      -isContainsIAP(): bool: true
      -getOffersIAPCost(): ?string: "R$ 1,33 – R$ 179,99 por item"
      -isContainsAds(): bool: false
      -getSize(): ?string: null
      -getAppVersion(): ?string: "1.18.12.01"
      -getAndroidVersion(): ?string: "5.0 ou superior"
      -getMinAndroidVersion(): ?string: "5.0"
      -getContentRating(): ?string: "Classificação Livre"
      -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
      -getReleased(): ?DateTimeInterface: @1313366400 {
        date: 2011-08-15T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1644890219 {
        date: 2022-02-15T01:56:59+00:00
      }
      -getNumberVoters(): int: 4490990
      -getNumberReviews(): int: 269309
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOFKhld3M6sJbWYOeQP_nhptO-nRWsDd5w0iB71Nk3j9bqKthoKytIojqnZz2VZIiApD4NE2o_jTCSfwXQg"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOFKhld3M6sJbWYOeQP_nhptO-nRWsDd5w0iB71Nk3j9bqKthoKytIojqnZz2VZ…"
          -getUserName(): string: "Renald Lopes"
          -getText(): string: "Desenvolvedores incompetentes, conseguiram acabar com o jogo nessa atualização. Não renderiza, itens não dropam, mobs invisíveis, jogador não leva dan…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgcBwx1jdNjdC_cEXDJUFIKxV0skPiSzC3rmB8C=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgcBwx1jdNjdC_cEXDJUFIKxV0skPiSzC3rmB8C=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgcBwx1jdNjdC_cEXDJUFIKxV0skPiSzC3rmB8C=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645796796 {
            date: 2022-02-25T13:46:36+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGXWLBwfd5PTa_Tnp59qHst2-sOsTd2KaZGz-2AVfIaDeYJ0UT10DsD79wMM36U7qj8nMJ2yvMj7fHjhK0"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOGXWLBwfd5PTa_Tnp59qHst2-sOsTd2KaZGz-2AVfIaDeYJ0UT10DsD79wMM36…"
          -getUserName(): string: "Maria Eduarda"
          -getText(): string: "Não tenho oque falar desse jogo,gráficos excelentes, não trava quase nunca! Esse app apesar do preço, vale muito a pena, comprei ele e não me arrepend…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjKPq_b1nks0ltQrgqHBuu5yssEYH3gbcWTrgccHQ=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjKPq_b1nks0ltQrgqHBuu5yssEYH3gbcWTrgccHQ=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjKPq_b1nks0ltQrgqHBuu5yssEYH3gbcWTrgccHQ=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645526625 {
            date: 2022-02-22T10:43:45+00:00
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
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppsInfo**
