@extends ('layouts.admin')
@section ('contenido')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Mueble</h3>
        </div>
        <form action="{{ route('producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" placeholder="Ingresa el nombre del mueble">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Material</label>
                            <input type="text" class="form-control" name="material" value="{{ $producto->material }}" placeholder="Ingresa el material del mueble">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" name="precio" value="{{ $producto->precio }}" placeholder="Ingresa el precio del mueble">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen">
                            @if ($producto->imagen)
                            <img src="{{ asset('imagenes/productos/'.$producto->imagen) }}" height="100px" width="100px">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
            </div>
        </form>
    </div>
</div>
@endsection
