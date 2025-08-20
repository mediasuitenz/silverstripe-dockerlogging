# Container Runtime Logging

Plug-and-play config for routing Silverstripe logs to stdout for use in an OCI runtime. For use with a php-fpm based container.

This is an opinionated module that:
* routes all logs to stdout
* formats them as JSON
* adds `extra[source]`, always set to 'silverstripe'
* adds `extra[timestamp]`, an ISO86001 UTC date
* adds `extra[severity]`, lowercased log level
* adds `extra[request_id]`, nginx request ID from HTTP_X_REQUEST_ID, if exists

For Silverstripe 5.x and Monolog 1.x

## Installation

```sh
composer require madecurious/silverstripe-dockerlogging
```

Ensure that the environment variable `SS_ERROR_LOG` is not set so that normal default logger is not used. This may be required
in environments where the container file-system is mounted read-only.
