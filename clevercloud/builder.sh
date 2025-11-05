#!/bin/bash

# Убедитесь что dev бандлы не загружаются в production
sed -i "/MakerBundle.*all/d" config/bundles.php

# Очистка кеша для production
php bin/console cache:clear --env=prod --no-debug