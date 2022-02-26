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
    "af" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Besigheid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteke en demonstrasies"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "am" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MEDICAL"
        -getName(): string: "ሕክምና"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "መሣሪያዎች"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ar" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "أدوات الفيديو"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "أعمال"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "az_AZ" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alətlər"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avto və Nəqliyyat Vasitələri"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "be" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменты"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "Адукацыя"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "bg" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Библиотеки и демонстрации"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Бизнес"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "bn_BD" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Shopping"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ca" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicacions de rellotge"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art i disseny"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "cs_CZ" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikace pro hodinky"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auta a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "da_DK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Begivenheder"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteker og demoer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "de_DE" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos & Fahrzeuge"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "el_GR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Αγορές"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SPORTS"
        -getName(): string: "Αθλήματα"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_AU" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_CA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_GB" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_SG" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_US" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_ZA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "es_419" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "Aplicaciones de video"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de reloj"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "es_ES" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicaciones de reloj"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "Aplicaciones de vídeo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "es_US" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "Aplicaciones de video"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de reloj"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "et" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autod ja sõidukid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIFESTYLE"
        -getName(): string: "Elustiil"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "eu_ES" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aisia"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Albisteak eta aldizkariak"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fa" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "آب و هوا"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "آموزش"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fi_FI" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autot ja ajoneuvot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Demot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fil" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aliwan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Bahay at Tahanan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fr_CA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Applications pour montre intelligente"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fr_FR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Applications montre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "gl_ES" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicacións de reloxo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e deseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hi_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps और नेविगेशन ऐप्स"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hr" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alati"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikacija za sat"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hu_HU" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autók és járművek"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Egészség és fitnesz"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hy_AM" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Ամեն ինչ տան համար"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Անհատականացում"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "id" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alat "
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikasi smartwatch"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "is_IS" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Afþreying"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PRODUCTIVITY"
        -getName(): string: "Aðstoð"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "it_IT" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Affari"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "App dell'orologio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "iw_IL" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "אוכל ומשקאות"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "אירועים"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ja_JP" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "アート＆デザイン"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "イベント"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ka_GE" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Watch აპები"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ავტომობილები და სატრანსპორტო საშუალებები"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "kk" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто және көліктер"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "Ауа райы"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "km_KH" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "កម្មវិធីចាក់ និងកែវីដេអូ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "កម្មវិធីនាឡិកា"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "kn_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps ಮತ್ತು ನ್ಯಾವಿಗೇಶನ್"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ko_KR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "건강/운동"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "교육"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ky_KG" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "Аба ырайы"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто жана унаалар"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "lo_LA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "ກາຕູນ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "ການຊື້ເຄື່ອງ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "lt" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Apsipirkimas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automobiliai ir transporto priemonės"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "lv" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Bibliotēkas un demoversijas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "mk_MK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и возила"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Алатки"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ml_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Shopping"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "mn_MN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто, тээврийн хэрэгсэл"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIFESTYLE"
        -getName(): string: "Амьдралын хэв маяг"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "mr_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "आरोग्य व स्वास्थ्य"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ms" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Acara"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alatan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "my_MM" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ကားနှင့်ယာဉ်များ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "ကိရိယာများ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ne_NP" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "अटो र सवारीसाधनहरू"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PRODUCTIVITY"
        -getName(): string: "उत्पादकत्व"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "nl_NL" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto's en voertuigen"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "no_NO" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Arrangementer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PARENTING"
        -getName(): string: "Barn og foreldre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pl_PL" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikacje na zegarki"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteki i wersje demo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_BR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps para smartwatch"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_PT" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentação e bebida"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de relógio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ro" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Afacere"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicații pentru ceas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ru_RU" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и транспорт"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Бизнес"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "si_LK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "watch යෙදුම"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "අධ්‍යාපනය"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sk" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikácie pre hodinky"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autá a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sl" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikacije za uro"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avtomobili in vozila"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sr" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Алатке"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Апликације за сат"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sv_SE" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Anpassning"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Appar för smartklockor"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sw" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Afya na Siha"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Badilisha upendavyo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ta_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "அழகு"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "te_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ఆటో & వాహనాలు"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "ఆరోగ్యం & దృఢత్వం"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "th" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "การกำหนดค่าส่วนบุคคล"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PHOTOGRAPHY"
        -getName(): string: "การถ่ายภาพ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "tr_TR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Alışveriş"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Araçlar"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "uk" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменти"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Їжа та напої"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "vi" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Bản đồ và dẫn đường"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Cá nhân hóa"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zh_CN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "个性定制"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SPORTS"
        -getName(): string: "体育"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zh_HK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "健康與健身"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zh_TW" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "健康塑身"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zu" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BOOKS_AND_REFERENCE"
        -getName(): string: "Amabhuku & Amaphatho"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "Amahlaya"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getCategoriesForAvailableLocales**
