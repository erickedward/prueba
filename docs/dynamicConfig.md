# Dynamic Configuration

Banca+ supports the change of configuration parameters during runtime without the need to restart the system.
This provides a zero-downtime way to change business rule parameters or messages without affecting the
product's availability.

The dynamic configuration system relies on redis' pub/sub to listen for configuration changes. Hence, even if you're
using couchbase as the data store for Banca+, you will still need a redis (although not a cluster) to have dynamic
configuration.

## Caveats

All configuration parameters can be changed dynamically. However, changing some parameters after the system
has started will have no effect whatsoever. Namely, changing database settings or the parameters used to connect
to any external system used directly by Banca+ will not affect the product until it is restarted. These include:

 - Connection parameters for redis
 - Connection parameters for couchbase
 - Connection parameters for logstash
 - Logging settings
 - Storage system (whether to use redis or couchbase)
 - Dynamic config settings (chicken & egg)

## Usage

__Important__: Dynamic configuration is disabled by default. If you wish to enable it put `dynamicConfig.enable = true`
on your configuration file. We suggest you put it in `embedded.conf` of your integration to prevent users from accidentally
enabling/disabling it.

Banca+ reads dynamic configuration from redis. The configuration must be signed using PGP with the proper private key that matches
the public key in bancaplus `main/resources/config.gpg`.

Two separate keys are read from redis: A key for the HOCON data itself (`dynamicConfig.configKey`) and a key for the PGP
signature of said data (`dynamicConfig.signatureKey`). By default, the names of these keys are `bancaplus::config` and
`bancaplus::config::signature` respectively.

If these values are set, Banca+ will attempt to load them during boot. Otherwise it will give a warning that the values
could not be loaded or that the signature is not valid.

During execution, if any message is sent on the redis channel indicated in `dynamicConfig.configKey`, Banca+ will
attempt to reload the dynamic configuration, using the same mechanism used during boot. you can send the message from the redis-cli
by typing `publish bancaplus::config anything` if you're using the default key names. You will see logs in Banca+ indicating
that the system is attempting to reload configuration.

All the dynamic configuration parameters with their default values are described next:

```
dynamicConfig {
  #Whether to enable dynamic configuration. If false, no attempt will be done to load it
  enable = false
  #The redis host from which the configuration will be loaded
  redisHost = "localhost"
  #The port on which we will connect to redis
  redisPort = 6379
  #Set redis password if needed. None is indicated by default
  #redisPassword = "1234"
  #The database number where the configuration is to be read from
  redisDatabase = 10
  #The redis key name that will hold the configuration data
  configKey = "bancaplus::config"
  #The redis key name that will hold the signature data
  signatureKey = "bancaplus::config::signature"
}
```
