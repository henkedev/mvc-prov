# MVC-provet

## Installation

### Förbered systemet
- Kör composer install i roten
- Importera databasfilen i mappen "doc" till en existerande MySQL-databas

### Config-filen
- Kopiera eller ändra config_orig.xml till config.xml (finns i mappen "app")
- Lägg in uppgifter om databas i app/config.xml
- Ändra även base_url om servern ska köra på annan domän och port

### Server
- kör php-servern i mappen "public"
