[Documentation](../../README.md) > [Review](README.md) > **__construct**

# Nelexa\GPlay\Model\Review::__construct
`Nelexa\GPlay\Model\Review::__construct` — Creates an Android app review object in the Google Play store.

## Description
```php
Nelexa\GPlay\Model\Review::__construct ( string $id , string $userName , string $text , Nelexa\GPlay\Model\GoogleImage $avatar , DateTimeInterface | null $date , int $score [, int $likeCount = 0 ] [, Nelexa\GPlay\Model\ReplyReview | null $reply = null ] [, string | null $appVersion = null ] )
```

## Parameters
* **$id** (string)  
review id
* **$userName** (string)  
review author
* **$text** (string)  
review text
* **$avatar** ([Nelexa\GPlay\Model\GoogleImage](../GoogleImage/README.md))  
author's avatar
* **$date** (DateTimeInterface | null)  
review date
* **$score** (int)  
review score
* **$likeCount** (int)  
the number of likes reviews
* **$reply** ([Nelexa\GPlay\Model\ReplyReview](../ReplyReview/README.md) | null)  
reply review
* **$appVersion** (string | null)  
application version

## Return Values
No value is returned.

[Documentation](../../README.md) > [Review](README.md) > **__construct**
