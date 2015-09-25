Scorpion CMS
====

Scorpion is a modern flat-file website CMS with powerful and easy administration, integration and customizing.


## Pros
 - Extremely lightweight
 - Easy to setup and integrate for other websites
 - Cache system making your website really fast
 - Easy to learn template engine (access php variables in html like `{{ show_articles }}`)
 - Powerful administration for your customers (or yourself)
  - Markdown editor with live preview and auto-save every x minute
  - File uploader
  - Add users with customized access levels
  - Configure backup options (if server supports CRON jobs)

## Install instructions
Pre-requisites: Apache, PHP 5.5+
Other web servers like nginx and lighttpd will be supported, but it's currently in development on Apache only.

    $ git clone https://github.com/kek91/Scorpion.git
    Open http://localhost/scorpion and follow its instructions to set up users and/or other configuration options

    
## Warning
This is a work in progress - not yet suitable for production (or even testing purposes)