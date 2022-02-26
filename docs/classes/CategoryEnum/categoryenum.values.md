[Documentation](../../README.md) > [CategoryEnum](README.md) > **values**

# Nelexa\GPlay\Enum\CategoryEnum::values
`Nelexa\GPlay\Enum\CategoryEnum::values` — Returns an array containing the constants of this enum type, in the order they're declared.

## Description
```php
Nelexa\GPlay\Enum\CategoryEnum::values ( void ) : static[]
```
This method may be used to iterate over the constants as follows:

```php
foreach(EnumClass::values() as $enum) {
echo $enum->name() . ' => ' . $enum->value() . PHP_EOL;
}
```

## Parameters
This function has no parameters.

## Return Values
An array of constants of this type enum in the order they are declared.

## Sample object content
```php
array:59 [
    0 => class Nelexa\GPlay\Enum\CategoryEnum {
      -name(): string: "GAME"
      -value(): mixed: "GAME"
      -ordinal(): int: 0
      -__toString(): string: "GAME"
    }
    1 => class Nelexa\GPlay\Enum\CategoryEnum {
      -name(): string: "FAMILY"
      -value(): mixed: "FAMILY"
      -ordinal(): int: 1
      -__toString(): string: "FAMILY"
    }
    …
  ]
```

[Documentation](../../README.md) > [CategoryEnum](README.md) > **values**
