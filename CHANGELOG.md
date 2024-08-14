# Changelog
All notable changes to this project will be documented in this file.

## [Unreleased]
## [2.2.0] - 2024-08-14
New fork from the original project at https://github.com/diegonz/PHPWakeOnLan
- Remove broken broadcast address validation, now we use IP and subnet to correctly calculate the broadcast address,
- Remove array usage, and unnecessary constructor; Now each object will send a magic packet to a single device.
- Update namespaces with new project vendor
- Remove Laravel support
- Remove StyleCi and TravisCI
- Add GitHub actions

### Removed

- Removed Laravel package route, view and controller

## [2.1.0] - 2019-04-01

### Removed
- Removed Illuminate/Support library dependency
- Removed redundant laravel facade alias

## [2.0.0] - 2019-03-21

### Added
- Laravel support
  - Service provider
  - Console command
  - Facade
  - Config
  - View template
  - Package route

### Changed
- Main and tests class names
- Exception error codes
- Added PHP 7.1 support
- Lowered phpunit minimum version
- Updated config files
- Updated README

### Removed
- Removed non compliant phpunit config flags
- Removed scrutinizer.yml

## [1.0.0] - 2019-02-28

Initial release
