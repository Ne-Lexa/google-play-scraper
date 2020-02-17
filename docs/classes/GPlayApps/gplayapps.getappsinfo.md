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
      -getScore(): float: 4.371647
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
      -getRecentChanges(): ?string: """
        Thanks for choosing Chrome! This release contains the following features, as well as stability and performance improvements: \n
        \n
        • Quieter notifications…
        """
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 6109119447
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 13653105
        -getFourStars(): int: 2319179
        -getThreeStars(): int: 1115216
        -getTwoStars(): int: 545239
        -getOneStar(): int: 1451591
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
      -getUpdated(): ?DateTimeInterface: @1581622298 {
        date: 2020-02-13T19:31:38+00:00
      }
      -getNumberVoters(): int: 19084332
      -getNumberReviews(): int: 5581111
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOH7DSH2OtYI4XCeZEW_qyYJZdFxrXyE-m3mIW0PxSnL_RwuM0xWp_5PJjCJK-4a2cZAUppOOGWOIwdUCDs"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOH7DSH2OtYI4XCeZEW_qyYJZdFxrXyE-m3mIW0PxSnL_RwuM0xWp_5PJjCJK-4a2cZ…"
          -getUserName(): string: "Stephen"
          -getText(): string: "I thought it was just me (or my device - Samsung S10 tablet), but I see that many users are having crash problems with Chrome. I tried all of the fixe…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAA8Z3E9Dydz7VARV9gbzkRw6SIxFfwT97_QRLg=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAA8Z3E9Dydz7VARV9gbzkRw6SIxFfwT97_QRLg=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAA8Z3E9Dydz7VARV9gbzkRw6SIxFfwT97_QRLg=s64"
          }
          -getDate(): ?DateTimeInterface: @1581778840 {
            date: 2020-02-15T15:00:40+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 260
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHJIhcmfbAZksVWe5j-AnsnH7Dy3A6ghft6M9Hh_ojJtgMvqpx5hSH5F9Wkg_88bkqoOZRUoC6qm4OXv7g"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOHJIhcmfbAZksVWe5j-AnsnH7Dy3A6ghft6M9Hh_ojJtgMvqpx5hSH5F9Wkg_88bkq…"
          -getUserName(): string: "Janae Ask"
          -getText(): string: "I've been a diehard chrome fan for years but I noticed today that my app updated and my home page button disappeared. I'm super annoyed and honestly I…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCTnjMGOtddUmBD8ley9nDfJxi_hPPlQFYFNimY=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCTnjMGOtddUmBD8ley9nDfJxi_hPPlQFYFNimY=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCTnjMGOtddUmBD8ley9nDfJxi_hPPlQFYFNimY=s64"
          }
          -getDate(): ?DateTimeInterface: @1581740061 {
            date: 2020-02-15T04:14:21+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 24
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
      -getScore(): float: 4.4607687
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
      -getInstalls(): int: 27372757
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 2414732
        -getFourStars(): int: 246521
        -getThreeStars(): int: 118459
        -getTwoStars(): int: 65428
        -getOneStar(): int: 246900
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
      -getNumberVoters(): int: 3092042
      -getNumberReviews(): int: 1599717
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOF9xom9V10RMHeOT7ZOg-0lZggY1fvhp7rXdiCJROaDn93a3sH1Uo6ECUCH907-Z0Sy81qsEF8wrxGrA-s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOF9xom9V10RMHeOT7ZOg-0lZggY1fvhp7rXdiCJROaDn93a3sH1Uo6ECUCH907…"
          -getUserName(): string: "Um usuário do Google"
          -getText(): string: "Toda vez que eu abro o jogo após a nova atualização o jogo não abre, apenas da tela preta, e fecha, dei uma olhada em outras resenhas e vi outras pess…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64"
          }
          -getDate(): ?DateTimeInterface: @1580406646 {
            date: 2020-01-30T17:50:46+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 1000
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOE9rwGIAQ6BEXIsbLzZEWSiEuWog_l5UnOFfDAvzsv2drkIGtMuZvGhjgqOABrBtRtGXHzr0Jq5_k2GI1s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOE9rwGIAQ6BEXIsbLzZEWSiEuWog_l5UnOFfDAvzsv2drkIGtMuZvGhjgqOABr…"
          -getUserName(): string: "Iralo `"
          -getText(): string: "O jogo é excelente, super criativo e divertido. Não consigo entrar em um dos servidores ( Mineville City ) desde que comprei o jogo. Tudo o que aconte…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mApSsq3soGQoKLTguLGtUT6Ts1m4Bt1LgDK_YDMvg=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mApSsq3soGQoKLTguLGtUT6Ts1m4Bt1LgDK_YDMvg=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mApSsq3soGQoKLTguLGtUT6Ts1m4Bt1LgDK_YDMvg=s64"
          }
          -getDate(): ?DateTimeInterface: @1581090202 {
            date: 2020-02-07T15:43:22+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 440
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

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppsInfo**
