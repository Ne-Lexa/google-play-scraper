[Documentation](../../README.md) > **AgeEnum**

# The `Nelexa\GPlay\Enum\AgeEnum` class

## Introduction
Contains all valid values for the age parameter.

## Class synopsis
```php
Nelexa\GPlay\Enum\AgeEnum extends Nelexa\Enum implements Stringable {

    /* Methods */
    public static FIVE_UNDER ( void ) : Nelexa\GPlay\Enum\AgeEnum
    public static SIX_EIGHT ( void ) : Nelexa\GPlay\Enum\AgeEnum
    public static NINE_UP ( void ) : Nelexa\GPlay\Enum\AgeEnum
    final public static valueOf ( string $name ) : static
    final public name ( void ) : string
    final public value ( void ) : string | int | float | bool | array | null
    final public static values ( void ) : static[]
    final public static containsKey ( string $name ) : bool
    final public static containsValue ( string | int | float | bool | array | null $value [, bool $strict = true ] ) : bool
    final public static fromValue ( string | int | float | bool | array | null $value ) : static
    final public ordinal ( void ) : int
    public __toString ( void ) : string
}
```

## Table of Contents
* [Nelexa\GPlay\Enum\AgeEnum::FIVE_UNDER](ageenum.five_under.md) - Returns the value of the age parameter for age 5 and under.
* [Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT](ageenum.six_eight.md) - Returns the value of the age parameter for age 6 - 8 years.
* [Nelexa\GPlay\Enum\AgeEnum::NINE_UP](ageenum.nine_up.md) - Returns the value of the age parameter for ages 9 and up.
* [Nelexa\GPlay\Enum\AgeEnum::valueOf](ageenum.valueof.md) - Returns the enum of the specified constant name.
* [Nelexa\GPlay\Enum\AgeEnum::name](ageenum.name.md) - Returns the name of this enum constant.
* [Nelexa\GPlay\Enum\AgeEnum::value](ageenum.value.md) - Returns the scalar value of this enum constant.
* [Nelexa\GPlay\Enum\AgeEnum::values](ageenum.values.md) - Returns an array containing the constants of this enum type, in the order they're declared.
* [Nelexa\GPlay\Enum\AgeEnum::containsKey](ageenum.containskey.md) - Checks whether the constant name is present in the enum.
* [Nelexa\GPlay\Enum\AgeEnum::containsValue](ageenum.containsvalue.md) - Checks if enum contains a passed value.
* [Nelexa\GPlay\Enum\AgeEnum::fromValue](ageenum.fromvalue.md) - Returns first enum of the specified constant value.
* [Nelexa\GPlay\Enum\AgeEnum::ordinal](ageenum.ordinal.md) - Returns the ordinal of this enum constant.
* [Nelexa\GPlay\Enum\AgeEnum::__toString](ageenum.__tostring.md) - Returns the value of this enum constant, as contained in the declaration.


## Sample object content
```php
class Nelexa\GPlay\Enum\AgeEnum {
  -name(): string: "NINE_UP"
  -value(): mixed: "AGE_RANGE3"
  -ordinal(): int: 2
  -__toString(): string: "AGE_RANGE3"
}
```

[Documentation](../../README.md) > **AgeEnum**
