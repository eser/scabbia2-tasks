@ECHO OFF

php -d html_errors=off -qC "%~dp0\scabbia" %*
