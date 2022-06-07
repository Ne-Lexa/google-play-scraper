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
    public getDescription ( void ) : string
    public getIcon ( void ) : Nelexa\GPlay\Model\GoogleImage
    public getScreenshots ( void ) : Nelexa\GPlay\Model\GoogleImage[]
    public getScore ( void ) : float
    public getPriceText ( void ) : string | null
    public isFree ( void ) : bool
    public getInstallsText ( void ) : string
    public jsonSerialize ( void ) : array
    public getDeveloper ( void ) : Nelexa\GPlay\Model\Developer | null
    public getDeveloperName ( void ) 
    public getSummary ( void ) : string
    public isAutoTranslatedDescription ( void ) 
    public getTranslatedFromLocale ( void ) 
    public getCover ( void ) : Nelexa\GPlay\Model\GoogleImage | null
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
    public getSize ( void ) 
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
* [Nelexa\GPlay\Model\AppInfo::getDescription](appinfo.getdescription.md) - Returns a description of the application.
* [Nelexa\GPlay\Model\AppInfo::getIcon](appinfo.geticon.md) - Returns application icon.
* [Nelexa\GPlay\Model\AppInfo::getScreenshots](appinfo.getscreenshots.md) - Returns screenshots of the application.
* [Nelexa\GPlay\Model\AppInfo::getScore](appinfo.getscore.md) - Returns application rating on a five-point scale.
* [Nelexa\GPlay\Model\AppInfo::getPriceText](appinfo.getpricetext.md) - Returns the price of the application.
* [Nelexa\GPlay\Model\AppInfo::isFree](appinfo.isfree.md) - Checks that this application is free.
* [Nelexa\GPlay\Model\AppInfo::getInstallsText](appinfo.getinstallstext.md)
* [Nelexa\GPlay\Model\AppInfo::jsonSerialize](appinfo.jsonserialize.md) - Specify data which should be serialized to JSON.
* [Nelexa\GPlay\Model\AppInfo::getDeveloper](appinfo.getdeveloper.md) - Returns application developer.
* [Nelexa\GPlay\Model\AppInfo::getDeveloperName](appinfo.getdevelopername.md)
* [Nelexa\GPlay\Model\AppInfo::getSummary](appinfo.getsummary.md) - Returns a summary of the application.
* [Nelexa\GPlay\Model\AppInfo::isAutoTranslatedDescription](appinfo.isautotranslateddescription.md)
* [Nelexa\GPlay\Model\AppInfo::getTranslatedFromLocale](appinfo.gettranslatedfromlocale.md)
* [Nelexa\GPlay\Model\AppInfo::getCover](appinfo.getcover.md) - Returns cover image.
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
* [Nelexa\GPlay\Model\AppInfo::getSize](appinfo.getsize.md)
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
  -getDescription(): string: """
    Chop, bake, stew...\n
    Cook tasty meals with easy touch controls!\n
    Try out this unique cooking game.\n
    The yummy food you'll create will definitely make you…
    """
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
    -getUrl(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw=s0"
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
  -getScore(): float: 4.099868
  -getPriceText(): ?string: null
  -isFree(): bool: true
  -getInstallsText(): string: "50,000,000+"
  -jsonSerialize(): array: …
  -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
  -getDeveloperName(): mixed: "Office Create Corp."
  -getSummary(): string: "Make scrumptious food and serve it!"
  -getTranslatedFromLocale(): mixed: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw"
    -getUrl(): string: "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw=s0"
    -getBinaryImageContent(): string: …
  }
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_EDUCATIONAL"
    -getName(): string: "Educational"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_SIMULATION"
    -getName(): string: "Simulation"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getVideo(): ?Nelexa\GPlay\Model\Video: null
  -getRecentChanges(): ?string: """
    version 1.83.0\n
    Limited time recipe this time!\n
    Sugar donuts\n
    Play limited until the next update!\n
    Fixed certain bugs.\n
    Made balance adjustments.
    """
  -isEditorsChoice(): bool: false
  -getInstalls(): int: 70837754
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 91850
    -getFourStars(): int: 42887
    -getThreeStars(): int: 68083
    -getTwoStars(): int: 97389
    -getOneStar(): int: 510377
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getPrice(): float: 0.0
  -getCurrency(): string: "USD"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "$0.99 - $15.99 per item"
  -isContainsAds(): bool: true
  -getSize(): mixed: null
  -getAppVersion(): ?string: "1.83.0"
  -getAndroidVersion(): ?string: "4.4"
  -getMinAndroidVersion(): ?string: "4.4"
  -getContentRating(): ?string: ""
  -getPrivacyPoliceUrl(): ?string: "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/en/privacypolicy.html"
  -getReleased(): ?DateTimeInterface: @1431596563 {
    date: 2015-05-14T09:42:43+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1654156978 {
    date: 2022-06-02T08:02:58+00:00
  }
  -getNumberVoters(): int: 810624
  -getNumberReviews(): int: 15015
  -getReviews(): array: array:40 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHAAXG8BXRy7lxPy-39IZvy_NhBx4R5XHEUPWrfDeuYn9-8PZbX-P_Nh9yy4MntQZdeJhY-hr7f3kUflw"
      -getUrl(): mixed: ""
      -getUserName(): string: "anec nhoj"
      -getText(): string: "Really fun but I see what people mean about being overwhelmed. UI is constantly pointing, flashing, moving, popping up, etc. Also still has the same p…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJw1JMVmUbhz1otZesYQBzQ8d3UAcoigWO7ifkgJ=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJw1JMVmUbhz1otZesYQBzQ8d3UAcoigWO7ifkgJ=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJw1JMVmUbhz1otZesYQBzQ8d3UAcoigWO7ifkgJ=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1641771068 {
        date: 2022-01-09T23:31:08+00:00
      }
      -getScore(): int: 4
      -getCountLikes(): int: 308
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: "1.78.0"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOG7i_ZCbo_BlyazJQaU_t3x7RprKMJolFqBnO5isOWL6Hw5amSx9lIFZtzAUQb39stPnO66basadl3MaQ"
      -getUrl(): mixed: ""
      -getUserName(): string: "SuperiorX"
      -getText(): string: "Okay game, the game itself is super good and very unique to other cooking games, it has neat graphics and great effects, and the tutorial and GUI migh…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjUFDoAAL8tsZOPOYKfmGlzchY21job39MvuMQA4Q=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjUFDoAAL8tsZOPOYKfmGlzchY21job39MvuMQA4Q=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjUFDoAAL8tsZOPOYKfmGlzchY21job39MvuMQA4Q=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1650944257 {
        date: 2022-04-26T03:37:37+00:00
      }
      -getScore(): int: 2
      -getCountLikes(): int: 61
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: null
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
    "description": "Chop, bake, stew...\nCook tasty meals with easy touch controls!\nTry out this unique cooking game.\nThe yummy food you'll create will definitely make you hungry!\n\n▼Let's Cook! \nCook food by playing fun mini games. More than 30 kinds of recipes are waiting for you. Do your best, Special Chef!\n\n▼Happy Village! \nServe your cooking to everyone at your restaurant. Create a big and wonderful restaurant that's all your own.\nHarvest lots of things by going Fishing, growing plants in the Fields, and raising animals in your Ranch.\nGather up lots to exchange for Happy Foods!\n\n▼Game Plaza!\nPlay non-cooking games like \"Help out,\" \"Play Shopkeeper,\" and \"Exercise your brain.\" More than 30 kinds of mini games are waiting for you. Aim to get high scores!\n\n▼Challenge Ranking!\nCompete in weekly events for the best scores! Join the global rankings!\n\n▼Other Ways to Have Fun\n-Decorate the kitchen with various items.\n-Make surprise dishes by combining 2 recipes.\n-Watch realistic cooking videos for supported recipes.\n-Watch an animated video of Mama's fun daily life.\n\n[Game Features]\nWith its intuitive controls, both children and adults can enjoy the game. Also, even if you make mistakes there are no game overs, so everyone can complete dishes. Furthermore, children who play may develop an interest in cooking.\n\n[Recommended Setup]\nAndroid OS 4.1 or later.\n**Game may not be playable on certain devices even if the above conditions are met.\n\n**By downloading this game, you are accepting its User Agreement.\nhttp://www.ofcr.co.jp/APP_CookingMama/en/privacypolicy.html\n\n[Supported Languages]\nEnglish,French,German,Italian,Spanish,Dutch,Russian,Portuguese,Polish,Czech,Turkish,Japanese,Korean,Simplified Chinese,Traditional Chinese,Indonesian,Filipino,Malay,Thai,Vietnamese,Hindi,Spanish-mexico,Portugues brasileiro,Arabic,Persian,Swedish,Norwegian,Danish,Finnish",
    "developerName": "Office Create Corp.",
    "icon": "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw",
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
    "score": 4.099868,
    "priceText": null,
    "installsText": "50,000,000+",
    "cover": "https://play-lh.googleusercontent.com/2AkEZPx48hOnEJLjtTrmqnPqFOfgeE9COWfqCDRTzXCt0sI9yK9rXhSKs6-Uns9Tcw",
    "category": {
        "id": "GAME_EDUCATIONAL",
        "name": "Educational"
    },
    "categoryFamily": {
        "id": "GAME_SIMULATION",
        "name": "Simulation"
    },
    "video": null,
    "privacyPoliceUrl": "https://app-ofcr.com/OFFICE_CREATE/Website/APP_CookingMama/en/privacypolicy.html",
    "recentChange": "version 1.83.0\nLimited time recipe this time!\nSugar donuts\nPlay limited until the next update!\nFixed certain bugs.\nMade balance adjustments.",
    "editorsChoice": false,
    "installs": 70837754,
    "numberVoters": 810624,
    "histogramRating": {
        "five": 91850,
        "four": 91850,
        "three": 68083,
        "two": 97389,
        "one": 510377
    },
    "price": 0,
    "currency": "USD",
    "offersIAP": true,
    "offersIAPCost": "$0.99 - $15.99 per item",
    "containsAds": true,
    "appVersion": "1.83.0",
    "androidVersion": "4.4",
    "minAndroidVersion": "4.4",
    "contentRating": "",
    "released": "2015-05-14T09:42:43+00:00",
    "releasedTimestamp": 1431596563,
    "updated": "2022-06-02T08:02:58+00:00",
    "updatedTimestamp": 1654156978,
    "numberReviews": 15015,
    "reviews": [
        {
            "id": "gp:AOqpTOHAAXG8BXRy7lxPy-39IZvy_NhBx4R5XHEUPWrfDeuYn9-8PZbX-P_Nh9yy4MntQZdeJhY-hr7f3kUflw",
            "url": null,
            "userName": "anec nhoj",
            "text": "Really fun but I see what people mean about being overwhelmed. UI is constantly pointing, flashing, moving, popping up, etc. Also still has the same problems as original cooking mama games on other platforms - frustrating mechanics, for example, though they are more manageable mobile. But it does improve upon them, and even adds awesome new features to try out. Great fun!",
            "avatar": "https://play-lh.googleusercontent.com/a/AATXAJw1JMVmUbhz1otZesYQBzQ8d3UAcoigWO7ifkgJ=s64",
            "appVersion": "1.78.0",
            "date": "2022-01-09T23:31:08+00:00",
            "timestamp": 1641771068,
            "score": 4,
            "countLikes": 308,
            "reply": null
        },
        {
            "id": "gp:AOqpTOG7i_ZCbo_BlyazJQaU_t3x7RprKMJolFqBnO5isOWL6Hw5amSx9lIFZtzAUQb39stPnO66basadl3MaQ",
            "url": null,
            "userName": "SuperiorX",
            "text": "Okay game, the game itself is super good and very unique to other cooking games, it has neat graphics and great effects, and the tutorial and GUI might get overpowering, but once you're done with the tutorial, you wont get so much stuff blown into your face. There is a MAJOR problem with this game though, it keeps crashing during gameplay, you might think its not a big problem, but if you're cooking a big dish and trying to get a perfect score, it also crashes on multiple devices. 4/10",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GjUFDoAAL8tsZOPOYKfmGlzchY21job39MvuMQA4Q=s64",
            "appVersion": null,
            "date": "2022-04-26T03:37:37+00:00",
            "timestamp": 1650944257,
            "score": 2,
            "countLikes": 61,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHruDADn6znn_iAwdyzCv9v5NtIJVi2Hqyj-_MPhtXG_AYrxTiNzM3teuAT2b1pBp-BWNoiGpf8EyT9WQ",
            "url": null,
            "userName": "A Google user",
            "text": "A good classic game, but it's probably too complicated all at once. Perhaps unlock fishing or other minigames at a higher level. Maybe clear explanation for use of coins and 'happy foods'. I also think that there is a few too many ads to where it kind of gets in your face and diminishes the experience of the game. There are also some translation errors that could be improved.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.53.0",
            "date": "2019-11-26T18:44:16+00:00",
            "timestamp": 1574793856,
            "score": 3,
            "countLikes": 88,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHPJPLG7r1ijMm0WpIYr_Kd5UkfgX9lcuWZjQlOLFS2_Lu931PFBuVqYNARF1KWgTPw63Icg_wkCJJukQ",
            "url": null,
            "userName": "A Google user",
            "text": "This game is both pretty good and kind of frustrating at times. I like the mini cooking system, since it basically makes the game free to play. There are a LOT of pop ups, which can be annoying/overwhelming; and some of the minigames were nearly impossible for me, since the instructions were unclear. I ultimately still like playing, though, because there is just so much to do. I did end up purchasing a large recipe pack, and I do not regret it at all.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.47.0",
            "date": "2019-04-27T23:30:54+00:00",
            "timestamp": 1556407854,
            "score": 4,
            "countLikes": 1162,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHUr6M9iXzMTyrEUkLLuziN4lO3y1OPatd87Me1MXf5dyDEI8yAJIHK5z-dsS5RN5JT8mcPD6lrtJ3MKw",
            "url": null,
            "userName": "A Google user",
            "text": "This game wasn't what I'd hoped it'd be. The tutorials are rushed, the graphics are so-so, the controls sometimes fail to respond, and there's almost always something flashing for attention on screen. To top it off I couldn't watch any of the animation/cooking videos for some reason. However it does use an interesting combination of old & new mechanics with familiar sound effects. The new things it tries are a bit hit-or-miss for me, but the thought counts. I'd say try it anyway just in case it.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": null,
            "date": "2019-07-16T21:08:40+00:00",
            "timestamp": 1563311320,
            "score": 2,
            "countLikes": 4,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFvDF-EE9EmST-j0Rc1LhtiGipJVnffke4zJp24OKcimy0vV45YyKXmZwYiWXmbuD8IgfNPO0BK3wtXIw",
            "url": null,
            "userName": "Kelly Martin",
            "text": "I thought it would be great nostalgia but I deleted it within a few hours. There is so much stuff you can do that it's overwhelming and there are so few dishes you can make that it's boring (Unless you pay for more). I don't know how they managed to do both but they did. It also asks you to watch an ad after every. Single. Thing. You do. I even got unskippable ads that gave me no rewards so what was the point? On the plus side, the actual cooking part feels like the wii game and is still fun.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GhFvGObXXq0nRlly1PkoQ7-8CCXzl8uPk2Tr_Xd=s64",
            "appVersion": null,
            "date": "2021-02-11T20:48:54+00:00",
            "timestamp": 1613076534,
            "score": 2,
            "countLikes": 5,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFeRKkKdZ43LBuykpI_iNIRU2yfObTAt7RXsLMoZlDraA2hXO2NtbEy5ExtIl6G7jzaoYlHixYF8SJypA",
            "url": null,
            "userName": "Exhausted Companions",
            "text": "I found the limited recipes really frustrating, mostly because I tend to do a lot of things in a small amount of time, but the way getting new recipes work didn't allow that. The visuals were immensely confusing, with multiple pop-ups layering and those pulsing icons absolutely *everywhere*. I got this game solely to cook, and the whole village thing felt unnecessary to me, but if you like that type of game play, go ahead and try it out. However I liked the way cooking worked",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GgHflIy53y3LEEhR4Ky2lavMiXcmCao0GoP2ySkDA=s64",
            "appVersion": null,
            "date": "2021-07-26T04:47:47+00:00",
            "timestamp": 1627274867,
            "score": 3,
            "countLikes": 3,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGYPsaYdZr65E5llZpBrtUWqfwmaSTa55WmiV3Nb632Wk_8MigD3hWaVfO1fxKYw986mdrfGlvrOCuWFQ",
            "url": null,
            "userName": "A Google user",
            "text": "This game is absoluteley amazing i recommend this game to anybody who wants to cook without the mess, or just as a fun game. The game is very simple, but just saying that some of the directions/instructions are a bit confusing, but simple to understand after getting a sense of the game. Definitely not a waste of space, and many other activities to enjoy in the game like farming, fishing, opening a restaurant,and much more!",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.48.1",
            "date": "2019-06-24T16:47:33+00:00",
            "timestamp": 1561394853,
            "score": 5,
            "countLikes": 34,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFVxLl2oMiG8AHGOAQRK0kw1gU0xRn6YB02YJS2xzMq8TMTJz7MhYxmEbaE8oW64rkhVjrkfUTTI_VUqQ",
            "url": null,
            "userName": "A Google user",
            "text": "Overall I like the game play but there are too many things on the menu screens at one time, I have no idea what is what; to much clicking to get to things; the activities to get supplies make you sit there until the time runs out, I don't like wasting my time to sit and wait for something to complete especially on more than 1 activity; I cannot unlock other recipes without paying for them & there are not a lot of choices for free overall. In the end, the DS version is the still best.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.53.0",
            "date": "2019-11-13T06:25:55+00:00",
            "timestamp": 1573626355,
            "score": 3,
            "countLikes": 50,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHpaBO_cU60tFOHDGopQIaAzFOB2x9_ra5r-L-fIBJ_c_M0WrbwW7x8YJBtpJbbzi_Tt8eyKrufv3OYyg",
            "url": null,
            "userName": "A Google user",
            "text": "Flash! Dance! Bounce! Attention! Happy food! Buy buy buy! Watch this ad! More ads! Ads? More! With the attention span of a chipmunk, I was seriously overwhelmed by the sheer busyness of the interface. I've always been a fan of the original as something to pass the time, and I was looking forward to something new. Ended up uninstalling after about 30 minutes. Epitome of micro transactions.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": null,
            "date": "2019-03-19T01:46:05+00:00",
            "timestamp": 1552959965,
            "score": 2,
            "countLikes": 0,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHkxR4DN_VnPlC1uKRbol9--qITd4WdZ-UH66uSSiQLJ0QZqUol8o9RvWrniFND7q6dyDWtIl05ywK4JA",
            "url": null,
            "userName": "A Google user",
            "text": "\" Even better than mama \" You can only hear that phrase so many times before you slowly go insane. Started out as a complex cooking game, that took you through each step of the recipes process. To a frustrating, confusing set of several games. While they're all \" related\" to the food/cooking process it gets to be overwhelming. Graphics are not bad, directions for each game *eh* so-so. Wasn't thrilled with time limits. Did like that I could keep trying. $$$upgrades not a keeper for me.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": null,
            "date": "2019-12-16T18:12:37+00:00",
            "timestamp": 1576519957,
            "score": 3,
            "countLikes": 6,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFABgT5TV9GwQoiH-aq2o-PmZHvwlnCdPhfDtEkMTRMEx4wm2sPsVtHGBpIB9F8IFi5djQ2Eix8TVi-6Q",
            "url": null,
            "userName": "JaNene Thomas",
            "text": "The gameplay is fantastic, it can keep you entertained for hours. My biggest issue is the unrelenting ads. Out of nowhere, you will be hit with a full screen, unskippable ad and the longer you play, the more frequent the ads become. Having optional ads and microtransaction content is fine, but shoving an ad down my throat when I'm in the middle of something is very disorienting and I have closed the app many times mid-ad because I was so frustrated.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GiOhgeDPJf_oORVhQIUOSBiIJWL9yXuIO-q6y3bIw=s64",
            "appVersion": "1.73.0",
            "date": "2021-09-01T15:57:53+00:00",
            "timestamp": 1630511873,
            "score": 3,
            "countLikes": 248,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGzA4ejItcJZ1JbHd3jC6Xaaim6bfak-PUkrpAnN-3hPvKrl46c9lkuLmNmjsUh7y57ahLiQT8RTfNqaQ",
            "url": null,
            "userName": "A Google user",
            "text": "the ONLY reason its not a 5 star game is because of the extreme overload of graphics and distracting things happening on the screen menu's. The making of the recipes is exactly like the DS game which is amazing!! However, there is too much unnecessary stuff going on and its overwhelming. Cut down on the pop up menus and itll be a 5 star game EASILY!!!",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.45.0",
            "date": "2019-05-13T05:21:00+00:00",
            "timestamp": 1557724860,
            "score": 2,
            "countLikes": 55,
            "reply": null
        },
        {
            "id": "gp:AOqpTOH-VoA0u9Mh-AxOrBtQNu8-jnMQqBNKCJyoqx577WWE1hoDv-62y7zihMT9ngz-v6d0MEeByRDmgAA4GA",
            "url": null,
            "userName": "Omni Bailey",
            "text": "While i will say it is a good game,i very much prefer the ds version. This one seems to dumb down a lot of the reciepes, which I understand why. It makes the game a lot more appealing to younger kids and makes the game easier. Like with the times event on the stove, in the old game you had to do them when it appeared on the screen in the amount of time given and there would be a set time between actions, now you just have to do it and it will move onto the next. Otherwise its a good game.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GgyHywYqWRn6hz9RcAZJEPQF81KVSMejv9CZoGt3g=s64",
            "appVersion": null,
            "date": "2021-06-22T01:27:36+00:00",
            "timestamp": 1624325256,
            "score": 4,
            "countLikes": 2,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFX8HbHnuyY5FzjegmVjuDwwsmYsjWRtcLkyDfCN_PzD7Oooc5LFcvddAGqqv7Ka5p7HZskwSJjHts4RQ",
            "url": null,
            "userName": "A Google user",
            "text": "Great game, only gave it four stars though because the Ads can get a tad bit tedious and the game rarely likes to complety crash on me when doing certain tasks like feeding customers. It's not taking progress away or anything, but it can be kind of annoying. Either way I recommend this game if Ads and very rare crashing don't bother you too much.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.49.0",
            "date": "2019-06-27T10:14:13+00:00",
            "timestamp": 1561630453,
            "score": 4,
            "countLikes": 89,
            "reply": null
        },
        {
            "id": "gp:AOqpTOEaPvrjTYYmWUjp0dkSX-mMhuL5058Hzl9qG-Tg4iGdVYhqTU6NpeJYjPSoU0d1YDyUgypgmV6m0wFjDA",
            "url": null,
            "userName": "rose flores",
            "text": "The cooking part in itself is really fun and acts like any other cooking mama game. However, there are soo many different gameplay options that it's overwhelming. Plus you have to pay for a lot of things. I kinda wish it was just the cooking part and nothing else, but if you're into that plus fishing, gardening, restaurants, and farms then give it a go",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GhG4kaaBxFxiJxmJOsaDJRjxT7S2oBUwLIEaoVtgw=s64",
            "appVersion": null,
            "date": "2021-03-25T05:11:31+00:00",
            "timestamp": 1616649091,
            "score": 3,
            "countLikes": 2,
            "reply": null
        },
        {
            "id": "gp:AOqpTOH2oaWdjgsbQ4BC4vBIrsS0yuPxMunaW1K4-FBJC6LcUJJDSFeqahL8E69I3u__7cQZYmZBB_6Q3VwmDw",
            "url": null,
            "userName": "Samantha Sims",
            "text": "Fun game, but way too many pop-ups. The ads aren't a problem, but on every screen there are at least a dozen things to click through reminding you of some mechanic, or another screen you could look at, or any other random thing. It gets very annoying, and if there was any way to turn that off, this would easily be a five star game.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Gj-M7Tu1WUQaxNy53_eSVLrtyrxuXO1t7X8KKE=s64",
            "appVersion": "1.76.0",
            "date": "2021-11-08T15:44:07+00:00",
            "timestamp": 1636386247,
            "score": 2,
            "countLikes": 322,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHXIkV9f-3VKA1TocNIZD8dDtqEQRG1f-UneAqdHPIeRab6VrxUdUQ51AUv3ArAPW63FzFwcPPZ9lMIWQ",
            "url": null,
            "userName": "Megan Utter",
            "text": "The entire app has too many mini games and areas to keep track of that it's overwhelming and the experience is very clunky because of it. You have to cook recipes, but also manage a restaurant, but don't forget the challenges, you've also gotta get your dailies, etc. It's too much and with so many pop ups it feels like such a ploy for a money grabbing app using people's nostalgia to get it. Very disappointing, and not at all what I wanted out of a Cooking Mama game.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Gg4Dz2YHUluFgZ_KS5buteX8Fb-pDQ9i3tQinya=s64",
            "appVersion": null,
            "date": "2021-08-31T15:49:25+00:00",
            "timestamp": 1630424965,
            "score": 2,
            "countLikes": 10,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFEROPRy-WDm4HtGmEaexxAmrzaYyj2o3mB6f4zOFi5WxB6Md3u9ffoMhvjEBnO7mrgB07M24w7IAmWqg",
            "url": null,
            "userName": "Leon Williams",
            "text": "Even though this game is adicting and I am looking forward to the Nintendo Switch and PS4 game to become digital (hopefully there will be a demo), it just lacks visual quality. Almost all of the images in the game are very blurry and the 3D models, especally Mama, is very blocky, although it may be a benifit to devices that can't run high quality games, at least improve the quality just a bit. Also almost all the recipies are DLC. This app brings back memories from when I had it before years ago",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GgjDA6bUDjAWGiDFg6vq1VOkXW7lr2m2uSXpBETWA=s64",
            "appVersion": "1.69.0",
            "date": "2021-04-14T17:01:17+00:00",
            "timestamp": 1618419677,
            "score": 4,
            "countLikes": 317,
            "reply": null
        },
        {
            "id": "gp:AOqpTOE-aHOBoEWJ650psTfLSIq3rPHGvsUpOZvl4-nWk7wPAtrfOPukEcHlTTxt1vFGwCn0i46uJpQ8noiPBA",
            "url": null,
            "userName": "A Google user",
            "text": "I enjoy playing this game... when it works. There are times throughout game play where the screen responds to my touch but doesn't do what it's supposed to based on my gestures by what the directions tell me. To avoid myself further frustration, I've uninstalled because the times within the game when it acts up ruins everything and is awfully convenient.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": null,
            "date": "2019-05-14T16:01:32+00:00",
            "timestamp": 1557849692,
            "score": 3,
            "countLikes": 3,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGeW66KBgr1DRxyQZ2-otp3gw9zpoi7oLl3f6Lflr059Wv3ClL9mzd1qmtgZJDdgsZEwqJXK8etozIiiw",
            "url": null,
            "userName": "A Google user",
            "text": "so i used to play this game way back when, i loved it (still do). my only issue is that there's way too many things going on, back then it was just you cook and if you wanted more dishes just keep cooking. now the game has \"stamp rallies, promotions, happy foods, fishing, the restaurant, etc\" i dont mind having more things i think its great but i feel like its just too overwhelming the amount of things that pop up at my face when i open the app. all in all its not a bad game",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.45.0",
            "date": "2019-03-03T08:57:42+00:00",
            "timestamp": 1551603462,
            "score": 3,
            "countLikes": 84,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHKOKTbqKdMRi01uw5GfJdXDU7aC0rzv3vc-BlkT4cYFjy4AzvSMg1N6_Sf6XzkRyJVq8vJz9Y7UygVpg",
            "url": null,
            "userName": "A Google user",
            "text": "I loved the DS series as a kid and was excited when I saw this. While it did bring back old memories and the recipes I could unlock were fun, most are locked behind a pay wall. They're also much simpler and don't take very long to do, so not really worth the prices they're asking for. The interface is also extremely busy and it constantly feels like I'm on one of those scam websites with all these popups. You're better off playing the original games.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.56.0",
            "date": "2020-02-07T04:56:29+00:00",
            "timestamp": 1581051389,
            "score": 3,
            "countLikes": 237,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGzRvDPo70s4ircscCgdDdPfadlTpYrEGhtMzk1zAwXsMVRosPA6hp-PWuHebXnM7WhYRPGvS7DvmpHbA",
            "url": null,
            "userName": "A Google user",
            "text": "This app is a mess. It looks like the aftermath of a freemium store explosion, with the moment you open it, and there are a billion different things vying for your attention with very little of the design telegraphing what you're actually getting into when you tap it. The actual gameplay is fine but the extensive advertisements between every level are a huge drag. You're better off buying one of the real versions of Cooking Mama and playing it on 3DS or Switch.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": null,
            "date": "2019-05-26T01:03:42+00:00",
            "timestamp": 1558832622,
            "score": 2,
            "countLikes": 8,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHg3cA2IheJ9auqbzy3Wgw-WdmXYjJimpVFjHZD5ohA7xbwwzv26bWqM1myJZnbYoAG8pXch5tzefx1Tw",
            "url": null,
            "userName": "A Google user",
            "text": "Fun once you pay for the Standard Pack ($10-15 w/40 recipes). But once you finish those recipes, you have to BUY MORE RECIPES. With REAL CURRENCY. If you find spending money enjoyable, good on you. But I don't. Here's a brief idea of this game's expenses: There's 4 other packs consisting of 12-20 recipes each and priced around $5-$9. You also have the option to purchase sets within the pack for $1-$2 consisting of 2-4 recipes.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": null,
            "date": "2020-04-24T05:37:18+00:00",
            "timestamp": 1587706638,
            "score": 3,
            "countLikes": 3,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGrrqYR3TtmeoSvDK60nqPnf-c0sxNSl1VZhXCmQQwugMCLU74KXqAv5TqCPPi8lJiJidKRi1ZLD5b7GA",
            "url": null,
            "userName": "Egg",
            "text": "wanted to love. have fond memories of the ds games, but theres too much going on here! lots of minigames, but too many, with too many steps! and ad watching bonues are everywhere, after every step of cooking and minigames. i get that ad revenue supports, but it needs better balancing. the colors are also too harsh and not coordinated, so eyestrain would be an issue if you play a long time",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Gh4AWiDj9vAgmTAOHoFMJYVAVhbPG6NoRul6Sx4=s64",
            "appVersion": null,
            "date": "2021-10-20T21:11:35+00:00",
            "timestamp": 1634764295,
            "score": 3,
            "countLikes": 23,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHJt7nQQvu2aSo-39A0ue0hAqUYLPhcCRRmHlIS5q1qDyzorOpjAUKD3pn-eP0P3X5GU7MunEj_4X0BBg",
            "url": null,
            "userName": "Janelys De Santiago",
            "text": "This game is overmonetized. It is not healthy for a child. Everytime you finish one step it asks you to see a long ad so you can earn money. But it's free right? Well, the ads pop up on their own over and over again to the degree that you are most of the time watching ads instead of playing. I dread to open the app everytime because it will make me stuck watching ads. The background is overwhelmingly messy. The music is repetitive. Some Things you either buy or watch infinite ads for 3 coins.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GiGNo3cl_A2GZpPOEuDEQNvFDjaO9_AsumwRuV-xQ=s64",
            "appVersion": "1.61.1",
            "date": "2020-07-19T00:21:01+00:00",
            "timestamp": 1595118061,
            "score": 1,
            "countLikes": 98,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFjeUomNAUFYrS9SWwrK0HRszO931HXrDh4ACAkfwLe_wHM5sokMRCaJ1tLycCSnOTrRQJjX54u417RCg",
            "url": null,
            "userName": "KVRtist",
            "text": "Don't get me wrong, I LOVE this game. But the excessive crashing and refusal to start up makes it almost impossible to play and enjoy. Im always having to reinstall the game, losing my progress. Hopefully this issue gets resolved. (Edit: I now can't load the game at all without uninstalling every time I want to open it and constant frozen screens. Had to permanently uninstall 😔)",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GhBJKh8DteKmqLPCRsSVLdBnUuN8yWsmgRIKpCdGQ=s64",
            "appVersion": "1.66.0",
            "date": "2021-01-05T14:51:10+00:00",
            "timestamp": 1609858270,
            "score": 1,
            "countLikes": 418,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGdACYJNyv_8vjKZs24xPO09irRNTb0hBmVvb4TEsCdR9AA64bDCQUGbqNabD9e-Bpo5748chmeiNBt8g",
            "url": null,
            "userName": "Isa Maria",
            "text": "Best tycoon/simulation game I've ever played!! I love the details and how many things you can do, from changing clothes & hair, to cooking & editing the restaurant to look cute! Same with all the fields you can decorate & harvest from. There is ALWAYS something to keep me occupied. Only reason I do 4 & not 5 stars.. is that they put a cap on the money of $999. So once you reach it, its like why even play some days? Otherwise my favorite app for sure ! ♡",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Giq1yHjmKzXpVLwY5osCj3e4Y-qLNuM9E674jXuyvg=s64",
            "appVersion": "1.68.1",
            "date": "2021-03-06T00:46:52+00:00",
            "timestamp": 1614991612,
            "score": 4,
            "countLikes": 934,
            "reply": null
        },
        {
            "id": "gp:AOqpTOEVIyLHy7GeADl2WpsaKxvv-SXhuJYPiqNfa5dTjpMEZICiDgygGY63I3bXGiSFPR5fw6-NOxpLLqrB8Q",
            "url": null,
            "userName": "A Google user",
            "text": "I use to enjoy the DS version but this not as enjoyable as those. It constantly pops up asking you to buy recipes or watch an ad. It's ok but I lost interest quickly. The crop and animal care mini games are repetitive. The restaurant mini game is also boring. They have been done better in other apps.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.42.0",
            "date": "2018-12-11T02:20:11+00:00",
            "timestamp": 1544494811,
            "score": 1,
            "countLikes": 73,
            "reply": null
        },
        {
            "id": "gp:AOqpTOGAqKCki_4zO2Scm1Kwzgj11pBmKja95mgXbz7do2-yN3ynqWyp9Xv_U8MThrhiK29gjvB2L62NZYlgbg",
            "url": null,
            "userName": "A Google user",
            "text": "This is not fun or even a realistic way of cooking. The music is a 3 second loop and the ads are ridiculous. I did 3 recipes and I didn't even try to do good on them and I got a perfect score. Don't get this unless you like listening to crappy music and doing boring tasks",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.42.0",
            "date": "2018-12-05T05:39:12+00:00",
            "timestamp": 1543988352,
            "score": 1,
            "countLikes": 152,
            "reply": null
        },
        {
            "id": "gp:AOqpTOFbecHGP290JLqeAr7XRQ2AcXNYRqm_6DNfXIS4VLYgKETBv3kW2CEdu0q0yOMXatSysXtekeqfoJA9Dg",
            "url": null,
            "userName": "A Google user",
            "text": "I love this so much; it is so lovingly made and really fully realised and polished. I was surprised that an app instalment in a video game series would be so well made and dense with things to do. It has so much work put in to it and so many fun things to do. This is a fully realised game that just happens to be for phones. I do need to report one bug I noticed though, which is that for some reason the making your first combined recipe's achievement isn't being earned despite me doing it a lot.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.48.1",
            "date": "2019-06-14T02:54:19+00:00",
            "timestamp": 1560480859,
            "score": 5,
            "countLikes": 61,
            "reply": null
        },
        {
            "id": "gp:AOqpTOH2EHAo1hc_Kujapveu5WTS_iP4Sc0lASv8K9c_LlSpWaCkXZLLL7qaGqCJbB0b9zioTZJxTRoOXDZpcQ",
            "url": null,
            "userName": "A Google user",
            "text": "Unskippable ads after every level is so annoying. At least make them skippable. And the entirety of the menu is so busy and distracting there's so many things taking up space. Prompting to watch an ad after every single step and being unable to get rid of it until after a good few seconds make me really just want to not invest time into this.",
            "avatar": "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64",
            "appVersion": "1.55.1",
            "date": "2020-01-09T05:18:29+00:00",
            "timestamp": 1578547109,
            "score": 1,
            "countLikes": 821,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHFXuwGaEpk42tc85vBcfy9RBXH-DzFSJwtPChEbIy75tZKmZNH1PewWOO-NTqvkCRhQgkmPJY3z_Q6uA",
            "url": null,
            "userName": "Shrimp Ryo",
            "text": "Expected it to be like the DS games but it had too many mini games. It's very overwhelming and there's no clear instructions. The constant onslaught of ads were the last straw. Update: Found a way to temporarily stop the ads.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Gho1rat22Z3CswIiYh1NjbnWzMkd5LinJxujTuWeI0=s64",
            "appVersion": "1.82.0",
            "date": "2022-05-08T16:04:16+00:00",
            "timestamp": 1652025856,
            "score": 2,
            "countLikes": 210,
            "reply": null
        },
        {
            "id": "gp:AOqpTOH9vITXo11KP8gZjeNwXCxPlABFzMjEo-Wdldq_bKwnjee7BxNdNgfl-6UjtP61ckCKe1ZvrIbf8KpNTQ",
            "url": null,
            "userName": "Melody Lastname",
            "text": "everything is great , except the happy market. i feel like the happy market was implemented with no real purpose being added to the game , other than to see a number go up. id like to see this changed in the future to make the happy market feel more useful. the time limitations on the orchard and not allowing afk farming off fields (not to mention not offering an upgrade option to do so either) it just feels like the entire market and farming system needs an update.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GgTFGVljKAAxbw1CvU3TWwsQf9XU1mJBPyOoeMvKA=s64",
            "appVersion": "1.82.0",
            "date": "2022-05-16T08:57:10+00:00",
            "timestamp": 1652691430,
            "score": 4,
            "countLikes": 143,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHKF4JKyv6LkjhMTLzBiab4Y_XAJ1S8PegqcsOwibUyL5vQ8PXxr1IXWCLgWt_TTWzyZAqyg27PV9Fy1A",
            "url": null,
            "userName": "Marco Montesinos",
            "text": "It's okay, fun and all but EVERYTHING costs money, of course you can get coins but to get the minimum you'd need to play for weeks. Plus the ads kind of ruin the experience, you have to watch ads for a lot of things, or of course you can pay. Definitely this could be better but the devs only care about money 🤷🏻‍♂️",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Gi8YDUhT5qNk_ADUXeG5hkq91UT5YHxqypAKo0-0w=s64",
            "appVersion": "1.81.0",
            "date": "2022-04-25T21:50:55+00:00",
            "timestamp": 1650923455,
            "score": 3,
            "countLikes": 222,
            "reply": null
        },
        {
            "id": "gp:AOqpTOG6BXHL4huvILSNjhq_-i2jN3teMiiK10zo1U68LZK5tMQcdGRM0_EKGU2-VNy9X2aZdzsn095pr_s9Mw",
            "url": null,
            "userName": "My Monkeey and Me",
            "text": "Constant freezing and crashing. I can't even make it thru 1 recipe and 9 out of 10 times, it doesn't even get thru the loading screen at the opening of the game and it crashes. I literally just want to play Cooking Mama, but it is absolutely impossible. Don't waste your time downloading because it will probably do the same thing for you. What an utter disappointment.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GgvjvcmbveLiN73OoLJlrdjXg96ZT1oc9EZPf4wvLM=s64",
            "appVersion": "1.81.0",
            "date": "2022-03-29T01:58:41+00:00",
            "timestamp": 1648519121,
            "score": 1,
            "countLikes": 272,
            "reply": null
        },
        {
            "id": "gp:AOqpTOHdCkei8TjqNPi3hyDGPn3F6FPnn1UZwR7DwHrVcykzb-yb2_CpkFErIIFc4mmzAlVVXgrMHTmbDQPyfA",
            "url": null,
            "userName": "cricketandgraham",
            "text": "Amazing, PERFECTION. Don't trust one star reviews, usually crashing or glitching heavily is the devices problem, not the game. Super fun and great. \"Don't bother downloading\" uhh no, it's great. Please play it, you wont regret it.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GhEGf8hnTYO5QYQVp2WIThm266AmKeCejRLZ1W-nw=s64",
            "appVersion": "1.81.0",
            "date": "2022-04-03T20:10:26+00:00",
            "timestamp": 1649016626,
            "score": 5,
            "countLikes": 474,
            "reply": null
        },
        {
            "id": "gp:AOqpTOH6SXnXusqcz4yVt_Jcw8rZDI5wBGyLmjxzqi2iRqWbK1nbryoJaWfwE5HO01OemP2UWSTaU_GpXG0m7Q",
            "url": null,
            "userName": "Jeannie Racano",
            "text": "This is a really nice game. There are a lot of ads, but they're typically easy to close without sending me directly to the play store. There are a decent amount of ways to get recipes. I would give it 5 stars if there wasn't a cap on the coins you can have at one time, or time limits on the games.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GgsRh2o4bi9Ab4OlTCkeUYs38HjidRCGyDBFXIWmA=s64",
            "appVersion": "1.81.0",
            "date": "2022-04-18T19:11:27+00:00",
            "timestamp": 1650309087,
            "score": 4,
            "countLikes": 49,
            "reply": null
        },
        {
            "id": "gp:AOqpTOH4O7_VcaI9E34BtZfJ1RdNvgh4qDLA8Foc0_0f9Hka5PWaUDT4zFXJLmTWiXGn8UbHDG0p8Q4SskjYAg",
            "url": null,
            "userName": "White Panther",
            "text": "My earliest experience playing Cooking Mama was when I first got it on my DS. I remembered the thrill of making new dishes and Mama cheering me on as I did things perfectly or when she scolded me for doing something wrong. I feel like this version is just a bit too easy, I understand its more tailored towards little kids but for Cooking Mama veterans like me it just doesn't hold the same thrill. There are also too many things going on in the game like the minigames and quests. But so nostalgic.",
            "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GiqoqHzX7cuNckA9el1kpdELzFS1tAbXQTjLOeO=s64",
            "appVersion": "1.82.0",
            "date": "2022-05-18T22:47:20+00:00",
            "timestamp": 1652914040,
            "score": 3,
            "countLikes": 18,
            "reply": null
        },
        {
            "id": "gp:AOqpTOEUcK-hNfRvEFKA_FcEzr8NA8B5EZwiqyZtN25YFyjj48KRar8D_giG6NIHCWLKl0sl6vhvGPw7wAAHOQ",
            "url": null,
            "userName": "Tevecia James",
            "text": "It is not a horrible game.The levels stop at 10. The part of the game that is horrible is you have to cook in order to boost back the food when it is finish and enough food stamp is not there when in need. Wonderful game tho!!! 😍😍😍",
            "avatar": "https://play-lh.googleusercontent.com/a/AATXAJxTavWHCaZYpF9RhMswUQECNLpOIGKYvAHLQCVY=s64",
            "appVersion": "1.82.0",
            "date": "2022-05-29T01:09:01+00:00",
            "timestamp": 1653786541,
            "score": 3,
            "countLikes": 22,
            "reply": null
        }
    ]
}
```

[Documentation](../../README.md) > **AppInfo**
