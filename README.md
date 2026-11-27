# jeedom_solaxcloud
Jeedom Plugin for Solax inverters via SolaX Cloud

This plugin allows Jeedom to read data from Solax inverters via SolaX Cloud.

No dependencies, 
No daemon

## Changelog

### 2026-11-27
- Fix: inverters with a type unknown to the plugin (e.g. `inverterType` 29) no longer get all their values forced to 0. Unknown types/statuses are shown as `Type N` / `Status N`. Thanks to @RSConsulting06 for the report and the tested fix (#3).
- Fix: values are only reset when the Solax Cloud API actually reports a failure, and only instantaneous powers are reset (energy counters are kept so history is not corrupted).
- Fix: saving the equipment no longer disables the history or visibility set by the user on the commands.
- Fix: `curl_error()` is now read before `curl_close()`.
- Fix: unit of "Add.2 Meter AC Power" is W (was KWh).
- New: `Power DC4` command (MPPT 4).
