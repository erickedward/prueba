### Pasos para internacionalizar un valor en un esquema ###

1. Localizar el esquema con el valor a traducir. Por ejemplo, el valor del elemento _value_ del esquema _bar_ el cual se encuentra como subesquema de _foo_
```
foo = {
  bar = """
    (...)
    "value" = "Valor a traducir a los idiomas soportados"
    (...)
  """
}
```
2. Cambiar el valor por un código (el cual debe ser único) que identifique el valor a traducir para ser utilizado como placeholder. Este código debe colocarse entre comillas con un símbolo ampersand (&) al principio antes de las comillas que abren, de la siguiente manera: _&"schemas.code"_. Es preferible que de ser un esquema anidado en sub-esquemas este contenga lo nombres de los esquemas padres separados por puntos. Para el ejemplo mostrado anteriormente quedaría de la siguiente manera:
```
foo = {
  bar = """
    (...)
    "value" = &"schemas.foo.bar.value"
    (...) 
  """
}
```
3. Agregar en los _messages_ del archivo _embedded_ el valor en el idioma deseado de la siguiente manera:

```
en {
  schemas.foo.bar.value="Value to translate to the supported languages"
  (...)
}
```
```
es {
    schemas.foo.bar.value="Valor a traducir a los idiomas soportados"
    (...)
}
```
