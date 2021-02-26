Component do Joomla służący do generowania i wypełniania formularzy na wi.zut.edu.pl

Po ściągnięciu należy zainstalować zależności npm:

``npm install``

W przypadku braku `npm` należy zainstalować [Node.js](https://nodejs.org/)

Następnie należy zainstalować zależności dla PHP używając [composer](https://getcomposer.org/):

``composer install``

oraz narzędzie Grunt do budowania paczki instalacyjnej:

``npm install -g grunt-cli``

Zbudowanie projektu:

`grunt` lub `grunt default`

Źródła zbudowanego komponentu umieszczone zostaną w katalogu `build`.

Zbudowanie paczki instalacyjnej

`grunt package` lub `grunt package-lite`

`grunt package` dołącza wszystkie potrzebne zależności, natomiast `grunt package-lite` pomija katalog `vendor` (zależności PHP pobrane composer-em). 
Robienie pełnej paczki nie jest konieczne w przypadku aktualizacji komponentu joomli ponieważ istniejące pliki nie są kasowane (aktualizowane są tylko zmienione pliki), zatem
 nie ma potrzeby kopiować wszystkiego za każdym razem na serwer (pełna paczka instalacyjna waży ponad 50MB).

Po zbudowaniu paczki instalacyjnej gotowa paczka w postaci pliku .zip będzie umieszczona w katalogu `dist`. Komponent można zainstalować z poziomu panelu administracyjnego joomla w Extensions->Manage->Install.

Pracując nad rozwojem komponentu nie jest wygodne budowanie i instalowanie komponentu przy każdej drobnej zmianie. Najwygodniej zainstalować joomla na lokalnym serwerze www (na windowsie można użyć pakiet XAMPP zawierający serer apache, php i bazę mysql) i wgrywać zbudowany komponent bezpośrednio do jej źródeł i dzięki temu od razu widać zmiany.
Do tego przygotowałem specjalny task w grunt, który szybko buduje komponent i wgrywa je do wskazanej lokalnej instalacji joomla. Do jego prawidłowego działania należy ustawić zmienną systemową `JOOMLA_HOME` zwierającą ścieżkę do katalogu, w którym jest zainstalowana joomla.

Opisane szybkie wgranie komponentu do joomla wywołuje się:

`grunt deploy-local`







