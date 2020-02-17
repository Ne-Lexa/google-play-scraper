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
    public jsonSerialize ( void ) : mixed
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Permission::__construct](permission.construct.md) - Permission constructor.
* [Nelexa\GPlay\Model\Permission::getLabel](permission.getlabel.md)
* [Nelexa\GPlay\Model\Permission::getIcon](permission.geticon.md)
* [Nelexa\GPlay\Model\Permission::getPermissions](permission.getpermissions.md)
* [Nelexa\GPlay\Model\Permission::asArray](permission.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\Permission::jsonSerialize](permission.jsonserialize.md) - Specify data which should be serialized to JSON.


## Sample object content
```php
class Nelexa\GPlay\Model\Permission {
  -getLabel(): string: "Storage"
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/aWNKQedLTpw6u6yyMjQObmuoKu67A1czWnIcvID86oAmMT02r5mNdRn6l9ZN2t2MIyH6tNy-01v7ukeQ"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/aWNKQedLTpw6u6yyMjQObmuoKu67A1czWnIcvID86oAmMT02r5mNdRn6l9ZN2t2MIyH6tNy-01v7ukeQ=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/aWNKQedLTpw6u6yyMjQObmuoKu67A1czWnIcvID86oAmMT02r5mNdRn6l9ZN2t2MIyH6tNy-01v7ukeQ"
  }
  -getPermissions(): array:2 [
    0 => "read the contents of your USB storage"
    1 => "modify or delete the contents of your USB storage"
  ]
  -asArray(): array: …
  -jsonSerialize(): mixed: …
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
    "label": "Storage",
    "icon": "https://lh3.googleusercontent.com/aWNKQedLTpw6u6yyMjQObmuoKu67A1czWnIcvID86oAmMT02r5mNdRn6l9ZN2t2MIyH6tNy-01v7ukeQ",
    "permissions": [
        "read the contents of your USB storage",
        "modify or delete the contents of your USB storage"
    ]
}
```

[Documentation](../../README.md) > **Permission**
