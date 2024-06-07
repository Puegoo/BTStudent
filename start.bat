@echo off

rem Tworzenie bazy danych
%systemDrive%\xampp\mysql\bin\mysql -uroot -e "CREATE DATABASE IF NOT EXISTS btstudent;"
if %errorlevel% neq 0 (
    msg %username% "Nie udało się utworzyć bazy danych."
    exit /b %errorlevel%
)

rem Instalacja zależności Composer
call composer install
if %errorlevel% neq 0 (
    msg %username% "Instalacja Composer nie powiodła się."
    exit /b %errorlevel%
)

rem Generowanie nowego klucza aplikacji
call php artisan key:generate
if %errorlevel% neq 0 (
    msg %username% "Nie udało się wygenerować klucza aplikacji."
    exit /b %errorlevel%
)

rem Uruchomienie migracji bazy danych i seedowanie
call php artisan migrate:fresh --seed
if %errorlevel% neq 0 (
    msg %username% "Migracja bazy danych i seedowanie nie powiodły się."
    exit /b %errorlevel%
)

rem Tworzenie symbolicznego linku dla storage
call php artisan storage:link
if %errorlevel% neq 0 (
    msg %username% "Nie udało się stworzyć linku do storage."
    exit /b %errorlevel%
)

rem Kompilacja Tailwind CSS (jeśli jest skonfigurowany)
if exist "tailwind.config.js" (
    call npm install
    if %errorlevel% neq 0 (
        msg %username% "Instalacja npm nie powiodła się."
        exit /b %errorlevel%
    )

    call npx tailwindcss -i ./resources/css/app.css -o ./public/css/tailwind.css --minify
    if %errorlevel% neq 0 (
        msg %username% "Kompilacja Tailwind CSS nie powiodła się."
        exit /b %errorlevel%
    )
)

rem Otwarcie projektu w Visual Studio Code (jeśli jest zainstalowany)
where code >nul 2>nul
if %errorlevel% equ 0 (
    code .
) else (
    echo Visual Studio Code nie jest zainstalowane lub nie znajduje się w system PATH.
)

rem Uruchomienie serwera
start php artisan serve

echo Konfiguracja zakończona pomyślnie.
pause
