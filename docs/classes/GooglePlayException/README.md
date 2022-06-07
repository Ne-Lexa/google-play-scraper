[Documentation](../../README.md) > **GooglePlayException**

# The `Nelexa\GPlay\Exception\GooglePlayException` class

## Introduction
Exception thrown if there is an error accessing the Google Play server.

## Class synopsis
```php
Nelexa\GPlay\Exception\GooglePlayException extends Exception implements Throwable, Stringable {

    /* Methods */
    public __construct ( [ string $message = "" ] [, int $code = 0 ] [, Throwable $previous = null ] ) 
    public __wakeup ( void ) 
    final public getMessage ( void ) 
    final public getCode ( void ) 
    final public getFile ( void ) 
    final public getLine ( void ) 
    final public getTrace ( void ) 
    final public getPrevious ( void ) 
    final public getTraceAsString ( void ) 
    public __toString ( void ) 
    public setUrl ( string $url ) : Nelexa\GPlay\Exception\GooglePlayException
    public getUrl ( void ) : string | null
    public getRequest ( void ) : Psr\Http\Message\RequestInterface | null
    public getResponse ( void ) : Psr\Http\Message\ResponseInterface | null
}
```

## Table of Contents
* [Nelexa\GPlay\Exception\GooglePlayException::__construct](googleplayexception.__construct.md) - Construct the GooglePlayException.
* [Nelexa\GPlay\Exception\GooglePlayException::__wakeup](googleplayexception.__wakeup.md)
* [Nelexa\GPlay\Exception\GooglePlayException::getMessage](googleplayexception.getmessage.md)
* [Nelexa\GPlay\Exception\GooglePlayException::getCode](googleplayexception.getcode.md)
* [Nelexa\GPlay\Exception\GooglePlayException::getFile](googleplayexception.getfile.md)
* [Nelexa\GPlay\Exception\GooglePlayException::getLine](googleplayexception.getline.md)
* [Nelexa\GPlay\Exception\GooglePlayException::getTrace](googleplayexception.gettrace.md)
* [Nelexa\GPlay\Exception\GooglePlayException::getPrevious](googleplayexception.getprevious.md)
* [Nelexa\GPlay\Exception\GooglePlayException::getTraceAsString](googleplayexception.gettraceasstring.md)
* [Nelexa\GPlay\Exception\GooglePlayException::__toString](googleplayexception.__tostring.md)
* [Nelexa\GPlay\Exception\GooglePlayException::setUrl](googleplayexception.seturl.md) - Set the URL associated with the exception.
* [Nelexa\GPlay\Exception\GooglePlayException::getUrl](googleplayexception.geturl.md) - Returns the URL with which the exception is associated.
* [Nelexa\GPlay\Exception\GooglePlayException::getRequest](googleplayexception.getrequest.md) - Returns an HTTP request if present.
* [Nelexa\GPlay\Exception\GooglePlayException::getResponse](googleplayexception.getresponse.md) - Returns an HTTP response if present.


## Sample object content
```php
class Nelexa\GPlay\Exception\GooglePlayException {
  -getMessage(): mixed: """
    Client error: `GET https://play.google.com/store/apps/details?id=com.invalid.app.test&hl=en_US&gl=us` resulted in a `404 Not Found` response:\n
    <!DOCTYP…
    """
  -getCode(): mixed: 1
  -getFile(): mixed: …
  -getLine(): mixed: 221
  -getTrace(): mixed: …
  -getTraceAsString(): mixed: …
  -getUrl(): ?string: "https://play.google.com/store/apps/details?id=com.invalid.app.test&hl=en_US&gl=us"
  -getResponse(): ?Psr\Http\Message\ResponseInterface: …
}
```

[Documentation](../../README.md) > **GooglePlayException**
