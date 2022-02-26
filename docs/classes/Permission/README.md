[Documentation](../../README.md) > **Permission**

# The `Nelexa\GPlay\Model\Permission` class

## Introduction
Contains information about application permissions.

## Class synopsis
```php
Nelexa\GPlay\Model\Permission implements JsonSerializable {

    /* Methods */
    public __construct ( string $label , Nelexa\GPlay\Model\GoogleImage $icon , string[] $permissions ) 
    public getLabel ( void ) : string
    public getIcon ( void ) : Nelexa\GPlay\Model\GoogleImage
    public getPermissions ( void ) : string[]
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Permission::__construct](permission.__construct.md) - Permission constructor.
* [Nelexa\GPlay\Model\Permission::getLabel](permission.getlabel.md)
* [Nelexa\GPlay\Model\Permission::getIcon](permission.geticon.md)
* [Nelexa\GPlay\Model\Permission::getPermissions](permission.getpermissions.md)
* [Nelexa\GPlay\Model\Permission::asArray](permission.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\Permission::jsonSerialize](permission.jsonserialize.md) - Specify data which should be serialized to JSON.


## Sample object content
```php
class Nelexa\GPlay\Model\Permission {
  -getLabel(): string: "Other"
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
    -getUrl(): string: "https://play-lh.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA=s0"
    -getBinaryImageContent(): string: …
  }
  -getPermissions(): array: array:7 [
    0 => "receive data from Internet"
    1 => "view network connections"
    …
  ]
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($permission, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "label": "Other",
    "icon": "https://play-lh.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA",
    "permissions": [
        "receive data from Internet",
        "view network connections",
        "full network access",
        "run at startup",
        "control vibration",
        "prevent device from sleeping",
        "Google Play license check"
    ]
}
```

[Documentation](../../README.md) > **Permission**
