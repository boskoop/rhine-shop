#!/bin/bash

# Executes only tests which are marked with @group unit (which are the really fast unit tests)
LARAVEL_ENV='test' phpunit --configuration phpunit_unit.xml