# SSL (Actually, TLS) support

Banca+ supports TLS via the embedded spray-can server. If enabled, the port
configured with `core.services.default.listenPort` will listen only secure
connections (i.e. `https`).

## Configuration

You must add the following section to the `application.conf` file:

```
spray.can.server {
  ssl-encryption = on
  ssl {
    keyStoreFile = "myKeyStore.jks"
    password = "bancaplus"
  }
}
```

Where:
 - `keyStoreFile`: The location of the java key store that contains both the certificate and the private key to use for TLS connections
 - `password`: The password for the key store

If the configuration is not present, Banca+ will log a warning indicating that SSL support is not enabled.
## JRE Configuration
You have to download the [JCE Unlimited Policy](http://www.oracle.com/technetwork/java/javase/downloads/jce8-download-2133166.html)
and install it to your JRE/JDK.
For example:

In Windows:

JDK `C:\Program Files\Java\jdk1.8.0_65\jre\lib\security`

JRE `C:\Program Files\Java\jre1.8.0_65\lib\security`


## Generating a key store from pem certificate and private key

If you have your certificate and private key in PEM format (usually certificate providers offer this format), you can convert them
to a key store. You will need openSSL and the jdk installed in order to do this.

These instructions asume that the certificate filename is `bancaplus.crt` and the key filename is `bancaplus.key`.
You can set the `<alias>` and `<password>` parameters to your choosing. Change them to the values you wish to use.

1. Convert the pem files to a pkcs12 file

  ```
  openssl pkcs12 -export -in bancaplus.crt -inkey bancaplus.key \
                 -out bancaplus.p12 -name <alias>

  Enter Export Password: <password>
  Verifying - Enter Export Password: <password>
  ```

2. Convert the pkcs12 file to a key store

  ```
  keytool -importkeystore \
          -deststorepass <password> -destkeypass <password> -destkeystore bancaplus.keystore \
          -srckeystore bancaplus.p12 -srcstoretype PKCS12 -srcstorepass <password> \
          -alias <alias>
  ```

Now you can use `bancaplus.keystore` as the `keyStoreFile` parameter in the configuration. Make sure
to set the `password` parameter in the configuration to the same one you used when creating the key store.

__PS__: You can delete `bancaplus.p12` after creating the key store.

## Supported Protocols and Cipher Suites

In order to improve security, Banca+ only supports the following cipher suites and protocols:

### Cipher Suites

 - `TLS_ECDHE_RSA_WITH_AES_256_GCM_SHA384`
 - `TLS_ECDHE_RSA_WITH_AES_128_GCM_SHA256`
 - `TLS_DHE_RSA_WITH_AES_256_GCM_SHA384`
 - `TLS_DHE_RSA_WITH_AES_128_GCM_SHA256`
 - `TLS_DHE_RSA_WITH_AES_256_CBC_SHA256`
 - `TLS_DHE_RSA_WITH_AES_128_CBC_SHA256`
 - `TLS_ECDHE_RSA_WITH_AES_256_CBC_SHA384`
 - `TLS_ECDHE_RSA_WITH_AES_128_CBC_SHA256`
 - `TLS_ECDHE_RSA_WITH_AES_256_CBC_SHA`
 - `TLS_ECDHE_RSA_WITH_AES_128_CBC_SHA`
 - `TLS_DHE_RSA_WITH_AES_256_CBC_SHA`
 - `TLS_DHE_RSA_WITH_AES_128_CBC_SHA`

### Protocols

 - `TLSv1`
 - `TLSv1.1`
 - `TLSv1.2`
