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
    public jsonSerialize ( void ) : mixed
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Review::__construct](review.construct.md) - Creates an Android app review object in the Google Play store.
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
  -getId(): string: "gp:AOqpTOGYU8vuRNk_RGWoZQxbwCJ34fjyvs039F0jjWOwIhyyILKG4yY-FHdeNLnR0bctbBj1MfGdiAb-7TedPg"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.yandexnavi&reviewId=gp%3AAOqpTOGYU8vuRNk_RGWoZQxbwCJ34fjyvs039F0jjWOwIhyyILKG4yY-FHdeNLnR0bctb…"
  -getUserName(): string: "Vitaly Baturchik"
  -getText(): string: "Great app. Show the best routes, traffic jams. I use it even in my native city."
  -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/-tQpGiOCYY94/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rec-XKxbFIL5o_K3mDoO-0bbBWm4A/s64/"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-tQpGiOCYY94/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rec-XKxbFIL5o_K3mDoO-0bbBWm4A/s0/"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/-tQpGiOCYY94/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rec-XKxbFIL5o_K3mDoO-0bbBWm4A/s64/"
  }
  -getDate(): ?DateTimeInterface: @1575959899 {
    date: 2019-12-10T06:38:19+00:00
  }
  -getScore(): int: 5
  -getCountLikes(): int: 45
  -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
    -getDate(): DateTimeInterface: @1575983861 {
      date: 2019-12-10T13:17:41+00:00
    }
    -getText(): string: "Thank you!"
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -asArray(): array: …
  -jsonSerialize(): mixed: …
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
    "id": "gp:AOqpTOGYU8vuRNk_RGWoZQxbwCJ34fjyvs039F0jjWOwIhyyILKG4yY-FHdeNLnR0bctbBj1MfGdiAb-7TedPg",
    "url": "https://play.google.com/store/apps/details?id=ru.yandex.yandexnavi&reviewId=gp%3AAOqpTOGYU8vuRNk_RGWoZQxbwCJ34fjyvs039F0jjWOwIhyyILKG4yY-FHdeNLnR0bctbBj1MfGdiAb-7TedPg",
    "userName": "Vitaly Baturchik",
    "text": "Great app. Show the best routes, traffic jams. I use it even in my native city.",
    "avatar": "https://lh3.googleusercontent.com/-tQpGiOCYY94/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rec-XKxbFIL5o_K3mDoO-0bbBWm4A/s64/",
    "date": "2019-12-10T06:38:19+00:00",
    "timestamp": 1575959899,
    "score": 5,
    "countLikes": 45,
    "reply": {
        "date": "2019-12-10T13:17:41+00:00",
        "timestamp": 1575983861,
        "text": "Thank you!"
    }
}
```

[Documentation](../../README.md) > **Review**
