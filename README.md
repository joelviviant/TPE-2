# API REST para el recurso de productos de inventarios


## Importar la base de datos
- importar db_cart.sql, ubicado en la carpeta del proyecto


## Pueba con postman
El endpoint de la API es: http://localhost/carpetalocal/TPE-2/api/products


## ENDPOINTS
- /products 
- /products/ID
- /categories
- /categories/ID

## VERBOS
- GET
- POST
- PUT
- DELETE


## Como Usar?

- PRODUCTOS:

- /products con el verbo GET, trae una coleccion entera de todos los productos con sus detalles, se le pueden agregar parametros para la paginacion(page, per_page)o un filtro por categoria(categoria), o un ordenamiento por un campo especifico(sort, order).

- /products/ID con el verbo GET, trae un producto especifico.

- /products con el verbo POST, inserta el prodcuto en la base de datos, completando los datos correspondientes.

- /products/ID con el verbo DELETE, elimina el producto que queremnos, señalandolo con el id para identificarlo.

- products/ID con el verbo PUT, edita el producto señalado, completando todos los campos.

- CATEGORIAS:

- /categories con el verbo GET, trae una coleccion entera de todas las categorias almacenadas, con su ID.

- /categories/ID con el verbo GET, trae una categoria especifico.

- /categories con el verbo POST, inserta la categoria en la base de datos, completando los datos correspondientes.

- /categories/ID con el verbo DELETE, elimina la categoria que queremnos, eliminando tambien todos los productos relacionados a esa categoria.

- categories/ID con el verbo PUT, edita la categopria señalada, completando todos los campos.