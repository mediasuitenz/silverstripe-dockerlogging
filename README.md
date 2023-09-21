# Docker log handler

Plug-and-play log handler for routing Silverstripe logs to stdout as Docker expects. 

This is an opinionated module that:
* routes all logs to stdout
* formats them as json
* adds 'source', always set to 'silverstripe'
* adds 'timestamp', an ISO86001 UTC date
* adds 'severity', lowercased log level

For Silverstripe 4.x and Monolog 1.x

## Installation

```sh
composer require madecurious/silverstripe-dockerlogging
```
