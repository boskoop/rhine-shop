#!/bin/bash

# Executes only tests which are marked with @group integration (which are tests depending on a db)
LARAVEL_ENV='test' phpunit --configuration phpunit_integration.xml