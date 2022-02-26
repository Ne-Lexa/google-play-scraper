[Documentation](../../README.md) > **Review**

# The `Nelexa\GPlay\Model\Review` class

## Introduction
Contains review of application on Google Play store.

## Class synopsis
```php
Nelexa\GPlay\Model\Review implements JsonSerializable {

    /* Methods */
    public __construct ( string $id , string $url , string $userName , string $text , Nelexa\GPlay\Model\GoogleImage $avatar , DateTimeInterface | null $date , int $score [, int $likeCount = 0 ] [, Nelexa\GPlay\Model\ReplyReview | null $reply = null ] ) 
    public getId ( void ) : string
    public getUrl ( void ) : string
    public getUserName ( void ) : string
    public getText ( void ) : string
    public getAvatar ( void ) : Nelexa\GPlay\Model\GoogleImage
    public getDate ( void ) : DateTimeInterface | null
    public getScore ( void ) : int
    public getCountLikes ( void ) : int
    public getReply ( void ) : Nelexa\GPlay\Model\ReplyReview | null
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Review::__construct](review.__construct.md) - Creates an Android app review object in the Google Play store.
* [Nelexa\GPlay\Model\Review::getId](review.getid.md) - Returns review id.
* [Nelexa\GPlay\Model\Review::getUrl](review.geturl.md) - Returns a review url.
* [Nelexa\GPlay\Model\Review::getUserName](review.getusername.md) - Returns the username of the review author.
* [Nelexa\GPlay\Model\Review::getText](review.gettext.md) - Returns the text of the review.
* [Nelexa\GPlay\Model\Review::getAvatar](review.getavatar.md) - Returns the user's avatar.
* [Nelexa\GPlay\Model\Review::getDate](review.getdate.md) - Returns the date of the review.
* [Nelexa\GPlay\Model\Review::getScore](review.getscore.md) - Returns a review rating.
* [Nelexa\GPlay\Model\Review::getCountLikes](review.getcountlikes.md) - Returns the count of likes of the review.
* [Nelexa\GPlay\Model\Review::getReply](review.getreply.md) - Returns a reply of the review.
* [Nelexa\GPlay\Model\Review::asArray](review.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\Review::jsonSerialize](review.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\GPlayApps::getReviews()](../GPlayApps/gplayapps.getreviews.md) - Returns reviews of the Android app in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getAppsInfo()](../GPlayApps/gplayapps.getappsinfo.md) - Returns detailed information about many android packages.
## Sample object content
```php
class Nelexa\GPlay\Model\Review {
  -getId(): string: "gp:AOqpTOE7yudbpITet1zkUkQyYxG8oAIMGX_Wa0bKkTfvBV_jhbFdfoptFVfC25yUINhtMOjttiNWDnW34A-v0Q"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.yandexnavi&reviewId=gp%3AAOqpTOE7yudbpITet1zkUkQyYxG8oAIMGX_Wa0bKkTfvBV_jhbFdfoptFVfC25yUINhtM…"
  -getUserName(): string: "Pete Santini"
  -getText(): string: "want the longest possible route to get somewhere... yandex is got you covered! don't worry, it was just easier to install and encourage others not to …"
  -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhFf8owUEBtgG3OzRaPOoV8aLL5YrVs8bQMXWN3ZVg=s64"
    -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhFf8owUEBtgG3OzRaPOoV8aLL5YrVs8bQMXWN3ZVg=s64"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhFf8owUEBtgG3OzRaPOoV8aLL5YrVs8bQMXWN3ZVg=s0"
    -getBinaryImageContent(): string: …
  }
  -getDate(): ?DateTimeInterface: @1562856331 {
    date: 2019-07-11T14:45:31+00:00
  }
  -getScore(): int: 1
  -getCountLikes(): int: 18
  -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
    -getDate(): DateTimeInterface: @1563092813 {
      date: 2019-07-14T08:26:53+00:00
    }
    -getText(): string: "Please contact our support team and tell us more about that type of situation: app-maps@support.yandex.ru"
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
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
    "id": "gp:AOqpTOE7yudbpITet1zkUkQyYxG8oAIMGX_Wa0bKkTfvBV_jhbFdfoptFVfC25yUINhtMOjttiNWDnW34A-v0Q",
    "url": "https://play.google.com/store/apps/details?id=ru.yandex.yandexnavi&reviewId=gp%3AAOqpTOE7yudbpITet1zkUkQyYxG8oAIMGX_Wa0bKkTfvBV_jhbFdfoptFVfC25yUINhtMOjttiNWDnW34A-v0Q",
    "userName": "Pete Santini",
    "text": "want the longest possible route to get somewhere... yandex is got you covered! don't worry, it was just easier to install and encourage others not to bother.",
    "avatar": "https://play-lh.googleusercontent.com/a-/AOh14GhFf8owUEBtgG3OzRaPOoV8aLL5YrVs8bQMXWN3ZVg=s64",
    "date": "2019-07-11T14:45:31+00:00",
    "timestamp": 1562856331,
    "score": 1,
    "countLikes": 18,
    "reply": {
        "date": "2019-07-14T08:26:53+00:00",
        "timestamp": 1563092813,
        "text": "Please contact our support team and tell us more about that type of situation: app-maps@support.yandex.ru"
    }
}
```

[Documentation](../../README.md) > **Review**
