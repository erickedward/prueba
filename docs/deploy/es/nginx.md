## Guía de despliegue / Nginx

La arquitectura de Banca+ requiere al menos un servidor de proxy reverso. Si bien se pueden usar otros servidores, esta guía explica cómo utilizar nginx como balanceador de carga y proxy reverso.

El servidor de proxy reverso cumple las siguientes funciones:
- 	Realiza cifrado TLS de las comunicaciones provenientes de la red externa (i.e. los clientes) hacia Banca+ Multicanal y hacia Admin+.
- 	Realiza balanceo de carga entre los servidores de Banca+ Multicanal
-	 Envía la información pertinente de las solicitudes como _headers_ HTTP a Banca+

### Configurar Nginx para Banca+ Multicanal

1.	Cree un archivo de configuración llamado bancaplus.conf en la carpeta `/etc/nginx/sites-available`
2.	Copie el certificado y la llave TLS a una carpeta en el servidor. En esta guía, supondremos que los mismos han sido copiados en
    `/etc/certificates/bancaplus.crt` y `/etc/certificates/bancaplus.key`
3.  Coloque la sección de configuración de servidores _upstream_. Estos son los servidores que ejecutan Banca+ Multicanal:
    ```
    upstream bancaplus {
    	      least_conn;
            server bancaplus1.mybank.internal:9000  fail_timeout=30s max_fails=2;
            server bancaplus2.mybank.internal:9000  fail_timeout=30s max_fails=2;
        }
    ```

    En este ejemplo suponemos que los nodos que ejecutan Banca+ multicanal tienen por nombre `bancaplusX.mybank.internal`. Si bien los
    nombres de los servidores son a discresión del despliegue, se recomienda usar nombres DNS en vez de direcciones IP para reducir el impacto
    en los cambios de configuración si el despliegue cambia.

    Se recomienda usar `least_conn` como método de balanceo de carga para Banca+, ya que dependiendo de la naturaleza de las peticiones de los
    clientes, estas pueden tener tiempos bastante diferentes de respuesta.

    Los valores `fail_timeout` y `max_fails` definen la política de reintentos si un servidor no responde en el tiempo apropiado. Puede referirse
    a la [guía de balanceo de nginx](http://nginx.org/en/docs/http/load_balancing.html) para más información sobre estos parámetros.

4.  Coloque la sección de configuración del servidor. Esta configuración debe indicar el nombre del servidor y la configuración TLS.
    ```
    server {
        listen 443 ssl;
        server_name bancaplus.mybank.com;
        ssl_certificate     /etc/certificates/bancaplus.crt;
        ssl_certificate_key /etc/certificates/bancaplus.key;

        location / {
            proxy_pass                       http://bancaplus;
            proxy_set_header Host            $host;
            proxy_set_header X-Real-IP       $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            #Timeouts
            proxy_connect_timeout  2s;
            proxy_read_timeout     40s;
        }
    }
    ```

    Si se usa `https` para comunicarse con los nodos internos de Banca+, debe colocarse `https://bancaplus` en vez de `http://bancaplus` en la configuración de `proxy_pass`.
    Es importante que el nombre del servidor colocado en `server_name` sea el nombre que ven las aplicaciones clientes desde su acceso externo. Este nombre debe coincidir
    con el nombre para el cual fue emitido el certificado TLS.

    Si se usa TLS hacia los nodos de Banca+ con certificados firmados internamente, es necesario agregar el certificado de la CA a la configuración de nginx para que el mismo
    pueda validar la cadena de confianza. Suponiendo que el certificado de la CA se encuentra en `/etc/certificates/internalCA.crt`:

    ```
      location / {
          #... Configuración base
          proxy_ssl_trusted_certificate /etc/certificates/internalCA.crt;
          proxy_ssl_verify              on;
          proxy_ssl_verify_depth        2;
          proxy_ssl_session_reuse       on;
      }
    ```

    Los parámetros [`proxy_connect_timeout`](http://nginx.org/en/docs/http/ngx_http_proxy_module.html#proxy_connect_timeout) y
    [`proxy_read_timeout`](http://nginx.org/en/docs/http/ngx_http_proxy_module.html#proxy_read_timeout) definen los tiempos a esperar por la respuesta de los nodos de Banca+ Multicanal.
    Estos valores deben ser ajustados acorde a los tiempos de respuesta esperados por toda la cadena de servicios que produzca resultados hacia los clientes.

Un ejemplo de una configuración completa sería el siguiente:
```
upstream bancaplus {
  #Se usa least_conn para hacer balanceo basado en el número de conexiones abiertas
  least_conn;
  #Estos son los nodos que ejecutan Banca+ Multicanal. Por defecto Banca+ multicanal se ejecuta en el puerto 9000.
  server bancaplus1.mybank.internal:9000  fail_timeout=30s max_fails=2;
  server bancaplus2.mybank.internal:9000  fail_timeout=30s max_fails=2;
}

server {
  listen 443 ssl;
  # Este debe ser el nombre del servicio de Banca+ Multicanal desde afuera de la infraestructura del banco o nube.
  server_name bancaplus.mybank.com;
  # Estos deben ser el certificado y la llave a usar para acceso público. El nombre en el certificado debe
  # coincidir con el nombre que esté en server_name.
  ssl_certificate     /etc/certificates/bancaplus.crt;
  ssl_certificate_key /etc/certificates/bancaplus.key;

  location / {
    proxy_pass                       http://bancaplus;
    #Si se usa HTTPS internamente, comentar la línea anterior y descomentar las siguientes:
    #proxy_pass                    https://bancaplus;
    #proxy_ssl_trusted_certificate /etc/certificates/internalCA.crt;
    #proxy_ssl_verify              on;
    #proxy_ssl_verify_depth        2;
    #proxy_ssl_session_reuse       on;

    proxy_set_header Host            $host;
    proxy_set_header X-Real-IP       $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    #Timeouts. Deben ser ajustados acorde a las respuestas de los servicios del banco.
    proxy_connect_timeout  2s;
    proxy_read_timeout     40s;
  }
}
```
