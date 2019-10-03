[<< Volver al inicio](../../../)

## Uso de schema form dentro de bancaplus-v3.

Este markdown es para explicar las implementaciones extras que realiza
v3 con referente a los schema form, para una explicación completa de que
puede hacer schema form y las cosas básicas en el front tanto de móvil 
como la web se tiene la documentación de 
[schema form](https://github.com/json-schema-form/angular-schema-form/blob/master/docs/index.md)
y para hacer pruebas sencillas se encuentra el 
[demo](http://schemaform.io/examples/bootstrap-example.html). Todo esto 
se encuentra disponible en su [página principal](http://schemaform.io/). 

### Schema y el Form.

Los schema form cuentan con 3 partes principales, el form, el schema y 
el model, en este caso desde de v3 se manda tanto el form como el schema,
donde las propiedades que son del form tienen como prefijo `x-` y se 
coloca el id del campo y el valor deseado. Ej:

```
"x-type": {
  "id": "value"
},
```

Los form que se tienen hasta ahora en los fronts son:

- `x-titleMap`
- `x-title`
- `x-condition`
- `x-validationMessage`
- `x-placeholder`
- `x-readOnly`
- `x-extraInfo`

Los form que no existen en schema form y fue agregado en los fronts son:

1. `x-readOnly`: Sirve para indicar que el campo no se puede modificar 
y solo es de lectura.

2. `x-extraInfo`: se usa para agregar una información extra al campo, 
se muestra un icono de información y abre un popup con un html.

#### Diferencias entre la web y la móvil.

La web no usa el `x-validationMessage` pero la móvil si, para el manejo 
de los códigos de los mensajes de errores esta el 
[link](https://github.com/json-schema-form/angular-schema-form/blob/development/src/services/sf-error-message.provider.js)
al código con mensajes determinados dependiendo del código. El `x-title` 
en la móvil es como un separador entre campos mientras en la web cada 
campo tiene su título. En la móvil en el tipo de `checkbox` se usa el 
description para colocar el nombre del checkbox que no es el título.

### Tipos usados en la web y la móvil.

Los tipos probados en los front de bancaplus son:

- `string`
- `number`
- `radios`
- `select`
- `checkbox`
- `checkboxes`

Se pueden agregar nuevos tipos, pero la móvil o la web tienen que 
implementarlos y los que tiene por defecto schema form se tienen que 
probar para ver su comportamiento.

### Velocity en los schema forms.

Velocity se usa para usar métodos definidos en java, para todo lo que
puede hacer velocity se encuentra en su 
[documentación](http://velocity.apache.org/engine/2.0/user-guide.html#about-this-guide).
En v3 se usa principalmente para acceder a los valores definidos en
el endpoint en el schema, ej:

```
#foreach( $account in $accounts )
  {"value": "$account.value",
  "name": "$account.name",
  "nameRight": "$account.nameRight"}#if($foreach.hasNext),#end
#end
``` 

Se tiene un valor accounts definido en el endpoint que es un mapa,
el cual se recorre y se coloca sus valores en las propiedades del 
schema que sea necesario.

### Características extras de bancaplus.

1. `amounts`: amounts es un arreglo que declara los campos que se deben
tratar como un monto de alguna moneda, le indica al front que esos 
campos tienen un comportamiento especial y una verificación extra que 
se realiza.

2. `info`: es para agregar información extra a las opciones de los 
radios o checkboxes, es la misma función de x-extraInfo y se pueden 
usar los 2 ya que x-extraInfo sería para el campo en general y el info
para cada uno de los valores dentro del radios o checkboxes.

3. `nameRight`: Se usa para agregar información a la derecha de los
valores del campo, ya sea radios o checkboxes usualmente se usa para 
colocar la cantidad de dinero de las cuentas pero puede ser usado para
cualquier información extra.

### Agregar característica extras a los schemas.

Para agregar características extras al schema form se tiene que 
notificar a la móvil y a la web de ser necesario y agregar los cambios
en v3.

[<< Volver al inicio](../../../)