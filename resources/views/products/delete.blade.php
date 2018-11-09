{!! Form::open(['method' => 'DELETE', 'route' => ['productos.destroy', $product->id], 'onsubmit' => 'return confirm("Estas seguro de Eliminar el producto?")']) !!}

<input type="submit" value="Eliminar Producto" class="btn btn-danger">

{!! Form::close() !!}