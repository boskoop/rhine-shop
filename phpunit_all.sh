#!/bin/bash

# Executes all tests but does not (unlike the maven build) create 
# a clover coverage report, which speeds up the test
LARAVEL_ENV='test' phpunit --configuration phpunit_all_nocoverage.xml