[Documentation](../../README.md) > [AppInfo](README.md) > **getCover**

# Nelexa\GPlay\Model\AppInfo::getCover
`Nelexa\GPlay\Model\AppInfo::getCover` — Returns cover image.

## Description
```php
Nelexa\GPlay\Model\AppInfo::getCover ( void ) : Nelexa\GPlay\Model\GoogleImage | null
```
**Where it's displayed**
The feature graphic is displayed in front of screenshots of the application and in
the list of developer applications. If a promo video is added, a **Play** button
will overlay on the feature graphic so users can watch the promo video.

Google Play requirements:
* JPEG or 24-bit PNG (no alpha)
* Dimensions: 1024px by 500px

## Parameters
This function has no parameters.

## Return Values
cover image or `null`

## See Also
* :link: [https://support.google.com/googleplay/android-developer/answer/1078870?hl=en](https://support.google.com/googleplay/android-developer/answer/1078870?hl=en) - Graphic assets, screenshots, & video. Section **Feature graphic**.

[Documentation](../../README.md) > [AppInfo](README.md) > **getCover**
