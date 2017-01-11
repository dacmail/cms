# ProteCMS

ProteCMS es gestor para protectoras de animales. Un proyecto que ofrece la posibilidad de tener una página web totalmente gratuita a las protectoras de animales. Cada protectora tendrá total libertad y podrán gestionar su protectora a través de un completo panel de administración.

**Atención**

> ProteCMS es un software como servicio, __NO__ está pensado para ser instalado en otros servidores ya que gestiona múltiples protectoras a la vez. Si lo hace, tenga en cuenta que perderá las actualizaciones y soporte. 

> * Si eres una protectora y quieres una página web gratis visita la [página del proyecto](http://protecms.com).
> * Si eres un desarrollador y quieres colaborar con el proyecto visita la [página para desarrolladores](http://protecms.com/desarrolladores).


## Índice
* [Requisitos](#requisitos)
* [Instalación](#instalacion)
    * [Homestead](#homestead)
    * [Clonando el repositorio](#clonando-el-repositorio)
    * [Instalar dependencias](#instalar-dependencias)
    * [Configurar entorno](#configurar-entorno)
    * [Migraciones y semillas](#migraciones-y-semillas)
* [Gestión del proyecto](#gestion-del-proyecto)
* [Colaboradores](#colaboradores)
* [Errores](#errores)

## Requisitos
- [PHP 7.1](http://php.net/)
- [MySQL 5.6](https://www.mysql.com/)
- [NodeJS (npm)](https://nodejs.org/)
- [Composer](https://getcomposer.org/)

> Todos los requisitos están dentro de Homestead (ver abajo)

## Instalación

### Homestead

Homestead es el paquete oficial de Laravel para Vagrant. 

Instalar siguiendo la [documentación oficial](https://laravel.com/docs/5.3/homestead).

### Clonando el repositorio

Una vez instalado y configurado Homestead se clona el repositorio dentro de la máquina virtual.

```
git clone git@github.com:protecms/cms.git
```

### Instalar dependencias

Instalar las dependencias del proyecto:

```
composer install
```

Instalar las dependencias javascript:

```
npm install
```

Una vez instaladas las dependencias ejecutar gulp:

```
gulp
```

### Configurar entorno

Para configurar el entorno hay que duplicar el archivo *.env.example* y nombrarlo como *.env*.

Una vez duplicado, se edita el archivo *.env* para adaptarlo a la configuración del entorno.

### Migraciones y semillas

Cuando se haya configurado el entorno correctamente se ejecuta el siguiente comando para crear la estructura de la base de datos e insertar los datos necesarios:

```
php artisan migrate --seed
```

## Gestión del proyecto

La gestión de proyecto se realiza mediante [Trello](https://trello.com/b/j4eAFtN1/protecms).

## Colaboradores
- [Jaime Sares](http://jaimesares.com)
- [Ver más...](https://github.com/protecms/cms/graphs/contributors)

## Errores

Si detecta cualquier error, por pequeño que sea, no dudes en ponerte en contacto a web@protecms.com ofreciendo todos los detalles posibles (navegador, versión, sistema operativo, pasos para producirlo, etc). Asegúrate antes de que no está en la columna de Errores en el gestor del proyecto.

