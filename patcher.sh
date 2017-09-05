#!/bin/sh

# git fetch
# git checkout feature/orion
# git checkout orphan/patches
# git pull origin orphan/patches
# git checkout feature/orion

# git checkout orphan/patches patches/

patch -p0 < {{hash}}.patch