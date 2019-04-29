<!doctype html>
<?php
    date_default_timezone_set('America/Sao_Paulo');
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Estacionamento</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>
    <body>
      <div class="container-fluid">
        <!-- ENVIO DA PLACA--> 
        <div class="mt-3">  
            <div class="row justify-content-md-center"> 
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Estacionamento
                        </div>
                        <div class="card-body">
                            <form action="{{route('entrada.store')}}" method="POST" >
                                @csrf
                              <div class="form-group">
                                <label for="exampleInputPlaca">Placa</label>
                                <input type="text" class="form-control" name="placa" aria-describedby="emailHelp" placeholder="Placa">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputHora">Hora</label>
                                <input type="text" class="form-control" name="entrada_h" value="{{date('h:i')}}">
                              </div>
                              <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- ENVIO DA PLACA-->
        <div class="row justify-content-md-center">
          <div class="table-responsive col-md-8">
            <table class="table table-bordered mt-3">
              <thead>
                <tr>
                  <th scope="col">Placa</th>
                  <th scope="col">Entrada</th>
                  <th scope="col">Finalizar</th>
                </tr>
              </thead>
              <tbody>
                @foreach (\App\entrada::all() as $entrada)
                @if(!isset($entrada->saida_h))
                <tr>
                  <th>{{$entrada->placa}}</th>
                  <td>{{$entrada->entrada_h}}</td>
                  <td>        
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$entrada->id}}">
                      Finalizar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$entrada->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('entrada.update',$entrada->id)}}" method="POST">
                              @csrf
                              @method('put')
                              <div class="form-group">
                                <label for="exampleInputPlaca">Placa</label>
                                <input type="text" class="form-control" name="placa" aria-describedby="emailHelp" value="{{$entrada->placa}}">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputHora">Entrada</label>
                                <input type="text" class="form-control" value="{{$entrada->entrada_h}}">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputSaida">Saida</label>
                                <input type="text" class="form-control" name="saida_h" value="{{date('h:i')}}">
                              </div>
                              <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal do botão -->
        <!-- Relatorios -->
        <p>
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Relatorio
          </a>
        </p>
        <div class="collapse col-md-8" id="collapseExample">
          <div class="card card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Placa</th>
                  <th scope="col">Entrada</th>
                </tr>
              </thead>
              <tbody>
                @foreach (\App\entrada::all() as $entrada)
                @if(!isset($entrada->saida_h))
                <tr>
                  <th>{{$entrada->placa}}</th>
                  <td>{{$entrada->entrada_h}}</td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- Relatorios -->
      </div>
    </body>
</html>
