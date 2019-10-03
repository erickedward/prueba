[<< Volver al inicio](../../../)
# Estructura de Servicios

_La configuración de los servicios se definen en el archivo_ ***bancaplus.yaml***_; este se encuentra ubicado en la siguiente dirección_

    bancaplus-v3/bancaplus/src/main/resources/

_Para configurar un nuevo servicio este debe definirse con la siguiente estructura:_

1. #### Ruta del servicio

        Ejemplo “/request/categories:”

1. #### Método HTTP:

    _Los métodos HTTP definen la acción que se realizará sobre un determinado recurso._
    1. ***GET:*** _Es utilizado únicamente para consultar información al servidor, muy parecidos a realizar un SELECT a la base de datos. No soporta el envío del payload._
    1. ***POST:*** _Es utilizado para solicitar la creación de un nuevo registro, es decir, algo que no existía previamente, es decir, es equivalente a realizar un INSERT en la base de datos. Soporta el envío del payload._
    1. ***PUT:*** _Se utiliza para actualizar por completo un registro existente, es decir, es parecido a realizar un UPDATE a la base de datos. Soporta el envío del payload._
    1. ***PATCH:*** _Este método es similar al método PUT, pues permite actualizar un registro existente, sin embargo, este se utiliza cuando actualizar solo un fragmento del registro y no en su totalidad, es equivalente a realizar un UPDATE a la base de datos. Soporta el envío del payload_
    1. ***DELETE:*** _Este método se utiliza para eliminar un registro existente, es similar a DELETE a la base de datos. No soporta el envío del payload._

1. #### operationId: 
    
    _Define el nombre de la función donde se va a dirigir la ruta, es decir; el lugar a donde se van implementar una serie de acciones a ejecutarse cuando sea invocado el servicio._
    
1. #### tags: 

    _Define la sección del swagger donde se mostrara nuestro servicio. Por otro lado también define a que archivo se dirigirá nuestro servicio al ser invocado. Ejemplo:_
    _Si en nuestro tags tenemos definido lo siguiente:_
    ```csharp
    tags:
    - affiliation
    ```
    _Nuestro servicio se dirigirá a la ruta:_
    >bancaplus-v3/bancaplus/src/main/scala/com/synergygb/bancaplus/rest/public/

    _al archivo:_
    >AffiliationRoutesImpl.scala

1. #### summary:
    _Es un resumen muy corto que defina la funcionalidad del servicio. Ejemplo:_
        
        summary: Lists all affiliations
    
1. #### description:
    _Es donde se describen la definición, las notas de implementación y observaciones necesarias a conocer del servicio. También se deben mencionar los endpoints o puntos finales de integración que utiliza el servicio. Si este ultimo ejecuta mas de un endpoints los mismos deben ser mencionados._

1. #### parameters:
    _En este punto se definen los parámetros requeridos por el servicio o la ruta, por lo general todos los servicios poseen por defecto lo siguiente:_
        
        $ref: "#/parameters/Language"

    _Adicionalmente al lenguaje se definen los propios del servicio con los datos a continuación:_

    1. ***name:*** _Nombre del Parametro_
    1. ***required:*** _true_
        >Valor Booleano en minúscula
    1. ***in:*** Define si el parámetro sera enviado a la ruta por alguno de los siguientes medios:
	    >header, body, path, query
    1. ***type:*** Define el tipo de parámetro, el mismo debe ser colocado en minúscula; ejemplo:
	    >string, integer, file, etc
    
    _Cuando el parámetro requiere una definición de tipo JSON se debe hacer mención a una “schema” como es el caso del lenguaje en vez de a un   “type” ejemplo:_
    ```csharp
    schema:
        $ref: "#/definitions/NewAffiliation"
    ```
    _Y se define aparte el schema. Ejemplo:_

    ```csharp
    NewAffiliation:
  	  type: object
        required:
          - category
        properties:
          category:
            type: string
            description: The type of beneficiary. This will determine what extra info the beneficiary must have.
          extraInfo:
            type: object
            description: Extra values associated to the affiliation. These values must conform to the affiliation type json schema.
    ```
1. #### responses:
    _Es la respuesta a la solicitud con un código de respuesta HTTP. Se deben definir cada una de las respuesta que puede arrojar un servicio determinado. Ejemplo:_
    ```csharp
    403:
        $ref: "#/responses/requiresPrivileges"
    200:
        description: The affiliation was edited successfully.
        schema:
            $ref: "#/definitions/MessageResponse"
    400:
        description: The affiliation did not have all the necessary information.
        schema:
            $ref: "#/definitions/MessageResponse"
    ```
[<< Volver al inicio](../../../)