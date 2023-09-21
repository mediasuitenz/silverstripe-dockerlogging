# Silverstripe CMS supported module skeleton

A useful skeleton to more easily create a [Silverstripe CMS Module](https://docs.silverstripe.org/en/developer_guides/extending/modules/) that conform to the
[Module Standard](https://docs.silverstripe.org/en/developer_guides/extending/modules/#module-standard).

This README contains descriptions of the parts of this module base you should customise to meet you own module needs.
For example, the module name in the H1 above should be you own module name, and the description text you are reading now
is where you should provide a good short explanation of what your module does.

Where possible we have included default text that can be included as is into your module and indicated in
other places where you need to customise it


- Update the module's `composer.json` with your requirements and package name
- Add and push to a VCS repository
- Either [publish](https://getcomposer.org/doc/02-libraries.md#publishing-to-packagist) the module on packagist.org, or add a [custom repository](https://getcomposer.org/doc/02-libraries.md#publishing-to-a-vcs) to your main `composer.json`
- Require the module in your main `composer.json`

## Installation

Replace `silverstripe-module/skeleton` in the command below with the composer name of your module.

```sh
composer require madecurious/silverstripe-dockerlogging
```

**Note:** When you have completed your module, submit it to Packagist or add it as a VCS repository to your
project's composer.json, pointing to the private repository URL.

## Documentation

Plug and play. 
