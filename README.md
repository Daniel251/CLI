Package cli
================

- [Installation](#installation)
- [Usage](#usage)
- [Example](#Example)

Installation
------------
Download daniel251/cli git repository

Usage
-----
When in root project directory write in console:

``` php
php src/console.php [save_type] [link] [file_path] 

```
Save types:
csv:simple -when the file exists, overwriting and saving new file.

csv:extended - saving the new data to file, keeping the older data.

Directory in which you want to save data must exists.

Example
-----
``` php
php src/console.php csv:simple http://feeds.nationalgeographic.com/ng/News/News_Main eksport_prosty.csv

```
