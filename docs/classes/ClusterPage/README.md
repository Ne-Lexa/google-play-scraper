[Documentation](../../README.md) > **ClusterPage**

# The `Nelexa\GPlay\Model\ClusterPage` class

## Introduction
Contains the title and link to the cluster page.

## Class synopsis
```php
Nelexa\GPlay\Model\ClusterPage {

    /* Methods */
    public __construct ( string $title , string $url ) 
    public getTitle ( void ) : string
    public getUrl ( void ) : string
}
```

## Table of Contents
* [Nelexa\GPlay\Model\ClusterPage::__construct](clusterpage.__construct.md) - Creates an object with information about the cluster page.
* [Nelexa\GPlay\Model\ClusterPage::getTitle](clusterpage.gettitle.md) - Returns the cluster page title.
* [Nelexa\GPlay\Model\ClusterPage::getUrl](clusterpage.geturl.md) - Returns the cluster page url.


## See Also
* [Nelexa\GPlay\GPlayApps::getClusterPages()](../GPlayApps/gplayapps.getclusterpages.md) - Returns an iterator of cluster pages.
* [Nelexa\GPlay\GPlayApps::getClusterApps()](../GPlayApps/gplayapps.getclusterapps.md) - Returns an iterator of applications from the Google Play store for the specified cluster page.
## Sample object content
```php
class Nelexa\GPlay\Model\ClusterPage {
  -getTitle(): string: "Popular apps"
  -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?gsr=ShwSFwoCCAEQBBoLQVBQTElDQVRJT04qAggB-AEA:S:ANO1ljLOWNs"
}
```

[Documentation](../../README.md) > **ClusterPage**
