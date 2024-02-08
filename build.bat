@echo off
setlocal enabledelayedexpansion

:check_changes
call git status | findstr /C:"composer.lock" /C:"composer.json" /C:"symfony.lock" /C:"package-lock.json" /C:"package.json" >nul

if %errorlevel%==0 (
    echo ======================================================
    echo Changes were found in Composer, Symfony, or NPM files.
    echo Please commit these changes before proceeding.
    echo ======================================================
    pause
    exit /b
) else (
    echo ======================================================
    echo There are no current changes in Composer, Symfony, or NPM files.
    echo Continue the script.
    echo ======================================================
)

echo ======================================================
echo Pulling from GitHub repository
echo ======================================================
call git pull

echo ======================================================
echo Install Composer Dependencies
echo ======================================================
call composer install --optimize-autoloader

echo ======================================================
echo Generate Keys
echo ======================================================
call php bin/console secrets:generate-keys --env=prod

echo ======================================================
echo Dump Prod Environment
echo ======================================================
call composer dump-env prod

echo ======================================================
echo Clear Cache
echo ======================================================
call php bin/console cache:clear --no-warmup

echo ======================================================
echo Install Assets
echo ======================================================
call php bin/console assets:install

echo ======================================================
echo Install NPM
echo ======================================================
call npm install --force

echo ======================================================
echo Clear NPM Cache
echo ======================================================
call npm cache clean --force

echo ======================================================
echo Build
echo ======================================================
call npm run build

echo ======================================================
echo We have finished succesfully <3
echo ======================================================