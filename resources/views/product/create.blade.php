@extends('layouts.app')
@section('page_name','Produtos')
@section('content')
    <section>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mb-2">Voltar</a>
    </section>
    <section>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible col-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Atenção!</h5>
                <strong>Verifique os campos com erros abaixo.</strong><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-6">
                    <label for="name">Nome *</label>
                    <div class="form-group">
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Insira o name">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="price">Preço *</label>
                    <div class="form-group">
                        <input type="text" step="0.1" id="price" name="price"
                            class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                            placeholder="Insira o preço">
                        @if ($errors->has('price'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="file">Imagem *</label>
                    <div class="form-group">
                        <input type="file" name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            placeholder="Insira o arquivo da filem">
                        @if ($errors->has('file'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
    </section>
@endsection
