Watch the video 👇

[![Watch the video](https://img.youtube.com/vi/v-r_12oezds/maxresdefault.jpg)](https://youtu.be/v-r_12oezds)

# docker-lamp

Docker with Apache, MySQL, PHPMyAdmin and PHP.

I use docker-compose as an orchestrator. To run these containers:

```
docker compose up -d
```

Open phpmyadmin at [http://127.0.0.1:8000](http://127.0.0.1:8000)
Open web browser to look at a simple php example at [http://127.0.0.1:80](http://127.0.0.1:80)

Clone YourProject on `www/` and then, open web [http://127.0.0.1/YourProject](http://127.0.0.1/YourProject)

Run MySQL client:

- `docker compose exec db mysql -u root -p` 

Infrastructure as code!

You can read this a Spanish article in Crashell platform: [Apache, PHP, MySQL y PHPMyAdmin con Docker LAMP](https://www.crashell.com/estudio/apache_php_mysql_y_phpmyadmin_con_docker_lamp).


### Infrastructure model

![Infrastructure model](.infragenie/infrastructure_model.png)

## Versiones

### Versión v2.0

- MySQL 9.0.1
- PHP 8.2.23
- PHPMyAdmin 5.2.1
- Xdebug 3.3.2

## Cambios recientes (puertos)

Para evitar conflictos con servicios locales del host, los puertos en `docker-compose.yml` han sido ajustados:

- MySQL: host `3307` -> contenedor `3306`
- Apache (www): host `8080` -> contenedor `80`
- phpMyAdmin: host `8000` -> contenedor `80`

Estos cambios están commiteados en la rama `main`.

## Puertos y accesos (actualizados)

- App web: http://localhost:8080
- phpMyAdmin: http://localhost:8000
- MySQL desde el host:
	- Host: `127.0.0.1`
	- Puerto: `3307`
	- Usuario: `root`
	- Contraseña: `test`

Dentro de la red Docker, los contenedores se comunican usando el puerto `3306` para MySQL.

## Comandos útiles

- Levantar en background (recomendado):

```bash
docker compose -f docker-compose.yml up -d --build
```

- Ver contenedores:

```bash
docker ps -a
```

- Ver logs de un contenedor (ejemplo):

```bash
docker logs --tail 200 docker-db-1
```

- Parar y eliminar recursos creados por compose:

```bash
docker compose -f docker-compose.yml down
```

## Revertir mapeos (opcional)
Si prefieres que los contenedores usen los puertos estándar del host (80 y 3306), debes parar los servicios locales que ocupan esos puertos (ej. `apache2`, `mysql`) y revertir los puertos en `docker-compose.yml`:

```bash
sudo systemctl stop apache2
sudo systemctl stop mysql   # o mariadb según tu instalación
# editar docker-compose.yml y cambiar a 80:80 y 3306:3306
```

## Nota sobre Docker Compose
Se detectó un error de tipo "panic"/segfault en la CLI de Docker Compose al usar el modo interactivo. Para evitarlo, usa la opción `-d` (detach). Si quieres puedo intentar actualizar Docker/Docker Compose para solucionar el bug de la CLI.

## Estado actual
- Los cambios están commiteados en `main`.
- Contenedores `docker-db-1`, `docker-phpmyadmin-1` y `docker-www-1` están en ejecución y accesibles por los puertos indicados arriba.

