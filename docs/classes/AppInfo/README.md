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
    public jsonSerialize ( void ) : array
    public getDescription ( void ) : string
    public isAutoTranslatedDescription ( void ) : bool
    public getTranslatedFromLocale ( void ) : string | null
    public getCover ( void ) : Nelexa\GPlay\Model\GoogleImage | null
    public getScreenshots ( void ) : Nelexa\GPlay\Model\GoogleImage[]
    public getCategory ( void ) : Nelexa\GPlay\Model\Category | null
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
    -jsonSerialize(): array: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
    -getUrl(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw=s0"
    -getBinaryImageContent(): string: …
  }
  -getScore(): float: 4.090022
  -getPriceText(): ?string: ""
  -isFree(): bool: false
  -jsonSerialize(): array: …
  -getDescription(): string: """
    Chop, bake, stew...\n
    Cook tasty meals with easy touch controls!\n
    Try out this unique cooking game.\n
    The yummy food you'll create will definitely make you…
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw"
    -getUrl(): string: "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw=s0"
    -getBinaryImageContent(): string: …
  }
  -getScreenshots(): array: array:24 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/WRRPEfsMwic3iEOEIHeJ52mUom3eCAIgnayNzm4acd42cAVF9hnsbK0dernFGK_SeGY"
      -getUrl(): string: "https://play-lh.googleusercontent.com/WRRPEfsMwic3iEOEIHeJ52mUom3eCAIgnayNzm4acd42cAVF9hnsbK0dernFGK_SeGY"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/WRRPEfsMwic3iEOEIHeJ52mUom3eCAIgnayNzm4acd42cAVF9hnsbK0dernFGK_SeGY=s0"
      -getBinaryImageContent(): string: …
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/EjgHrAVu2vxG7b_9ykewmf_LFGxdtBenG_ky8b0tERuhxvsLVuVkztXLeFDnp5Xe1g"
      -getUrl(): string: "https://play-lh.googleusercontent.com/EjgHrAVu2vxG7b_9ykewmf_LFGxdtBenG_ky8b0tERuhxvsLVuVkztXLeFDnp5Xe1g"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/EjgHrAVu2vxG7b_9ykewmf_LFGxdtBenG_ky8b0tERuhxvsLVuVkztXLeFDnp5Xe1g=s0"
      -getBinaryImageContent(): string: …
    }
    …
  ]
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_EDUCATIONAL"
    -getName(): string: "Educational"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: {
    -getImageUrl(): string: "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw"
    -getVideoUrl(): string: "https://www.youtube.com/embed/CIyPDJYtVhw?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    -getYoutubeId(): ?string: "CIyPDJYtVhw"
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getRecentChanges(): ?string: """
    version 1.80.0\n
    Limited time recipe this time!\n
    Beefsteak\n
    Play limited until the next update!\n
    Fixed certain bugs.\n
    Made balance adjustments.
    """
  -isEditorsChoice(): bool: false
  -getInstalls(): int: 68611221
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 499330
    -getFourStars(): int: 95118
    -getThreeStars(): int: 69838
    -getTwoStars(): int: 41725
    -getOneStar(): int: 91400
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getPrice(): float: 0.0
  -getCurrency(): string: "USD"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "$0.99 - $15.99 per item"
  -isContainsAds(): bool: true
  -getSize(): ?string: "70M"
  -getAppVersion(): ?string: "1.80.0"
  -getAndroidVersion(): ?string: "4.4 and up"
  -getMinAndroidVersion(): ?string: "4.4"
  -getContentRating(): ?string: "Everyone"
  -getPrivacyPoliceUrl(): ?string: "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/en/privacypolicy.html"
  -getReleased(): ?DateTimeInterface: @1431561600 {
    date: 2015-05-14T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1645689783 {
    date: 2022-02-24T08:03:03+00:00
  }
  -getNumberVoters(): int: 797466
  -getNumberReviews(): int: 14874
  -getReviews(): array: array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOEdhXvIPIx0YGAB8Ad7CKDbId-FqUhPHkOOjmxu4oY8r-WzHzutMb869I5WuvGwZ1SqU18iB3a0ys-POA"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOEdhXvIPIx0YGAB8Ad7CKDbId-FqUhPHkOOjmxu4oY8r-WzHzutMb869I5WuvGwZ1SqU1…"
      -getUserName(): string: "Sulien J"
      -getText(): string: "Disappointed because I can't transfer my data to my new device. I transferred once before, but now the option doesn't even exist in the menu in my gam…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghh8FH7kuzBz119Dn4MEEFJgzoV_C0sYl8PMtwoBQ=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghh8FH7kuzBz119Dn4MEEFJgzoV_C0sYl8PMtwoBQ=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghh8FH7kuzBz119Dn4MEEFJgzoV_C0sYl8PMtwoBQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645676281 {
        date: 2022-02-24T04:18:01+00:00
      }
      -getScore(): int: 1
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGqP2Ugs7sT10aGT5Mj_Es_zaOyCyxVfdfgBJG3at1LnOehNatcFI1TY_sSO0BwcyPy_Ly1oGoNNWN6Tg"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOGqP2Ugs7sT10aGT5Mj_Es_zaOyCyxVfdfgBJG3at1LnOehNatcFI1TY_sSO0BwcyPy_L…"
      -getUserName(): string: "Emily Shadoan"
      -getText(): string: "I've loved cooking mama since I was a kid so I have alot of fun with this. I don't understand why so many people are complaining about the UI being "o…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhFIwFc36-6Q_kN5M_1EfdItD11W7whip2RFgd70A=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhFIwFc36-6Q_kN5M_1EfdItD11W7whip2RFgd70A=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhFIwFc36-6Q_kN5M_1EfdItD11W7whip2RFgd70A=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1643617761 {
        date: 2022-01-31T08:29:21+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 136
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): array: …
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
    "icon": "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw",
    "score": 4.090022,
    "priceText": "",
    "description": "Chop, bake, stew...\nCook tasty meals with easy touch controls!\nTry out this unique cooking game.\nThe yummy food you'll create will definitely make you hungry!\n\n▼Let's Cook! \nCook food by playing fun mini games. More than 30 kinds of recipes are waiting for you. Do your best, Special Chef!\n\n▼Happy Village! \nServe your cooking to everyone at your restaurant. Create a big and wonderful restaurant that's all your own.\nHarvest lots of things by going Fishing, growing plants in the Fields, and raising animals in your Ranch.\nGather up lots to exchange for Happy Foods!\n\n▼Game Plaza!\nPlay non-cooking games like \"Help out,\" \"Play Shopkeeper,\" and \"Exercise your brain.\" More than 30 kinds of mini games are waiting for you. Aim to get high scores!\n\n▼Challenge Ranking!\nCompete in weekly events for the best scores! Join the global rankings!\n\n▼Other Ways to Have Fun\n-Decorate the kitchen with various items.\n-Make surprise dishes by combining 2 recipes.\n-Watch realistic cooking videos for supported recipes.\n-Watch an animated video of Mama's fun daily life.\n\n[Game Features]\nWith its intuitive controls, both children and adults can enjoy the game. Also, even if you make mistakes there are no game overs, so everyone can complete dishes. Furthermore, children who play may develop an interest in cooking.\n\n[Recommended Setup]\nAndroid OS 4.1 or later.\n**Game may not be playable on certain devices even if the above conditions are met.\n\n**By downloading this game, you are accepting its User Agreement.\nhttp://www.ofcr.co.jp/APP_CookingMama/en/privacypolicy.html\n\n[Supported Languages]\nEnglish,French,German,Italian,Spanish,Dutch,Russian,Portuguese,Polish,Czech,Turkish,Japanese,Korean,Simplified Chinese,Traditional Chinese,Indonesian,Filipino,Malay,Thai,Vietnamese,Hindi,Spanish-mexico,Portugues brasileiro,Arabic,Persian,Swedish,Norwegian,Danish,Finnish",
    "translatedFromLocale": null,
    "cover": "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw",
    "screenshots": [
        "https://play-lh.googleusercontent.com/WRRPEfsMwic3iEOEIHeJ52mUom3eCAIgnayNzm4acd42cAVF9hnsbK0dernFGK_SeGY",
        "https://play-lh.googleusercontent.com/EjgHrAVu2vxG7b_9ykewmf_LFGxdtBenG_ky8b0tERuhxvsLVuVkztXLeFDnp5Xe1g",
        "https://play-lh.googleusercontent.com/Gp0DkHJEuZAvn6uSXjhE_NKu3dC8WPnfGpfFpTjH5rWS3_nn58JslId9BoHo8Orm_wI",
        "https://play-lh.googleusercontent.com/Vw2pAqDWyEFeQ648vR4APt5Ygvn5HdsFyl_Z_w-nekk9GsA34Bkbp7CaoC7kptYnjVCS",
        "https://play-lh.googleusercontent.com/uOijsKQ1zNtx3_YZJTLqOAhK6_4ES-n35pDiO1Z05kO0LnM73i5cFyl-mFxPIQATGw",
        "https://play-lh.googleusercontent.com/zkElUKyxm2fhMyI0Kny2q32RCt43bEda8O2ahMBBB1Yhj42ZyzZXRkzUDvY4VojvSw",
        "https://play-lh.googleusercontent.com/8j-_ZjkCCkAMCpqEfB_dt2LquTEVbf5KfCmGP5R4HWqEl9kB9XnA7AqSLGOPsSQ4z6o",
        "https://play-lh.googleusercontent.com/t9E9fjtpfPBKalDEeL-cE79AZ2iV2JpGrbPOXExlHEBmr4Ot_Y47tnw1REnsxf_W2ENE",
        "https://play-lh.googleusercontent.com/ozvcysWTH7Tt1Mx-obR6PR5_p_yVWonKjXU6NO8tOeB-FiVbsdeY6rgLkZbD9kRac4I",
        "https://play-lh.googleusercontent.com/lplFiGt1WRP5Kj4JNP6yekHsNXFjRlt23hUtsrkBnPXL4mxJcFZDPY5Uu56wWHFMBQ4C",
        "https://play-lh.googleusercontent.com/e7_ja-1N5Umut3VRUY2Yt8GFVBUdkF3YdMoCRFDxfWG62-0Wgoso5EL7frWpR3KUUQ",
        "https://play-lh.googleusercontent.com/0AVEI0-wUbbN6tvi47hB-xmh7bjYdDgaAtJp-yPM9UdRdVrfjS0FBdl3T5LQZg-x6A",
        "https://play-lh.googleusercontent.com/gKI-a09gF6AtN-rFrJn50BQfFyOTXZfiUuUbKTN-WAlxivyq9hsVnsF5387cv7JQRkRG",
        "https://play-lh.googleusercontent.com/33WPfxcJw1ic-L4S3PmOlBZzZPisdUq44wWibj5Ksty9Uux-Ic6_J8bq6tv5ZE1Xl6V5",
        "https://play-lh.googleusercontent.com/338W0Rgr16KwBomyzTvDZWiVJT62JdxbX4mA5oNRgOpKqYOcz1l4akODkWvvGvocy74",
        "https://play-lh.googleusercontent.com/dcqYnOpTRcxeaebkaz0zOABAk_SstQI3K_5BnGAtR21m2iD8zAel9xyqmI4UxE5N1HM",
        "https://play-lh.googleusercontent.com/r4PrG8JjvcIH5GQlNUbLyRKsP1gnFAhmRE_mu921sfvkk8TUC5r2abFdXDhl5yMAZXk",
        "https://play-lh.googleusercontent.com/8EBDo1vgT0sPjHyJd0kxTZKLtjOJvCJuJOIo3IYDxHQKBzcKd9SupP6bw7N1i905JhM",
        "https://play-lh.googleusercontent.com/bx0RR3UrWMK90k1XPg5KXeLeWr4gV0tY43wgopHvkm-t5iEiL4F8-yXLPCHkIyPjeQ",
        "https://play-lh.googleusercontent.com/QBDJ2zXX1cszR6XKXIYIQlXzFFQmR2ZdcYUhzA4vMiYMhMix7CtOaEpMMuOVpj2mT1A",
        "https://play-lh.googleusercontent.com/SCS7nIUYJ_LUs0ASmJQ4-Otmdws099aft-V6H_zIuk4CneTMhisoWE_Ng3hKmdVQ",
        "https://play-lh.googleusercontent.com/6oIRWXB42Q3kAuQfAiAw1Xe04PzE4DP4szFdmhbyVO-mXq2MwMNoESHZScZLD_74Bw",
        "https://play-lh.googleusercontent.com/EeZAEqZYmgYl1UnuXNWisNEUEnLX-t632PQDXe0VNoxNqKVH9TnFVbt24RPOwLg2lEQ",
        "https://play-lh.googleusercontent.com/tysrudUXDRUzelYzKjDJBafxg_MHJIQm1XnjoZgdJARl0DUDmep8t8IBeJ-S__rT6n4"
    ],
    "category": {
        "id": "GAME_EDUCATIONAL",
        "name": "Educational"
    },
    "categoryFamily": null,
    "video": {
        "thumbUrl": "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw",
        "videoUrl": "https://www.youtube.com/embed/CIyPDJYtVhw?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    },
    "privacyPoliceUrl": "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/en/privacypolicy.html",
    "recentChange": "version 1.80.0\nLimited time recipe this time!\nBeefsteak\nPlay limited until the next update!\nFixed certain bugs.\nMade balance adjustments.",
    "editorsChoice": false,
    "installs": 68611221,
    "numberVoters": 797466,
    "histogramRating": {
        "five": 499330,
        "four": 499330,
        "three": 69838,
        "two": 41725,
        "one": 91400
    },
    "price": 0,
    "currency": "USD",
    "offersIAP": true,
    "offersIAPCost": "$0.99 - $15.99 per item",
    "containsAds": true,
    "size": "70M",
    "appVersion": "1.80.0",
    "androidVersion": "4.4 and up",
    "minAndroidVersion": "4.4",
    "contentRating": "Everyone",
    "released": "2015-05-14T00:00:00+00:00",
    "releasedTimestamp": 1431561600,
    "updated": "2022-02-24T08:03:03+00:00",
    "updatedTimestamp": 1645689783,
    "numberReviews": 14874,
    "reviews": [
        {
            "id": "gp:AOqpTOEdhXvIPIx0YGAB8Ad7CKDbId-FqUhPHkOOjmxu4oY8r-WzHzutMb869I5WuvGwZ1SqU18iB3a0ys-POA",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOEdhXvIPIx0YGAB8Ad7CKDbId-FqUhPHkOOjmxu4oY8r-WzHzutMb869I5WuvGwZ1SqU18iB3a0ys-POA",
            "userName": "Sulien J",
            "text": "Disappointed because I can't transfer my data to my new device. I transferred once before, but now the option doesn't even exist in the menu in my game on my old device. I purchased all the expansions, and everything is gone on the new phone. I'm not about to repurchase everything. Guess I'm leaving this game behind.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Ghh8FH7kuzBz119Dn4MEEFJgzoV_C0sYl8PMtwoBQ=s64",
            "date": "2022-02-24T04:18:01+00:00",
            "timestamp": 1645676281,
            "score": 1,
            "countLikes": 0,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGqP2Ugs7sT10aGT5Mj_Es_zaOyCyxVfdfgBJG3at1LnOehNatcFI1TY_sSO0BwcyPy_Ly1oGoNNWN6Tg",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOGqP2Ugs7sT10aGT5Mj_Es_zaOyCyxVfdfgBJG3at1LnOehNatcFI1TY_sSO0BwcyPy_Ly1oGoNNWN6Tg",
            "userName": "Emily Shadoan",
            "text": "I've loved cooking mama since I was a kid so I have alot of fun with this. I don't understand why so many people are complaining about the UI being \"overwhelming\". It's NOTHING compared to a gacha-style game, trust me. The UI is extremely simple to me. Love it❤",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GhFIwFc36-6Q_kN5M_1EfdItD11W7whip2RFgd70A=s64",
            "date": "2022-01-31T08:29:21+00:00",
            "timestamp": 1643617761,
            "score": 5,
            "countLikes": 136,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHAAXG8BXRy7lxPy-39IZvy_NhBx4R5XHEUPWrfDeuYn9-8PZbX-P_Nh9yy4MntQZdeJhY-hr7f3kUflw",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOHAAXG8BXRy7lxPy-39IZvy_NhBx4R5XHEUPWrfDeuYn9-8PZbX-P_Nh9yy4MntQZdeJhY-hr7f3kUflw",
            "userName": "anec nhoj",
            "text": "Really fun but I see what people mean about being overwhelmed. UI is constantly pointing, flashing, moving, popping up, etc. Also still has the same problems as original cooking mama games on other platforms - frustrating mechanics, for example, though they are more manageable mobile. But it does improve upon them, and even adds awesome new features to try out. Great fun!",
            "avatar": "https://play-lh.googleusercontent.com/a/AATXAJw1JMVmUbhz1otZesYQBzQ8d3UAcoigWO7ifkgJ=s64",
            "date": "2022-01-09T23:31:08+00:00",
            "timestamp": 1641771068,
            "score": 4,
            "countLikes": 134,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGVg7-p1RXH8WmcZ_HJKpia-_UV2vPK97VTVKseohtuoqCkJpSlytsd6DS6h1j0fI85vltuUoMTBYJSCQ",
            "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&reviewId=gp%3AAOqpTOGVg7-p1RXH8WmcZ_HJKpia-_UV2vPK97VTVKseohtuoqCkJpSlytsd6DS6h1j0fI85vltuUoMTBYJSCQ",
            "userName": "Bryttney Thompson",
            "text": "Keeps freezing and closing on me while spending the coins I earn and remembering that. Sometimes I can play for hours with no problems. Sometimes it messes up and stays like that for hours.",
            "avatar": "https://play-lh.googleusercontent.com/a/AATXAJw5YlhlJfx_gwuaUSRgusNBrc1mdhkW36hQPW1s=s64",
            "date": "2022-02-23T03:36:21+00:00",
            "timestamp": 1645587381,
            "score": 1,
            "countLikes": 0,
            "reply": null
        }
    ]
}
```

[Documentation](../../README.md) > **AppInfo**
