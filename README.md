# AutoUpdater

Auto Update plugin for PocketMine-MP

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP Alpha_1.4 API 1.8.0

## Overview

**AutoUpdater** allows you to update your PocketMine server automatically.

**EvolSoft Website:** http://www.evolsoft.tk

***This Plugin uses the New API. You can't install it on old versions of PocketMine.***

With AutoUpdater you can automatically update your PocketMine server. (read documentation)

**Commands:**

***/autoupdater*** *- AutoUpdater commands*<br>
***/update*** *- Update your server*

**To-Do:**

*- Bug fix (if bugs will be found)*<br>
*- Possible PocketMine-Soft channel implementation*

## Documentation 

**Configuration (config.yml):**
```yaml
---
#Check update time (in minutes)
update-check-time: 60
#Update PocketMine automatically (if you disable this, you will get only the update alert but your server won't be updated automatically)
auto-update: true
#Max download timeout (in seconds)
timeout: 10
#PocketMine Channel (You can choose between beta, development, stable)
channel: "Development"
#PocketMine server file (the old will be overwritten)
file-name: "PocketMine-MP.phar"
#Start script will be executed after the update to restart your server (if you leave this empty, your server won't be restarted automatically)
#Start script depends on your operating system
#Usually start scripts are:
#start.cmd for Windows users
#./start.sh for Linux users
#Remember that these are default scripts. The start script depends on your system, settings, ... 
start-script: ""
...
```

**Commands:**

***/autoupdater*** *- AutoUpdate commands (aliases: [au, aupdater])*<br>
***/update*** *- Update your server*

**Permissions:**

- <dd><i><b>autoupdater.*</b> - AutoUpdater commands permissions.</i></dd>
- <dd><i><b>autoupdater.info</b> - AutoUpdater command Info permission.</i></dd>
- <dd><i><b>autoupdater.reload</b> - AutoUpdater command Reload permission.</i></dd>
- <dd><i><b>autoupdater.update</b> - AutoUpdater command Update permission.</i></dd>



