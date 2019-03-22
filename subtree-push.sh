#!/usr/bin/env bash

git subtree push --prefix=src/Common common master
git subtree push --prefix=src/Extension/Sluggable sluggable master
git subtree push --prefix=src/Extension/Timestampable timestampable master
