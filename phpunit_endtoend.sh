#!/bin/bash

# Executes only tests which are marked with @group endtoend (which are tests executing http calls)
LARAVEL_ENV='test' phpunit --configuration phpunit_endtoend.xml