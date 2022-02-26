[Documentation](../../README.md) > **ReplyReview**

# The `Nelexa\GPlay\Model\ReplyReview` class

## Introduction
Contains the developer’s reply to a review in the Google Play store.

## Class synopsis
```php
Nelexa\GPlay\Model\ReplyReview implements JsonSerializable {

    /* Methods */
    public __construct ( DateTimeInterface $date , string $text ) 
    public getDate ( void ) : DateTimeInterface
    public getText ( void ) : string
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\ReplyReview::__construct](replyreview.__construct.md) - Creates an object with information about the developer’s response to a review of an application in the Google Play store.
* [Nelexa\GPlay\Model\ReplyReview::getDate](replyreview.getdate.md) - Returns reply date.
* [Nelexa\GPlay\Model\ReplyReview::getText](replyreview.gettext.md) - Returns reply text.
* [Nelexa\GPlay\Model\ReplyReview::asArray](replyreview.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\ReplyReview::jsonSerialize](replyreview.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\Model\Review](../Review/README.md) - Contains review of application on Google Play store.
* [Nelexa\GPlay\GPlayApps::getReviews()](../GPlayApps/gplayapps.getreviews.md) - Returns reviews of the Android app in the Google Play store.
## Sample object content
```php
class Nelexa\GPlay\Model\ReplyReview {
  -getDate(): DateTimeInterface: @1563092813 {
    date: 2019-07-14T08:26:53+00:00
  }
  -getText(): string: "Please contact our support team and tell us more about that type of situation: app-maps@support.yandex.ru"
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($replyReview, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "date": "2019-07-14T08:26:53+00:00",
    "timestamp": 1563092813,
    "text": "Please contact our support team and tell us more about that type of situation: app-maps@support.yandex.ru"
}
```

[Documentation](../../README.md) > **ReplyReview**
