@extends('layouts.app')
@section('page_name', 'Produtos')
@section('content')
    <section>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg mb-2">Novo Produto</a>
    </section>
    <section>
        @if (count($products) > 0)
            <table class="table table-striped table-responsive">
                <thead>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço atual</th>
                    <th>Ações</th>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td> <img class="rounded float-start" style="max-width: 200px" src="{{ $item->getImage() }}"
                                    alt=""></td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td style="min-width: 100px"><strong>{{ $item->price }}</strong></td>
                            <td>
                                <a href="{{ route('products.edit', $item->slug) }}"
                                    class="btn btn-primary btn-xs">editar</a>
                                <form method="POST" action="{{ route('products.destroy', $item->id) }}"
                                    style="display: inline" onsubmit="return confirm('deseja remover este produto ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i> remover</button>
                                </form>
                                <button class="btn btn-primary btn-xs" type="button"
                                    data-bs-toggle="modal" data-bs-target="#modal-{{$item->slug}}">histórico de preços</button>
                                <div class="modal fade" id="modal-{{$item->slug}}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Histórico de Preços</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="col-12">
                                                    <thead>
                                                        <th>Data</th>
                                                        <th>Usuário</th>
                                                        <th>Preço</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->productHistories as $item2)
                                                            <tr>
                                                                <td>{{ date('d-m-Y H:i:s',strtotime($item2->created_at)) }}</td>
                                                                <td>{{ $item2->user->name }}</td>
                                                                <td>{{$item2->price}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h5>Nenhum produto cadastrado na base de dados.</h5>
        @endif
    </section>
@endsection
