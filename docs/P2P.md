Consideraciones para el Front
  - El front debe validar si una cuenta puede realizar las transferencias P2P


Consolidado Cliente (Login)

  se agregara a la estrutura de los instruments los siguientes campos:

      - isP2PSource el instrumento esta afiliado para realizar transferencia P2P
      - isAbleP2P Indica que el instrumento puede ser afiliado a P2P
      - P2PAlias contiene el alias con referencia  a P2P

  Notas de funcionalidades:
    Para el caso de existir un balance disponible solo P2P, debe manejarse como un balance adicional en la lista de balances.

flujo de transferencia con beneficiario existen (modelo carrito)

  - get:/beneficiary Obtener la lista de beneficiarios

  - post:/transfer/schema con un beneficiario y el tipo b se obtiene el esquema de los datos necesario para el resto de la operacion

  - post/transfer/execuete ejecuta la transferencia.

  los cambios necesario para P2P son:
    - En el archivo de configuracioón:
      -incluir las categorias de beneficiario: "P2P same Bank" y "P2P other Bank"
      -incluir los schemaForm de esta dos categoria en transfer
      -incluir los schemaForm de esta dos categoria en beneficiary

Manejo de Beneficiarios

  El manejo de beneficiarios no cambia, pero existen unos error a resolver.
  La estructura de un beneficiario es:
    - Name: Nombre corto que se utiliza para las operaciones (Alias)
    - Description: Descricion del beneficiario
    - Category: Categoria de Beneficiario
    - isFavority: Indica si es un beneficiario favorito o no
    - Extrainfo: Toda la información necesaria para realizar la operacion segun la categoria. Esto se configura en los schemForm asociados.

  Por lo que es necesario que los servicio responda segun este esquema para esto hay que corregir:
    - En POST:/beneficiary de eleminarse de la peticion el pan
    - En Los schema form no deben estar los datos bases del Beneficiario

Manejo de transferencia anonimas
  La transferencia anonima es aquella que se realiza una vez con los datos necesario y no con un beneficiario guardado previamente.

  -get:/beneficiary/category devuelve  los id y descriciones de las categorias existentes indicando si permite transaciones anonimas este es un servicio nuevo
  -post:/transfer/schema con una categoria de Beneficiario en vez de un beneficiario. deberia devolver dos esquemas el de beneficiario y el de transferencia este es una modiciacion sobre un servivio existente
  -post/transfer/execuete ejecuta la transferencia, con los datos del beneficiario temporal, esta es una modificacion sobre un servicio existente
  -post:/beneficiary de desearse puede llamarse a este servicio con los para guardar el beneficiario. Este servicio se coloco como referencia no tiene cambios


Manejo de Afiliaciones

  la aficion es un REST completo sobre los datos de afiliacion (P2P)

  -get:/affiliation devuelven las afiliaciones existentes
  -get:/affiliation/schemna devuelve el schemaForm a llena para una afiliacion
  -post:/affiliation crea una afiliacion nueva
  -put:/affiliation modifica una afiliacion
  -delete:/affiliation elimina una afiliacion


Revisar el servicio get /user/search
Verificar si se ve afectado por los cambios




