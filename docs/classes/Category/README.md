[Documentation](../../README.md) > **Category**

# The `Nelexa\GPlay\Model\Category` class

## Introduction
Contains application category information in the Google Play store.

## Class synopsis
```php
Nelexa\GPlay\Model\Category implements JsonSerializable {

    /* Methods */
    public __construct ( string $id , string $name ) 
    public getId ( void ) : string
    public getName ( void ) : string
    public isGamesCategory ( void ) : bool
    public isFamilyCategory ( void ) : bool
    public isApplicationCategory ( void ) : bool
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Category::__construct](category.__construct.md) - Creates an object with application category information.
* [Nelexa\GPlay\Model\Category::getId](category.getid.md) - Returns category id.
* [Nelexa\GPlay\Model\Category::getName](category.getname.md) - Returns category name.
* [Nelexa\GPlay\Model\Category::isGamesCategory](category.isgamescategory.md) - Checks if a category is a category with games.
* [Nelexa\GPlay\Model\Category::isFamilyCategory](category.isfamilycategory.md) - Checks if a category is a family category.
* [Nelexa\GPlay\Model\Category::isApplicationCategory](category.isapplicationcategory.md) - Checks whether a category is a category with applications.
* [Nelexa\GPlay\Model\Category::asArray](category.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\Category::jsonSerialize](category.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\GPlayApps::getCategories()](../GPlayApps/gplayapps.getcategories.md) - Returns an array of application categories from the Google Play store.
* [Nelexa\GPlay\GPlayApps::getCategoriesForLocales()](../GPlayApps/gplayapps.getcategoriesforlocales.md) - Returns an array of application categories from the Google Play store for the locale array.
* [Nelexa\GPlay\GPlayApps::getCategoriesForAvailableLocales()](../GPlayApps/gplayapps.getcategoriesforavailablelocales.md) - Returns an array of categories from the Google Play store for all available locales.
## Sample object content
```php
class Nelexa\GPlay\Model\Category {
  -getId(): string: "GAME_CARD"
  -getName(): string: "Game card"
  -isGamesCategory(): bool: true
  -isFamilyCategory(): bool: false
  -isApplicationCategory(): bool: false
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($category, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "id": "GAME_CARD",
    "name": "Game card"
}
```

[Documentation](../../README.md) > **Category**
