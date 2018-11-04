{!! Form::open(['route' => [$product->url(), $product->id],'method' => $product->method(), 'class' => 'app-form']) !!}
    <div>
        {!! Form::label('title', 'Titulo del Producto') !!}
        {!! Form::text('title', $product->title, ['class' => 'form-control']) !!}
    </div>
    <div>
        {!! Form::label('description', 'Descripcion del Producto') !!}
        {!! Form::textarea('description', $product->description, ['class' => 'form-control']) !!}
    </div>
    <div>
        {!! Form::label('price', 'Precio del Producto') !!}
        {!! Form::text('price', $product->price, ['class' => 'form-control']) !!}
    </div>
    <div>
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
{!! Form::close() !!}