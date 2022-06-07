[Documentation](../../README.md) > **Review**

# The `Nelexa\GPlay\Model\Review` class

## Introduction
Contains review of application on Google Play store.

## Class synopsis
```php
Nelexa\GPlay\Model\Review implements JsonSerializable {

    /* Methods */
    public __construct ( string $id , string $userName , string $text , Nelexa\GPlay\Model\GoogleImage $avatar , DateTimeInterface | null $date , int $score [, int $likeCount = 0 ] [, Nelexa\GPlay\Model\ReplyReview | null $reply = null ] [, string | null $appVersion = null ] ) 
    public getId ( void ) : string
    public getUrl ( void ) 
    public getUserName ( void ) : string
    public getText ( void ) : string
    public getAvatar ( void ) : Nelexa\GPlay\Model\GoogleImage
    public getDate ( void ) : DateTimeInterface | null
    public getScore ( void ) : int
    public getCountLikes ( void ) : int
    public getReply ( void ) : Nelexa\GPlay\Model\ReplyReview | null
    public getAppVersion ( void ) : string | null
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Review::__construct](review.__construct.md) - Creates an Android app review object in the Google Play store.
* [Nelexa\GPlay\Model\Review::getId](review.getid.md) - Returns review id.
* [Nelexa\GPlay\Model\Review::getUrl](review.geturl.md)
* [Nelexa\GPlay\Model\Review::getUserName](review.getusername.md) - Returns the username of the review author.
* [Nelexa\GPlay\Model\Review::getText](review.gettext.md) - Returns the text of the review.
* [Nelexa\GPlay\Model\Review::getAvatar](review.getavatar.md) - Returns the user's avatar.
* [Nelexa\GPlay\Model\Review::getDate](review.getdate.md) - Returns the date of the review.
* [Nelexa\GPlay\Model\Review::getScore](review.getscore.md) - Returns a review rating.
* [Nelexa\GPlay\Model\Review::getCountLikes](review.getcountlikes.md) - Returns the count of likes of the review.
* [Nelexa\GPlay\Model\Review::getReply](review.getreply.md) - Returns a reply of the review.
* [Nelexa\GPlay\Model\Review::getAppVersion](review.getappversion.md) - Returns the version of the application for which the comment was made.
* [Nelexa\GPlay\Model\Review::asArray](review.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\Review::jsonSerialize](review.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\GPlayApps::getReviews()](../GPlayApps/gplayapps.getreviews.md) - Returns reviews of the Android app in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getAppsInfo()](../GPlayApps/gplayapps.getappsinfo.md) - Returns detailed information about many android packages.
## Sample object content
```php
class Nelexa\GPlay\Model\Review {
  -getId(): string: "gp:AOqpTOFvc086CKRg0slbv_yLZ15HDwE7jwBZAmhWwo7EG6RcUaINxiStjK4rgswSckGkQlS6JrJK0BjcPiSIZA"
  -getUrl(): mixed: ""
  -getUserName(): string: "Selin B"
  -getText(): string: "This app -in Turkey- forces you to use the most expensive highway. It used to show 3 shortest routes, sorted by time. Now default route is the most ex…"
  -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gh5XHzZhoKfopnMpk-LSb-Ik5vQHQ9z7x-RsZQW5Q=s64"
    -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gh5XHzZhoKfopnMpk-LSb-Ik5vQHQ9z7x-RsZQW5Q=s64"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gh5XHzZhoKfopnMpk-LSb-Ik5vQHQ9z7x-RsZQW5Q=s0"
    -getBinaryImageContent(): string: …
  }
  -getDate(): ?DateTimeInterface: @1616155943 {
    date: 2021-03-19T12:12:23+00:00
  }
  -getScore(): int: 1
  -getCountLikes(): int: 166
  -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
    -getDate(): DateTimeInterface: @1616237045 {
      date: 2021-03-20T10:44:05+00:00
    }
    -getText(): string: "Please write to us through the "Feedback" menu of the Navigator or app-navigator@support.yandex.ru. Specify what route and between what points you tri…"
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getAppVersion(): ?string: "5.31"
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($review, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "id": "gp:AOqpTOFvc086CKRg0slbv_yLZ15HDwE7jwBZAmhWwo7EG6RcUaINxiStjK4rgswSckGkQlS6JrJK0BjcPiSIZA",
    "url": null,
    "userName": "Selin B",
    "text": "This app -in Turkey- forces you to use the most expensive highway. It used to show 3 shortest routes, sorted by time. Now default route is the most expensive one where the second best is the most crowded and longest route. The \"reasonable\", relatively cheaper and relatively crowded highway is not even an option, and pass points on that highway can't be added manually. Switched to other nav apps for that reason.",
    "avatar": "https://play-lh.googleusercontent.com/a-/AOh14Gh5XHzZhoKfopnMpk-LSb-Ik5vQHQ9z7x-RsZQW5Q=s64",
    "appVersion": "5.31",
    "date": "2021-03-19T12:12:23+00:00",
    "timestamp": 1616155943,
    "score": 1,
    "countLikes": 166,
    "reply": {
        "date": "2021-03-20T10:44:05+00:00",
        "timestamp": 1616237045,
        "text": "Please write to us through the \"Feedback\" menu of the Navigator or app-navigator@support.yandex.ru. Specify what route and between what points you tried to build and show it in the screenshot. This will help us understand the current situation."
    }
}
```

[Documentation](../../README.md) > **Review**
