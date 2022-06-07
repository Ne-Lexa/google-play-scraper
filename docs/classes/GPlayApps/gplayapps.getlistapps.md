[Documentation](../../README.md) > [GPlayApps](README.md) > **getListApps**

# Nelexa\GPlay\GPlayApps::getListApps
`Nelexa\GPlay\GPlayApps::getListApps` — Returns an array of applications from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getListApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
```
[Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) or
`null` for all categories

## Parameters
* **$category** (string | [Nelexa\GPlay\Model\Category](../Category/README.md) | [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) | null)  
application category as
string, [Nelexa\GPlay\Model\Category](../Category/README.md),
* **$age** ([Nelexa\GPlay\Enum\AgeEnum](../AgeEnum/README.md) | null)  
age limit or null for no limit
* **$limit** (int)  
limit on the number of results
or [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants)
for no limit

## Return Values
an array of applications with basic information


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md)
## Examples
**Example 1. Gets apps by category.**
```php
$apps = $gplay->getListApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:1286 [
    "com.ea.game.nfs14_row" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.game.nfs14_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row&hl=en_US&gl=us"
      -getName(): string: "Need for Speed™ No Limits"
      -getDescription(): string: """
        Claim the crown and rule the underground as you race for dominance in the first white-knuckle edition of Need for Speed made just for mobile – from th…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "ELECTRONIC ARTS"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:12 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3578167
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.skgames.trafficrider" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.skgames.trafficrider"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.skgames.trafficrider"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.skgames.trafficrider&hl=en_US&gl=us"
      -getName(): string: "Traffic Rider"
      -getDescription(): string: """
        Another masterpiece from the creators of Traffic Racer. This time, you are behind the wheels of a motorbike in a much more detailed gaming experience,…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Soner Kara"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/590AflDt-hW2t85Cit_ODJPJdRiMMRn2cSF0vYNfsBpjm895x1zDy0npbD7IlDCvmNvI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/590AflDt-hW2t85Cit_ODJPJdRiMMRn2cSF0vYNfsBpjm895x1zDy0npbD7IlDCvmNvI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/590AflDt-hW2t85Cit_ODJPJdRiMMRn2cSF0vYNfsBpjm895x1zDy0npbD7IlDCvmNvI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/9r6683uXT-9FUsHDxEewq7rjWGJM4si0wVHUPWV3qk334V50PscxGXhCJ3P8BTAWObk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/9r6683uXT-9FUsHDxEewq7rjWGJM4si0wVHUPWV3qk334V50PscxGXhCJ3P8BTAWObk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/9r6683uXT-9FUsHDxEewq7rjWGJM4si0wVHUPWV3qk334V50PscxGXhCJ3P8BTAWObk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/IQB8k1MwuRpuo3Ns9k77nXxOasPhSmHMCVhL7zEfL0iWBbzS5fQ4Byx8bwJsQM0aDfYC"
          -getUrl(): string: "https://play-lh.googleusercontent.com/IQB8k1MwuRpuo3Ns9k77nXxOasPhSmHMCVhL7zEfL0iWBbzS5fQ4Byx8bwJsQM0aDfYC"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/IQB8k1MwuRpuo3Ns9k77nXxOasPhSmHMCVhL7zEfL0iWBbzS5fQ4Byx8bwJsQM0aDfYC=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.2793527
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from the FAMILY_ACTION category with an age limit of 6-8 years.**
```php
$apps = $gplay->getListApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::FAMILY_ACTION(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = 100
);
```
<details>
  <summary>Results</summary>

```php
array:100 [
    "com.imayi.trainbuilderfree" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.imayi.trainbuilderfree"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.trainbuilderfree"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.trainbuilderfree&hl=en_US&gl=us"
      -getName(): string: "Train Builder - Games for kids"
      -getDescription(): string: """
        Assemble your own unique train! Experience the fun of driving! Pick up fruits from the farm, get your favorite animals from the zoo, and don’t forget …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Yateland - Learning Games For Kids"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/HHmaZwsT0_KhM1NZguKUJaBWQ6ycEaMF_UIi3omN2LhKxLB9EUlyOPlKg6XiHa6zmQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/HHmaZwsT0_KhM1NZguKUJaBWQ6ycEaMF_UIi3omN2LhKxLB9EUlyOPlKg6XiHa6zmQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/HHmaZwsT0_KhM1NZguKUJaBWQ6ycEaMF_UIi3omN2LhKxLB9EUlyOPlKg6XiHa6zmQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/pXWq7snZUlu0_NUY6IxmWANpkSX_7wVs43iM_XP0m0auX3GqqjF-vvph5QjqkjME_vYc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/pXWq7snZUlu0_NUY6IxmWANpkSX_7wVs43iM_XP0m0auX3GqqjF-vvph5QjqkjME_vYc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/pXWq7snZUlu0_NUY6IxmWANpkSX_7wVs43iM_XP0m0auX3GqqjF-vvph5QjqkjME_vYc=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/3Cx1GAaFpVxww1qTyGz7nYnqEmrkcAcBbLKNSRzkSa0zOEgCpSLEDsxHLL_d6MLF3m0i"
          -getUrl(): string: "https://play-lh.googleusercontent.com/3Cx1GAaFpVxww1qTyGz7nYnqEmrkcAcBbLKNSRzkSa0zOEgCpSLEDsxHLL_d6MLF3m0i"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3Cx1GAaFpVxww1qTyGz7nYnqEmrkcAcBbLKNSRzkSa0zOEgCpSLEDsxHLL_d6MLF3m0i=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.18
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.imayi.monstertruckgofree" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.imayi.monstertruckgofree"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.monstertruckgofree"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.monstertruckgofree&hl=en_US&gl=us"
      -getName(): string: "Monster Truck Games for kids"
      -getDescription(): string: """
        VVRROOOM! Time to race in the big monster truck rally! \n
        \n
        Race over obstacles and across beautiful landscapes on your way to the finish line. Choose fr…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Yateland - Learning Games For Kids"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/xT5t0ExiuD0Hu_3Q7KmGrQvnvNGofqzx_eXThtN2lw3BDw-m8u1dKR_Ix_vs_4DtxcM"
        -getUrl(): string: "https://play-lh.googleusercontent.com/xT5t0ExiuD0Hu_3Q7KmGrQvnvNGofqzx_eXThtN2lw3BDw-m8u1dKR_Ix_vs_4DtxcM"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xT5t0ExiuD0Hu_3Q7KmGrQvnvNGofqzx_eXThtN2lw3BDw-m8u1dKR_Ix_vs_4DtxcM=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:23 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/w7ZEGbDZ5xhDzS7YUCXKVGJ6nFiNTKBVd611ggv_W2pjbkpeXBP-WiZet7zKh1EORQ"
          -getUrl(): string: "https://play-lh.googleusercontent.com/w7ZEGbDZ5xhDzS7YUCXKVGJ6nFiNTKBVd611ggv_W2pjbkpeXBP-WiZet7zKh1EORQ"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/w7ZEGbDZ5xhDzS7YUCXKVGJ6nFiNTKBVd611ggv_W2pjbkpeXBP-WiZet7zKh1EORQ=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/_KjZA3k2ENftAXItu84QnvxNCwv_8juVUHJdQPpJu8s45dN_ulSHArtU38-y-_dtiEE"
          -getUrl(): string: "https://play-lh.googleusercontent.com/_KjZA3k2ENftAXItu84QnvxNCwv_8juVUHJdQPpJu8s45dN_ulSHArtU38-y-_dtiEE"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/_KjZA3k2ENftAXItu84QnvxNCwv_8juVUHJdQPpJu8s45dN_ulSHArtU38-y-_dtiEE=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.254464
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from page https://play.google.com/store/apps**
```php
$apps = $gplay->getListApps();
```
<details>
  <summary>Results</summary>

```php
array:1435 [
    "com.snapchat.android" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.snapchat.android"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.snapchat.android"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.snapchat.android&hl=en_US&gl=us"
      -getName(): string: "Snapchat"
      -getDescription(): string: """
        Snapchat is a fast and fun way to share the moment with your friends and family 👻\n
        \n
        SNAP \n
        • Snapchat opens right to the Camera — just tap to take a pho…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Snap Inc"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KxeSAjPTKliCErbivNiXrd6cTwfbqUJcbSRPe_IBVK_YmwckfMRS1VIHz-5cgT09yMo"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KxeSAjPTKliCErbivNiXrd6cTwfbqUJcbSRPe_IBVK_YmwckfMRS1VIHz-5cgT09yMo"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KxeSAjPTKliCErbivNiXrd6cTwfbqUJcbSRPe_IBVK_YmwckfMRS1VIHz-5cgT09yMo=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/xKCYMMuIshGmxLVckXnGYsdorvBxF0oI58Yt82Vkj_cn3Dby52gdrt4Lmr7BTYiVww"
          -getUrl(): string: "https://play-lh.googleusercontent.com/xKCYMMuIshGmxLVckXnGYsdorvBxF0oI58Yt82Vkj_cn3Dby52gdrt4Lmr7BTYiVww"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xKCYMMuIshGmxLVckXnGYsdorvBxF0oI58Yt82Vkj_cn3Dby52gdrt4Lmr7BTYiVww=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/yoN8h1j4M0Axz1UK2-iyPOmlQmIHqZ1tO8p7PjRicfmyPxj3-rztyB3YImG58zeMvOI"
          -getUrl(): string: "https://play-lh.googleusercontent.com/yoN8h1j4M0Axz1UK2-iyPOmlQmIHqZ1tO8p7PjRicfmyPxj3-rztyB3YImG58zeMvOI"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yoN8h1j4M0Axz1UK2-iyPOmlQmIHqZ1tO8p7PjRicfmyPxj3-rztyB3YImG58zeMvOI=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.211082
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.netflix.mediaclient" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.netflix.mediaclient"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient&hl=en_US&gl=us"
      -getName(): string: "Netflix"
      -getDescription(): string: """
        Looking for the most talked about TV shows and movies from the around the world? They’re all on Netflix.\n
        \n
        We’ve got award-winning series, movies, docu…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Netflix, Inc."
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:24 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.451842
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getListApps**
