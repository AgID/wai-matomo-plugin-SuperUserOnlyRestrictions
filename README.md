# Matomo UsersManagerOnlyAdmin Plugin

## Description

This plugin restricts the ability to edit users via userSettings to admin users only.

## Installation

Refer to [this Matomo FAQ](https://matomo.org/faq/plugins/faq_21/).

## Usage

Add the following section to your `config.ini.php`:

```
[UsersManagerOnlyAdmin]
users_manager_only_admin_enabled[] = true

```

**Make sure you have direct access to the `config.ini.php` file before using this plugin**