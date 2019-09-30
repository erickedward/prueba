## Guía de despliegue / Logstash

[Logstash](https://www.elastic.co/products/logstash) es el recolector de _logs_ utilizado en Banca+. Es el encargado
de recibir logs desde los nodos de Banca+ multicanal, recolectarlos y almacenarlos en base de datos. Una vez allí
pueden ser consultados desde [Kibana](https://www.elastic.co/products/kibana) o de cualquier otra herramienta que
pueda leer desde ElasticSearch.


### Importante

Para que el envío de logs funcione apropiadamente, es necesario configurar en los nodos de Banca+ Multicanal la ubicación
del servidor de Logstash hacia el cual se enviarán los logs. Para esto, se debe agregar la siguiente información en el
archivo `application.conf` de Banca+ Multicanal:

```
core {
  logging {
    context = "bancaplus"
    enableLogstashLogging = true
    logstashHost = "logstash.mybank.internal"
    logstashPort = 5000
    # Define el nivel de logging para logstash. Para desarrollo y QA, DEBUG es apropiado.
    # Para producción, INFO es apropiado.
    logstashLogLevel  = "DEBUG"
  }
}
```

Este ejemplo supone que el servidor `logstash.mybank.internal` es el que ejecuta el servidor de Logstash.

### Configuración de Logstash

Una vez instalado Logstash, es necesario configurarlo para que pueda recibir correctamente los logs enviados por Banca+ Multicanal.

1. Crear un archivo en el servidor de Logstash llamado `/etc/logstash/conf.d/10-bancaplus.conf`
2. Colocar el siguiente contenido en el archivo:
   ```
   input {
     tcp {
       port => 5000
       codec => json_lines
     }
   }

   output {
     elasticsearch {
       hosts => [ "elastic1.mybank.internal:9200", "elastic2.mybank.internal:9200" ]
     }
   }
   ```

   En el ejemplo, `elasticX.mybank.internal` son los nodos que ejecutan ElasticSearch, donde se almacenarán los logs.
3. Reiniciar logstash.
