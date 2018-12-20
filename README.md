# Guest Entries Honeypot plugin for Craft

This plugin allows you to add a [honeypot captcha](http://haacked.com/archive/2007/09/11/honeypot-captcha.aspx/) to your Craft CMS guest entry form.


## Requirements

This plugin requires Craft CMS 3.0.0 or later, and the [Guest Entries](https://github.com/craftcms/guest-entries) plugin.


## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Guest Entries Honeypot”. Then click on the “Install” button in its modal window.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require mikestecker/craft-guest-entries-honeypot

# tell Craft to install the plugin
./craft install/plugin guest-entries-honeypot
```

## Setup

To configure the plugin, go to Settings → Guest Entries Honeypot, and choose a param name that your honeypot field should have.

Then edit your entry form template(s), and add the honeypot field.

```html
<input id="secretHoneypotParamName" name="secretHoneypotParamName" type="text">
```

You can hide the field with CSS:

```css
input#secretHoneypotParamName { display: none; }
```
