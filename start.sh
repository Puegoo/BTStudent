#!/bin/bash

# Określenie systemu operacyjnego
unameOut="$(uname -s)"
case "${unameOut}" in
    Linux*)     machine=Linux;;
    Darwin*)    machine=Mac;;
    *)          machine="UNKNOWN:${unameOut}"
esac

# Tworzenie bazy danych w zależności od systemu operacyjnego
if [ "$machine" == "Mac" ]; then
    /Applications/xampp/xamppfiles/bin/mysql -uroot -e "CREATE DATABASE IF NOT EXISTS btstudent;"  # Mac
elif [ "$machine" == "Linux" ]; then
    /opt/lampp/bin/mysql -uroot -e "CREATE DATABASE IF NOT EXISTS btstudent;" # Linux
else
    echo "Nieobsługiwany system: ${machine}"
    exit 1
fi

# Sprawdzenie, czy utworzenie bazy danych było udane
if [ $? -ne 0 ]; then
   echo "Nie udało się utworzyć bazy danych."
   exit 1
fi

# Kopiowanie pliku .env.example do .env, jeśli .env nie istnieje
if [ ! -f ".env" ]; then
    cp .env.example .env
    if [ $? -ne 0 ]; then
        echo "Nie udało się skopiować .env.example do .env."
        exit 1
    fi
fi

# Instalacja zależności Composer
composer install
if [ $? -ne 0 ]; then
    echo "Instalacja Composer nie powiodła się."
    exit 1
fi

# Generowanie nowego klucza aplikacji
php artisan key:generate
if [ $? -ne 0 ]; then
    echo "Nie udało się wygenerować klucza aplikacji."
    exit 1
fi

# Uruchomienie migracji bazy danych i seederów
php artisan migrate:fresh --seed
if [ $? -ne 0 ];then
    echo "Migracja bazy danych i seedowanie nie powiodły się."
    exit 1
fi

# Tworzenie symbolicznego linku dla storage
php artisan storage:link
if [ $? -ne 0 ];then
    echo "Nie udało się stworzyć linku do storage."
    exit 1
fi

# Kompilacja Tailwind CSS (przykład, może się różnić w zależności od projektu)
if [ -f "tailwind.config.js" ]; then
    npm install
    if [ $? -ne 0 ]; then
        echo "Instalacja npm nie powiodła się."
        exit 1
    fi

    npx tailwindcss -i ./resources/css/app.css -o ./public/css/tailwind.css --minify
    if [ $? -ne 0 ]; then
        echo "Kompilacja Tailwind CSS nie powiodła się."
        exit 1
    fi
fi

# Otwarcie projektu w Visual Studio Code (opcjonalne)
if command -v code &> /dev/null; then
    code .
else
    echo "Visual Studio Code nie jest zainstalowane lub nie znajduje się w system PATH."
fi

# Uruchomienie serwera
php artisan serve &

echo "Konfiguracja zakończona pomyślnie."
