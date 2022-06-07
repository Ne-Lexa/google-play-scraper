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
  -getLabel(): string: "Photos/Media/Files"
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/pHtIujPWxciAZcfYSwlrGGq14Z984rKLMgcm9RPATLiOlbrWy-tVlelEWgED7gpktgcD1tZizVeHiO5fkw"
    -getUrl(): string: "https://play-lh.googleusercontent.com/pHtIujPWxciAZcfYSwlrGGq14Z984rKLMgcm9RPATLiOlbrWy-tVlelEWgED7gpktgcD1tZizVeHiO5fkw"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/pHtIujPWxciAZcfYSwlrGGq14Z984rKLMgcm9RPATLiOlbrWy-tVlelEWgED7gpktgcD1tZizVeHiO5fkw=s0"
    -getBinaryImageContent(): string: …
  }
  -getPermissions(): array: array:2 [
    0 => "read the contents of your USB storage"
    1 => "modify or delete the contents of your USB storage"
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
    "label": "Photos/Media/Files",
    "icon": "https://play-lh.googleusercontent.com/pHtIujPWxciAZcfYSwlrGGq14Z984rKLMgcm9RPATLiOlbrWy-tVlelEWgED7gpktgcD1tZizVeHiO5fkw",
    "permissions": [
        "read the contents of your USB storage",
        "modify or delete the contents of your USB storage"
    ]
}
```

[Documentation](../../README.md) > **Permission**
