[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategoriesForAvailableLocales**

# Nelexa\GPlay\GPlayApps::getCategoriesForAvailableLocales
`Nelexa\GPlay\GPlayApps::getCategoriesForAvailableLocales` — Returns an array of categories from the Google Play store for all available locales.

## Description
```php
Nelexa\GPlay\GPlayApps::getCategoriesForAvailableLocales ( void ) : Nelexa\GPlay\Model\Category[][]
```

## Parameters
This function has no parameters.

## Return Values
array of application categories by locale


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$gplay->setConcurrency(10);
$categories = $gplay->getCategoriesForAvailableLocales();
```
<details>
  <summary>Results</summary>

```php
array:78 [
    "af" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Besigheid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteke en demonstrasies"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "am" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MEDICAL"
        -getName(): string: "ሕክምና"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ar" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "أدوات الفيديو"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "az_AZ" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alətlər"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avto və Nəqliyyat Vasitələri"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "be" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменты"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "bg" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Библиотеки и демонстрации"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "bn_BD" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "আবহাওয়া"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ca" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art i disseny"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automoció"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "cs_CZ" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auta a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Byznys"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "da_DK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Begivenheder"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteker og demoer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "de_DE" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos & Fahrzeuge"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "el_GR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Αγορές"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_AU" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_CA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_GB" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_SG" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_US" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_ZA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "es_419" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte y diseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos y vehículos"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "es_ES" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte y diseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automoción"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "es_US" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte y diseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos y vehículos"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "et" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autod ja sõidukid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIFESTYLE"
        -getName(): string: "Elustiil"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "eu_ES" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aisia"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Albisteak eta aldizkariak"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fa" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "آب و هوا"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fi_FI" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autot ja ajoneuvot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Demot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fil" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aliwan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Bahay at Tahanan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fr_CA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentation et boissons"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fr_FR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art et design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "gl_ES" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e deseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automóbiles e vehículos"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hi_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps और नेविगेशन ऐप्स"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hr" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alati"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automobili i prijevoz"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hu_HU" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autók és járművek"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Egészség és fitnesz"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hy_AM" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Ամեն ինչ տան համար"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "id" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alat "
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Belanja"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "is_IS" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Afþreying"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PRODUCTIVITY"
        -getName(): string: "Aðstoð"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "it_IT" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Affari"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "iw_IL" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "אוכל ומשקאות"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ja_JP" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "アート＆デザイン"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ka_GE" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ავტომობილები და სატრანსპორტო საშუალებები"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "kk" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто және көліктер"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "km_KH" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "កម្មវិធីចាក់ និងកែវីដេអូ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "kn_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps ಮತ್ತು ನ್ಯಾವಿಗೇಶನ್"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ko_KR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "건강/운동"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ky_KG" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "Аба ырайы"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "lo_LA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "ການຊື້ເຄື່ອງ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "lt" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Apsipirkimas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automobiliai ir transporto priemonės"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "lv" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Bibliotēkas un demoversijas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "mk_MK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и возила"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ml_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "ആരോഗ്യവും ശാരീരികക്ഷമതയും"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "mn_MN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто, тээврийн хэрэгсэл"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "mr_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ms" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Acara"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alatan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "my_MM" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "ကာတွန်း"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ne_NP" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "अटो र सवारीसाधनहरू"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "nl_NL" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto's en voertuigen"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "no_NO" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Arrangementer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PARENTING"
        -getName(): string: "Barn og foreldre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pl_PL" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteki i wersje demo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Dla firm"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pt_BR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beleza"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pt_PT" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentação e bebida"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ro" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Afacere"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Artă și design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ru_RU" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и транспорт"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "si_LK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "අධ්‍යාපනය"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sk" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autá a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Biznis"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sl" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avtomobili in vozila"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Dogodki"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sr" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Алатке"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sv_SE" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Anpassning"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Bibliotek och demo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sw" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Afya na Siha"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Badilisha upendavyo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ta_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "அழகு"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "te_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps & నావిగేషన్"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "th" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "การกำหนดค่าส่วนบุคคล"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "tr_TR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Alışveriş"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Araçlar"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "uk" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменти"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "vi" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Bản đồ và dẫn đường"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Cá nhân hóa"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zh_CN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "个性化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zh_HK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zh_TW" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zu" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BOOKS_AND_REFERENCE"
        -getName(): string: "Amabhuku & Amaphatho"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "Amahlaya"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategoriesForAvailableLocales**
