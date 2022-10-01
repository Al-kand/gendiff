# Gendiff
[![Actions Status](https://github.com/Al-kand/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/Al-kand/php-project-lvl2/actions)
[![CI](https://github.com/Al-kand/php-project-lvl2/actions/workflows/main.yml/badge.svg)](https://github.com/Al-kand/php-project-lvl2/actions/workflows/main.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/4537735394af65d88204/maintainability)](https://codeclimate.com/github/Al-kand/php-project-lvl2/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/4537735394af65d88204/test_coverage)](https://codeclimate.com/github/Al-kand/php-project-lvl2/test_coverage)

Utility to show of differences between two JSON or YAML files

## Requirements
The following tools are required in order to start the installation.
- php 8.0
- composer

## Install
1. Download and unzip the [archive](https://github.com/Al-kand/gendiff/archive/refs/heads/main.zip) 
or clone this repository with
```
git clone https://github.com/Al-kand/gendiff
```
2. Go to folder
```
cd gendiff
```
3. Run
```
composer install
```
## Usage
Show help
```gendiff (-h|--help)```

Show version 
```gendiff (-v|--version)```

Show differences
```gendiff [--format <fmt>] <firstFile> <secondFile>```

Report formats: `stylish` (default), `plain`, `json`

### Examples
JSON
```
gendiff tests/file1.json tests/file2.json
```
[![asciicast](https://asciinema.org/a/4Km8yGd6KEXoL9J4LCpxAWDmC.svg)](https://asciinema.org/a/4Km8yGd6KEXoL9J4LCpxAWDmC)
YAML
```
gendiff tests/file1.yaml tests/file2.yml
```
[![asciicast](https://asciinema.org/a/lK3nfxsaeZogLiyb7ue5yznt4.svg)](https://asciinema.org/a/lK3nfxsaeZogLiyb7ue5yznt4)
Format stylish
```
gendiff --format stylish file1.json file2.json
```
[![asciicast](https://asciinema.org/a/psApWFRYHixVLINItTv5ca1gL.svg)](https://asciinema.org/a/psApWFRYHixVLINItTv5ca1gL)
Format plain
```
gendiff --format plain file1.json file2.json
```
[![asciicast](https://asciinema.org/a/QCBcIE6cYDq87pK07CyZl3yBm.svg)](https://asciinema.org/a/QCBcIE6cYDq87pK07CyZl3yBm)
Format json
```
gendiff --format json file1.json file2.json
```
[![asciicast](https://asciinema.org/a/fAVgcQEiQT0nOIeGdTNJTjjSG.svg)](https://asciinema.org/a/fAVgcQEiQT0nOIeGdTNJTjjSG)

