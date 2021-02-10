Description
===========
Magento2 quick view implementation.

Install
=======

1. Add repo to composer.json file:
```json
{
    "repositories": [
            {
                "type": "composer",
                "url": "https://repo.magento.com/"
            },
            {
                "type": "vcs",
                "url": "http://products.git.devoffice.com/magento/magento2-quick-view.git"
            }
        ]
}
```

2. Add the module to composer:
```bash
composer require zemez/magento2-quick-view:dev-master
```

3. Enable the module:
```bash
bin/magento module:enable --clear-static-content Zemez_QuickView
bin/magento setup:upgrade
```

Configure
=========

Please navigate to the **Stores -> Settings -> Configuration -> Zemez -> Quick View** in order to configure the module.

Uninstall
=========

1. Disable the module:
```bash
bin/magento module:disable --clear-static-content Zemez_QuickView
```

2. Remove the module from composer:
```bash
composer remove zemez/magento2-quick-view
```