Funcionalidad de Cobro/Coleta (Recaurdar un monto entre varios beneficiarios)
 dos  servicios a implementar:
    - POST /collections para procesar la solicitud de cobro/coleta
    - GET /collections para revisar el estado de los cobos/coletas
    
  Adicionalmente hay que agregar a la categoria de beneficiario un campo que indique que puede participar en un cobro/coleta
  El POST debe funcionar de forma simialr al POST /transfer/execute "invocando" por cada item al endpoit

Funcionalidad de Pago/contribución (Paga montos solictados por alguien)
  El flujo el funcionamiento es similar al de appovals, los servicios a implementar:  
    - GET /contributions obtener los pagos/contribuciones pendientes
    - POST /contributions para procesar los pagos/contribuciones (aproval o rechazar)
