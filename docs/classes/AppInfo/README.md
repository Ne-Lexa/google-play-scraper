[Documentation](../../README.md) > **AppInfo**

# The `Nelexa\GPlay\Model\AppInfo` class

## Introduction
Contains detailed information about the application from the Google Play store.

## Class synopsis
```php
final Nelexa\GPlay\Model\AppInfo extends Nelexa\GPlay\Model\App implements JsonSerializable {

    /* Methods */
    public getId ( void ) : string
    public getLocale ( void ) : string
    public getCountry ( void ) : string
    public getUrl ( void ) : string
    public getFullUrl ( void ) : string
    public getName ( void ) : string
    public getSummary ( void ) : string | null
    public getDeveloper ( void ) : Nelexa\GPlay\Model\Developer
    public getIcon ( void ) : Nelexa\GPlay\Model\GoogleImage
    public getScore ( void ) : float
    public getPriceText ( void ) : string | null
    public isFree ( void ) : bool
    public jsonSerialize ( void ) : mixed
    public getDescription ( void ) : string
    public isAutoTranslatedDescription ( void ) : bool
    public getTranslatedFromLocale ( void ) : string | null
    public getCover ( void ) : Nelexa\GPlay\Model\GoogleImage | null
    public getScreenshots ( void ) : Nelexa\GPlay\Model\GoogleImage[]
    public getCategory ( void ) : Nelexa\GPlay\Model\Category
    public getCategoryFamily ( void ) : Nelexa\GPlay\Model\Category | null
    public getVideo ( void ) : Nelexa\GPlay\Model\Video | null
    public getRecentChanges ( void ) : string | null
    public isEditorsChoice ( void ) : bool
    public getInstalls ( void ) : int
    public getHistogramRating ( void ) : Nelexa\GPlay\Model\HistogramRating
    public getPrice ( void ) : float
    public getCurrency ( void ) : string
    public isContainsIAP ( void ) : bool
    public getOffersIAPCost ( void ) : string | null
    public isContainsAds ( void ) : bool
    public getSize ( void ) : string | null
    public getAppVersion ( void ) : string | null
    public getAndroidVersion ( void ) : string | null
    public getMinAndroidVersion ( void ) : string | null
    public getContentRating ( void ) : string | null
    public getPrivacyPoliceUrl ( void ) : string | null
    public getReleased ( void ) : DateTimeInterface | null
    public getUpdated ( void ) : DateTimeInterface | null
    public getNumberVoters ( void ) : int
    public getNumberReviews ( void ) : int
    public getReviews ( void ) : Nelexa\GPlay\Model\Review[]
    public asArray ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\AppInfo::getId](appinfo.getid.md) - Returns the application ID (android package name).
* [Nelexa\GPlay\Model\AppInfo::getLocale](appinfo.getlocale.md) - Returns the locale (site language) for which the information was received.
* [Nelexa\GPlay\Model\AppInfo::getCountry](appinfo.getcountry.md) - Returns the country of the request for information about the application.
* [Nelexa\GPlay\Model\AppInfo::getUrl](appinfo.geturl.md) - Returns the URL of the application page in the Google Play store.
* [Nelexa\GPlay\Model\AppInfo::getFullUrl](appinfo.getfullurl.md) - Returns the full URL of the app's page on Google Play, specifying the locale and country of the request.
* [Nelexa\GPlay\Model\AppInfo::getName](appinfo.getname.md) - Returns application name.
* [Nelexa\GPlay\Model\AppInfo::getSummary](appinfo.getsummary.md) - Returns application summary.
* [Nelexa\GPlay\Model\AppInfo::getDeveloper](appinfo.getdeveloper.md) - Returns application developer.
* [Nelexa\GPlay\Model\AppInfo::getIcon](appinfo.geticon.md) - Returns application icon.
* [Nelexa\GPlay\Model\AppInfo::getScore](appinfo.getscore.md) - Returns application rating on a five-point scale.
* [Nelexa\GPlay\Model\AppInfo::getPriceText](appinfo.getpricetext.md) - Returns the price of the application.
* [Nelexa\GPlay\Model\AppInfo::isFree](appinfo.isfree.md) - Checks that this application is free.
* [Nelexa\GPlay\Model\AppInfo::jsonSerialize](appinfo.jsonserialize.md) - Specify data which should be serialized to JSON.
* [Nelexa\GPlay\Model\AppInfo::getDescription](appinfo.getdescription.md) - Returns a description of the application.
* [Nelexa\GPlay\Model\AppInfo::isAutoTranslatedDescription](appinfo.isautotranslateddescription.md) - Checks if the class description is automatically translated via Google Translate.
* [Nelexa\GPlay\Model\AppInfo::getTranslatedFromLocale](appinfo.gettranslatedfromlocale.md) - Returns locale (language) of the original description.
* [Nelexa\GPlay\Model\AppInfo::getCover](appinfo.getcover.md) - Returns cover image.
* [Nelexa\GPlay\Model\AppInfo::getScreenshots](appinfo.getscreenshots.md) - Returns screenshots of the application.
* [Nelexa\GPlay\Model\AppInfo::getCategory](appinfo.getcategory.md) - Returns the category of the application.
* [Nelexa\GPlay\Model\AppInfo::getCategoryFamily](appinfo.getcategoryfamily.md) - Returns family category.
* [Nelexa\GPlay\Model\AppInfo::getVideo](appinfo.getvideo.md) - Returns a video about the application.
* [Nelexa\GPlay\Model\AppInfo::getRecentChanges](appinfo.getrecentchanges.md) - Returns recent changes.
* [Nelexa\GPlay\Model\AppInfo::isEditorsChoice](appinfo.iseditorschoice.md) - Checks if the application is an editors' choice.
* [Nelexa\GPlay\Model\AppInfo::getInstalls](appinfo.getinstalls.md) - Returns the number of installations of the application.
* [Nelexa\GPlay\Model\AppInfo::getHistogramRating](appinfo.gethistogramrating.md) - Returns histogram rating.
* [Nelexa\GPlay\Model\AppInfo::getPrice](appinfo.getprice.md) - Returns the price of the app in the Google Play store.
* [Nelexa\GPlay\Model\AppInfo::getCurrency](appinfo.getcurrency.md) - Returns the price currency of the app in the Google Play store.
* [Nelexa\GPlay\Model\AppInfo::isContainsIAP](appinfo.iscontainsiap.md) - Checks if the app contains In-App Purchases (IAP).
* [Nelexa\GPlay\Model\AppInfo::getOffersIAPCost](appinfo.getoffersiapcost.md) - Returns the cost of In-App Purchases (IAP).
* [Nelexa\GPlay\Model\AppInfo::isContainsAds](appinfo.iscontainsads.md) - Checks if the app contains ads.
* [Nelexa\GPlay\Model\AppInfo::getSize](appinfo.getsize.md) - Returns the size of the application.
* [Nelexa\GPlay\Model\AppInfo::getAppVersion](appinfo.getappversion.md) - Returns the version of the application.
* [Nelexa\GPlay\Model\AppInfo::getAndroidVersion](appinfo.getandroidversion.md) - Returns the supported version of Android.
* [Nelexa\GPlay\Model\AppInfo::getMinAndroidVersion](appinfo.getminandroidversion.md) - Returns the minimum supported version of Android.
* [Nelexa\GPlay\Model\AppInfo::getContentRating](appinfo.getcontentrating.md) - Returns the age limit.
* [Nelexa\GPlay\Model\AppInfo::getPrivacyPoliceUrl](appinfo.getprivacypoliceurl.md) - Returns privacy policy URL.
* [Nelexa\GPlay\Model\AppInfo::getReleased](appinfo.getreleased.md) - Returns the release date.
* [Nelexa\GPlay\Model\AppInfo::getUpdated](appinfo.getupdated.md) - Returns the date of the update.
* [Nelexa\GPlay\Model\AppInfo::getNumberVoters](appinfo.getnumbervoters.md) - Returns the number of voters.
* [Nelexa\GPlay\Model\AppInfo::getNumberReviews](appinfo.getnumberreviews.md) - Returns the number of reviews.
* [Nelexa\GPlay\Model\AppInfo::getReviews](appinfo.getreviews.md) - Returns some useful reviews.
* [Nelexa\GPlay\Model\AppInfo::asArray](appinfo.asarray.md) - Returns class properties as an array.


## See Also
* [Nelexa\GPlay\Model\App](../App/README.md) - Basic information about the application from the Google Play store.
* [Nelexa\GPlay\GPlayApps::getAppInfo()](../GPlayApps/gplayapps.getappinfo.md) - Returns detailed information about the Android application from the Google Play store.
* [Nelexa\GPlay\GPlayApps::getAppsInfo()](../GPlayApps/gplayapps.getappsinfo.md) - Returns detailed information about many android packages.
* [Nelexa\GPlay\GPlayApps::getAppInLocales()](../GPlayApps/gplayapps.getappinlocales.md) - Returns detailed information about an application from the Google Play store for an array of locales.
* [Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales()](../GPlayApps/gplayapps.getappinfoforavailablelocales.md) - Returns detailed information about the application in all available locales.
## Sample object content
```php
class Nelexa\GPlay\Model\AppInfo {
  -getId(): string: "jp.co.ofcr.cm00"
  -getLocale(): string: "en_US"
  -getCountry(): string: "us"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&hl=en_US&gl=us"
  -getName(): string: "Cooking Mama: Let's cook!"
  -getSummary(): ?string: "Make scrumptious food and serve it!"
  -getDeveloper(): Nelexa\GPlay\Model\Developer: {
    -getId(): string: "5667641639682181100"
    -getUrl(): string: "https://play.google.com/store/apps/dev?id=5667641639682181100"
    -getName(): string: "Office Create Corp."
    -getDescription(): ?string: null
    -getWebsite(): ?string: "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/google_en/index.html"
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: "mama_info02@ofcr.co.jp"
    -getAddress(): ?string: "神奈川県横浜市青葉区青葉台２－１６－１０　第2鈴木ビル３F"
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
  }
  -getScore(): float: 4.3630123
  -getPriceText(): ?string: null
  -isFree(): bool: true
  -jsonSerialize(): mixed: …
  -getDescription(): string: """
    Make scrumptious food and serve it!\n
    \n
    Chop, bake, stew...\n
    Cook tasty meals with easy touch controls!\n
    Try out this unique cooking game.\n
    The yummy food y…
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/gZToThOqs6KXpZToJp4pXnvwjJaPHinm9kP5FnThULrMe9ujyfhkKqq1nLka88YjWeOo"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/gZToThOqs6KXpZToJp4pXnvwjJaPHinm9kP5FnThULrMe9ujyfhkKqq1nLka88YjWeOo=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/gZToThOqs6KXpZToJp4pXnvwjJaPHinm9kP5FnThULrMe9ujyfhkKqq1nLka88YjWeOo"
  }
  -getScreenshots(): array:24 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/a1lIZGG93kyqjyK5Cy6UvDXpY1wH-Cj8S4f60hagzrjdt90XmhkWWdupVkhEzHHcPiQ"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a1lIZGG93kyqjyK5Cy6UvDXpY1wH-Cj8S4f60hagzrjdt90XmhkWWdupVkhEzHHcPiQ=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/a1lIZGG93kyqjyK5Cy6UvDXpY1wH-Cj8S4f60hagzrjdt90XmhkWWdupVkhEzHHcPiQ"
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/bXZn07ZqP8SWBcLpf2Ic3p-VDLRZuMpxjUJwfOzv2pm-MUlxELv8u6Vo1L_vHoE9Wz3U"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/bXZn07ZqP8SWBcLpf2Ic3p-VDLRZuMpxjUJwfOzv2pm-MUlxELv8u6Vo1L_vHoE9Wz3U=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/bXZn07ZqP8SWBcLpf2Ic3p-VDLRZuMpxjUJwfOzv2pm-MUlxELv8u6Vo1L_vHoE9Wz3U"
    }
    …
  ]
  -getCategory(): Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_EDUCATIONAL"
    -getName(): string: "Educational"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "FAMILY_PRETEND"
    -getName(): string: "Pretend Play"
    -isGamesCategory(): bool: false
    -isFamilyCategory(): bool: true
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getVideo(): ?Nelexa\GPlay\Model\Video: {
    -getImageUrl(): string: "https://i.ytimg.com/vi/CIyPDJYtVhw/hqdefault.jpg"
    -getVideoUrl(): string: "https://www.youtube.com/embed/CIyPDJYtVhw?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    -getYoutubeId(): ?string: "CIyPDJYtVhw"
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getRecentChanges(): ?string: """
    New! World Dishes 5!\n
    Round 5: Middle Eastern Dishes! Dine on global cuisines!\n
    Fixed certain bugs.\n
    Made balance adjustments.
    """
  -isEditorsChoice(): bool: true
  -getInstalls(): int: 52048343
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 476544
    -getFourStars(): int: 69144
    -getThreeStars(): int: 39314
    -getTwoStars(): int: 20224
    -getOneStar(): int: 52653
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getPrice(): float: 0.0
  -getCurrency(): string: "USD"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "$0.99 - $15.99 per item"
  -isContainsAds(): bool: true
  -getSize(): ?string: "61M"
  -getAppVersion(): ?string: "1.56.0"
  -getAndroidVersion(): ?string: "4.1 and up"
  -getMinAndroidVersion(): ?string: "4.1"
  -getContentRating(): ?string: "Everyone"
  -getPrivacyPoliceUrl(): ?string: "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/en/privacypolicy.html"
  -getReleased(): ?DateTimeInterface: @1431561600 {
    date: 2015-05-14T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1580446355 {
    date: 2020-01-31T04:52:35+00:00
  }
  -getNumberVoters(): int: 657882
  -getNumberReviews(): int: 244629
  -getReviews(): array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOElHBcZOZrzHV4DOlW32kIBBZ0PQtHkAXY9Vaw0QYtOHKl8tz2NouvBucCqk7jcGN1GWKglrWxdEHoYJg"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOElHBcZOZrzHV4DOlW32kIBBZ0PQtHkAXY9Vaw0QYtOHKl8tz2NouvBucCqk7jcGN1GWK…"
      -getUserName(): string: "Marijana Stojanović"
      -getText(): string: "I absolutely loved the cooking parts of the game, but it's so saddening that you have to pay for like... 70% for the recipes. So I just played the fre…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCYtS36wyZc-202TCYoJQDgQxlSTOXBO-b0y6KI=s64"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCYtS36wyZc-202TCYoJQDgQxlSTOXBO-b0y6KI=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCYtS36wyZc-202TCYoJQDgQxlSTOXBO-b0y6KI=s64"
      }
      -getDate(): ?DateTimeInterface: @1580891781 {
        date: 2020-02-05T08:36:21+00:00
      }
      -getScore(): int: 3
      -getCountLikes(): int: 65
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOG0m_5SlxX20BniMe8ojx7IKMVJkrZoflVFp_YBzgyTqXExqTnZXGf9GWwOyR_RKlsvRtfM9g4aPFETRg"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOG0m_5SlxX20BniMe8ojx7IKMVJkrZoflVFp_YBzgyTqXExqTnZXGf9GWwOyR_RKlsvRt…"
      -getUserName(): string: "Angela Gallagher"
      -getText(): string: "Level 10 is where it ends??!! That's it. In each area. Not much fun after that. And it's a shame that only those that have the money to spend in the g…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCPHJ-ScDUX-RHHhVYFePJf1BMWlE_QGax_LRnp=s64"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCPHJ-ScDUX-RHHhVYFePJf1BMWlE_QGax_LRnp=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCPHJ-ScDUX-RHHhVYFePJf1BMWlE_QGax_LRnp=s64"
      }
      -getDate(): ?DateTimeInterface: @1580680688 {
        date: 2020-02-02T21:58:08+00:00
      }
      -getScore(): int: 3
      -getCountLikes(): int: 36
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
  -asArray(): array: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($appInfo, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "id": "jp.co.ofcr.cm00",
    "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00",
    "locale": "en_US",
    "country": "us",
    "name": "Cooking Mama: Let's cook!",
    "summary": "Make scrumptious food and serve it!",
    "developer": {
        "id": "5667641639682181100",
        "url": "https://play.google.com/store/apps/dev?id=5667641639682181100",
        "name": "Office Create Corp.",
        "description": null,
        "website": "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/google_en/index.html",
        "icon": null,
        "cover": null,
        "email": "mama_info02@ofcr.co.jp",
        "address": "神奈川県横浜市青葉区青葉台２－１６－１０　第2鈴木ビル３F"
    },
    "icon": "https://lh3.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw",
    "score": 4.3630123,
    "priceText": null,
    "description": "Make scrumptious food and serve it!\n\nChop, bake, stew...\nCook tasty meals with easy touch controls!\nTry out this unique cooking game.\nThe yummy food you'll create will definitely make you hungry!\n\n▼Let's Cook! \nCook food by playing fun mini games. More than 30 kinds of recipes are waiting for you. Do your best, Special Chef!\n\n▼Happy Village! \nServe your cooking to everyone at your restaurant. Create a big and wonderful restaurant that's all your own.\nHarvest lots of things by going Fishing, growing plants in the Fields, and raising animals in your Ranch.\nGather up lots to exchange for Happy Foods!\n\n▼Game Plaza!\nPlay non-cooking games like \"Help out,\" \"Play Shopkeeper,\" and \"Exercise your brain.\" More than 30 kinds of mini games are waiting for you. Aim to get high scores!\n\n▼Challenge Ranking!\nCompete in weekly events for the best scores! Join the global rankings!\n\n▼Other Ways to Have Fun\n-Decorate the kitchen with various items.\n-Make surprise dishes by combining 2 recipes.\n-Watch realistic cooking videos for supported recipes.\n-Watch an animated video of Mama's fun daily life.\n\n[Game Features]\nWith its intuitive controls, both children and adults can enjoy the game. Also, even if you make mistakes there are no game overs, so everyone can complete dishes. Furthermore, children who play may develop an interest in cooking.\n\n[Recommended Setup]\nAndroid OS 4.1 or later.\n**Game may not be playable on certain devices even if the above conditions are met.\n\n**By downloading this game, you are accepting its User Agreement.\nhttp://www.ofcr.co.jp/APP_CookingMama/en/privacypolicy.html\n\n[Supported Languages]\nEnglish,French,German,Italian,Spanish,Dutch,Russian,Portuguese,Polish,Czech,Turkish,Japanese,Korean,Simplified Chinese,Traditional Chinese,Indonesian,Filipino,Malay,Thai,Vietnamese,Hindi,Spanish-mexico,Portugues brasileiro,Arabic,Persian,Swedish,Norwegian,Danish,Finnish",
    "translatedFromLocale": null,
    "cover": "https://lh3.googleusercontent.com/gZToThOqs6KXpZToJp4pXnvwjJaPHinm9kP5FnThULrMe9ujyfhkKqq1nLka88YjWeOo",
    "screenshots": [
        "https://lh3.googleusercontent.com/a1lIZGG93kyqjyK5Cy6UvDXpY1wH-Cj8S4f60hagzrjdt90XmhkWWdupVkhEzHHcPiQ",
        "https://lh3.googleusercontent.com/bXZn07ZqP8SWBcLpf2Ic3p-VDLRZuMpxjUJwfOzv2pm-MUlxELv8u6Vo1L_vHoE9Wz3U",
        "https://lh3.googleusercontent.com/Yd3wWMiCV65aHYpcM4sV3730AygLSSK7wWaqhv3LNQPK_VeXmfSU3rL8QAus4aLMJA",
        "https://lh3.googleusercontent.com/QbwbEnXNhjk6RJw2jJr3xZKtdsZuJqjm1B-ICvMrzBW5HtEZpkZzZB0KMOT-7tAAoWU",
        "https://lh3.googleusercontent.com/lqmtZqtlXcModVqN_SYNpA70UAmZGFJ-aIOY2bQ8wdNvwF-hOYyKuUzFT8c6l5ymBjQ",
        "https://lh3.googleusercontent.com/QEizHh4yeFEpjgPy_9aAWe5GQkWT6zYIT6ZJpBJVDNwJJYsU8qVcl00obatWQCC5GA",
        "https://lh3.googleusercontent.com/Jg60GYSVJkt32PsiJkcs-JfL2iENCNa_dixVcdUZnu-kpnPLozPPIQW5-BcuAbudmYix",
        "https://lh3.googleusercontent.com/t9E9fjtpfPBKalDEeL-cE79AZ2iV2JpGrbPOXExlHEBmr4Ot_Y47tnw1REnsxf_W2ENE",
        "https://lh3.googleusercontent.com/z-Dvp4Fd5kYhBp3-FM01asMyV1v7SVxwnRe-eEkNcptcWoMQOplgIhocy1ObiEzySH8",
        "https://lh3.googleusercontent.com/5ngMd1MPFuUZf_FDKKiwKpixYv5MK5mTHGIshO1StYs2DWRL2YYkxku4aGv2e0NQal4",
        "https://lh3.googleusercontent.com/C_NeVkHgzEtosm8TBJU2xh3EmLWlAOekyxSzGiAGc9pEfe9GFjjEmMjY2h2318HrLw",
        "https://lh3.googleusercontent.com/-EVwxCrZ_rcPBU2HVL62qFxlNPsrnYwXYGCEa5jHQpAOPabaH42KVRz9tz2id_CrF4s",
        "https://lh3.googleusercontent.com/Liv-WQ0YRe7e03i7BxOCamwnBe5H8b4kqlmECV8B0tOQJUd7nqo-OMNM66lpf6IR0rBP",
        "https://lh3.googleusercontent.com/HpFlMncOpozMsYzIqFlLoUixvi6Cj1Qcqidj1BTIx7y98fkOT-gjr3a15BfuFgTbyWs",
        "https://lh3.googleusercontent.com/NIjUBoz6PfztMUKcaTe1UBXXS-bqod6YOJLJmEwobxah_wIyViUkCgxCHPvCfF8HrEo",
        "https://lh3.googleusercontent.com/tysrudUXDRUzelYzKjDJBafxg_MHJIQm1XnjoZgdJARl0DUDmep8t8IBeJ-S__rT6n4",
        "https://lh3.googleusercontent.com/jy20Hv87ggGCyh1qs-sKEwsPkEyE8iSfT5XMQ49OTnQbkNQgq7qy9cKNMNOUeJ_Rpqo",
        "https://lh3.googleusercontent.com/hr8MZS9g4BVXvL55PGb7LjfwK8VfpfyXLjBzWUozYzveehpdmI9zSTE2EOFq8RVuLug",
        "https://lh3.googleusercontent.com/XSmEfnQWURFNMKRnXAHRGPTaMsU9Z9GsTYkBwN72lb_0wRMKkzVran4lG-s5GjTMjQ",
        "https://lh3.googleusercontent.com/P4hIEuITU_fhg4zNCNbRB6MNAJq2hDh9N0NNKJihnNc8vV8aeT9YJDljt-bb6TZ1R449",
        "https://lh3.googleusercontent.com/pEfyuafiUVYakYg-1t_dSpDpzwbOvuEYq82N_TdsUALhkJft1aLgWgGS7V1RkdMBdw",
        "https://lh3.googleusercontent.com/xXpPSu5qfyJ7ctVAZQMkZKcAIxMjN2DT8aAdduKoDOCCfXLHdQFQRwi3ZyEZbeBIBipv",
        "https://lh3.googleusercontent.com/3C6F0DpG_JN0YzDCNgYmxHwnlMS2Qk4aarLXZr5YqBoE4gSx0J9wqksYX9pnM9bYufQ",
        "https://lh3.googleusercontent.com/dcqYnOpTRcxeaebkaz0zOABAk_SstQI3K_5BnGAtR21m2iD8zAel9xyqmI4UxE5N1HM"
    ],
    "category": {
        "id": "GAME_EDUCATIONAL",
        "name": "Educational"
    },
    "categoryFamily": {
        "id": "FAMILY_PRETEND",
        "name": "Pretend Play"
    },
    "video": {
        "thumbUrl": "https://i.ytimg.com/vi/CIyPDJYtVhw/hqdefault.jpg",
        "videoUrl": "https://www.youtube.com/embed/CIyPDJYtVhw?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    },
    "privacyPoliceUrl": "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/en/privacypolicy.html",
    "recentChange": "New! World Dishes 5!\nRound 5: Middle Eastern Dishes! Dine on global cuisines!\nFixed certain bugs.\nMade balance adjustments.",
    "editorsChoice": true,
    "installs": 52048343,
    "numberVoters": 657882,
    "histogramRating": {
        "five": 476544,
        "four": 476544,
        "three": 39314,
        "two": 20224,
        "one": 52653
    },
    "price": 0,
    "currency": "USD",
    "offersIAP": true,
    "offersIAPCost": "$0.99 - $15.99 per item",
    "containsAds": true,
    "size": "61M",
    "appVersion": "1.56.0",
    "androidVersion": "4.1 and up",
    "minAndroidVersion": "4.1",
    "contentRating": "Everyone",
    "released": "2015-05-14T00:00:00+00:00",
    "releasedTimestamp": 1431561600,
    "updated": "2020-01-31T04:52:35+00:00",
    "updatedTimestamp": 1580446355,
    "numberReviews": 244629,
    "reviews": [
        {
            "id": "gp:AOqpTOElHBcZOZrzHV4DOlW32kIBBZ0PQtHkAXY9Vaw0QYtOHKl8tz2NouvBucCqk7jcGN1GWKglrWxdEHoYJg",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOElHBcZOZrzHV4DOlW32kIBBZ0PQtHkAXY9Vaw0QYtOHKl8tz2NouvBucCqk7jcGN1GWKglrWxdEHoYJg",
            "userName": "Marijana Stojanović",
            "text": "I absolutely loved the cooking parts of the game, but it's so saddening that you have to pay for like... 70% for the recipes. So I just played the free ones. Everything else is just too busy, like they tried to cram every free to play mobile game in it to keep you busy. All I wanted was to cook some cute meals, but instead had to see pop up after pop up forcing me to watch ads or pay. And the music is SO ANNOYINGLY REPETITIVE. I'll have to get a DS to play the real game, it seems.",
            "avatar": "https://lh3.googleusercontent.com/a-/AAuE7mCYtS36wyZc-202TCYoJQDgQxlSTOXBO-b0y6KI=s64",
            "date": "2020-02-05T08:36:21+00:00",
            "timestamp": 1580891781,
            "score": 3,
            "countLikes": 65,
            "reply": null
        },
        {
            "id": "gp:AOqpTOG0m_5SlxX20BniMe8ojx7IKMVJkrZoflVFp_YBzgyTqXExqTnZXGf9GWwOyR_RKlsvRtfM9g4aPFETRg",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOG0m_5SlxX20BniMe8ojx7IKMVJkrZoflVFp_YBzgyTqXExqTnZXGf9GWwOyR_RKlsvRtfM9g4aPFETRg",
            "userName": "Angela Gallagher",
            "text": "Level 10 is where it ends??!! That's it. In each area. Not much fun after that. And it's a shame that only those that have the money to spend in the game gets to enjoy the locked recipes. Not cool. Of All those ad pop ups CONSTANTLY the mods COULD give a recipe for clicking on them to watch. Instead of just happy foods. Can earn those in the other areas. And what's the point of all those happy foods earned when you only get to make 5 mini cooking recipes per day with them.",
            "avatar": "https://lh3.googleusercontent.com/a-/AAuE7mCPHJ-ScDUX-RHHhVYFePJf1BMWlE_QGax_LRnp=s64",
            "date": "2020-02-02T21:58:08+00:00",
            "timestamp": 1580680688,
            "score": 3,
            "countLikes": 36,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHKOKTbqKdMRi01uw5GfJdXDU7aC0rzv3vc-BlkT4cYFjy4AzvSMg1N6_Sf6XzkRyJVq8vJz9Y7UygVpg",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOHKOKTbqKdMRi01uw5GfJdXDU7aC0rzv3vc-BlkT4cYFjy4AzvSMg1N6_Sf6XzkRyJVq8vJz9Y7UygVpg",
            "userName": "Samantha",
            "text": "I loved the DS series as a kid and was excited when I saw this. While it did bring back old memories and the recipes I could unlock were fun, most are locked behind a pay wall. They're also much simpler and don't take very long to do, so not really worth the prices they're asking for. The interface is also extremely busy and it constantly feels like I'm on one of those scam websites with all these popups. You're better off playing the original games.",
            "avatar": "https://lh3.googleusercontent.com/a-/AAuE7mDpplpluhiYsZu0DoM_3kG9LHCol2UEkz5GIZcUrw=s64",
            "date": "2020-02-07T04:56:29+00:00",
            "timestamp": 1581051389,
            "score": 3,
            "countLikes": 37,
            "reply": null
        },
        {
            "id": "gp:AOqpTOEzneZAaLNXDOVffe-i0fOQNJ7jR_84vi0GUctpTEtaJce7wrpr4wGEYd3LJzg2EfJgcXm0IEglpPCFRg",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOEzneZAaLNXDOVffe-i0fOQNJ7jR_84vi0GUctpTEtaJce7wrpr4wGEYd3LJzg2EfJgcXm0IEglpPCFRg",
            "userName": "Mahdi Reza",
            "text": "It's great! Although I would live to change cooking mama to cooking papa. I would also like more cartoon sound effects like bongs, slide whistles and stuff for atmosphere. He should have a basic dad fleece jacket in all colors as part of his outfit line!",
            "avatar": "https://lh3.googleusercontent.com/a-/AAuE7mARwrEe_qvBdEBx3rJO5h9qjDUKnbL4KZx048xIyA=s64",
            "date": "2020-02-13T03:16:29+00:00",
            "timestamp": 1581563789,
            "score": 3,
            "countLikes": 5,
            "reply": null
        }
    ]
}
```

[Documentation](../../README.md) > **AppInfo**
