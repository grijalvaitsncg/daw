@extends('dash.layouts.main')
@section('contenido')
    <div class="container-fluid">
         <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Productos</h1>
            <a href="#" data-toggle="modal" data-target="#modalAdd" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-upload fa-sm text-white-50"></i> Agregar Producto</a>
        </div>
        <div class="row">
            <!--SUCCESS  -->
            @if($message = Session::get('Listo'))
                <div class="row alert alert-success fade show">
                    <h5 class="col-12"> <i class="fa fa-check"></i> Alerta</h5> 
                    <br>
                    <br>
                    <p>{{ $message }}</p>
                </div>
            @endif
            <!-- PRINT PRODUCTS -->
            <div class="row">
                @foreach($nfts as $nft)
                    <div class="card col-3" >
                        <img class="card-img-top" 
                            src="{{ asset('/nfts/'.$nft->img) }}" 
                            alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">{{ $nft->name }}</h5>
                        <p class="card-text">{{ $nft->description }}</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                @endforeach

            </div>
                

        </div>
        <!-- ERRORES-->
        @if($message = Session::get('ErrorInsert'))
            <div class="row alert alert-danger alert-dismissable fade show" role="alert">
                <h5>Error: {{$message}}</h5>
                <br><br>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <!-- MODAL AGREGAR -->
    <div class="modal" tabindex="-1" role="dialog" id="modalAdd">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Agregar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/admin/productos" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input  type="text" class="form-control" 
                            placeholder="Nombre Producto" name="name" 
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <input type="text" class="form-control" placeholder="Descripcion" name="description"
                        value="{{ old('description')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Precio Base</label>
                        <input type="number" class="form-control" placeholder="Precio Base" name="price"
                        value="{{ old('price')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control" name="img"  
                            value="{{ old('img')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Blockchain Type</label>
                        <select name="btype" id=""  class="form-control"  value="{{ old('btype')}}">
                            <option value="Etherium">Etherium</option>
                            <option value="Polygon">Polygon</option>
                            <option value="Klaytn">Klaytn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Categoria</label>
                        <select name="cate" id="" class="form-control"  value="{{ old('cate')}}">
                            @foreach($categorias as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
                </div>

            </form>

          </div>
        </div>
    </div>
@endsection