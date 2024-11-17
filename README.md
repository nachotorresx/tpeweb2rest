<<<<<<< HEAD
# SistemaNt App

Integrantes:

•	Lucas Piscicelli.

•	Ignacio Torres.

![Diagrama DB](https://github.com/nachotorresx/tpeweb2/blob/main/DiagramaDB.PNG?raw=true)


- GET `http://localhost/tpeweb2rest/api/productos`

  - Query Params:

    - Ordenamiento:

      - `orderBy`: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:
        
        tpeweb2rest/api/productos?orderBy=precio
        tpeweb2rest/api/productos?orderBy=descripcion
        tpeweb2rest/api/productos?orderBy=precio

      - `direccion`: Dirección de orden para el campo especificado en `orderBy`. Puede ser:
        - `ASC`: Orden ascendente (por defecto).
        - `DESC`: Orden descendente.

      Ejemplo de Ordenamiento:  
      Para obtener todos los productos ordenados por precio en orden descendente:
        
        tpeweb2rest/api/productos?orderBy=precio&direccion=DESC

    - Filtrado:

      - `filtro`: Campo por el que se desea filtrar los resultados. Los campos válidos pueden incluir:

        - `nombre`: Filtra los productos por el destino de inicio.
        - `descripcion`: Filtra los productos por el destino final.
        - `precio`: Filtra los productos por precio y muestra los menores al valor pasado.
        - `categoria`: Filtra los productos por categoria.

      - `valor`: Valor que se utilizará para el filtrado. Debe ser el valor específico que se comparará con el campo filtrado.

      Ejemplo de Filtrado:  
      Para obtener todos los productos que contengan en el campo 'nombre' un texto 'lake':

        tpeweb2rest/api/productos?filtro=nombre&valor=lake
   

    Paginacion:

      - `pagina`: Numero de pagina a mostrar.
      - `limite`: Cantidad de productos a mostrar.

      Ejemplo de paginado:  
      Para obtener todos los productos de la 'pagina' 2 que muestre 3 por pagina (´limite´):

        tpeweb2rest/api/productos?pagina=2&limite=3


---

- GET `tpeweb2rest/api/productos/:ID`  
  Devuelve el producto correspondiente al `ID` solicitado. //el 36 por ej.

---

- POST `tpeweb2rest/api/productos`  
  Inserta un nuevo producto con la información proporcionada en el cuerpo de la solicitud (en formato JSON).

  - Campos requeridos:

    - `nombre`: Nombre del producto.
    - `descripcion`: Descripcion del producto.
    - `precio`: Precio del producto
    - `id_categoria`: Categoria del producto. (valor numerico)
    - `URL_imagen`: Url de la imagen del producto.

    Ejemplo de json a insertar:

    ```json
    {
      "nombre": "Heaven Burger",
      "descripcion": "Hamburguesa con dambo, provolone, mayo picante. Incluye papas.",
      "precio": 8000,
      "id_categoria": 1,
      "URL_imagen": "http://....."
    }
    ```

---

- PUT `/api/productos/:ID`  
  Modifica el producto correspondiente al `ID` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - Campos modificables:
    - `nombre`
    - `descripcion`
    - `precio`
    - `URL_imagen`

---

- DELETE `/api/productos/:ID`  
  Elimina el producto correspondiente al `ID` solicitado.

---

Autenticación

- GET `/usuarios/token`  
  Este endpoint permite a los usuarios obtener un token JWT.

  - iniciar sesión:

    - Nombre de usuario: `webadmin`
    - Contraseña: `admin`

