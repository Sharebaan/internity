@extends('layouts.app')
@section('title','Useri')
@section('content')

  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="panel panel-default">
                  <div class="panel-heading">Useri</div>
                  <div class="panel-body">
                    <div class="table-responsive">
                     <table class="table table-small-font table-bordered table-striped table-hover">
                       <tr>
                         <th>Id</th>
                         <th>Nume</th>
                         <th>E-mail</th>
                         <th>Drepturi</th>
                         <th>Activ</th>
                         <th>Creat</th>
                         <th>Updatat</th>
                       </tr>
                      @foreach($users as $k=>$v)
                        <form  action="/cms/useri" method="post">
                        <tr>
                          <td>{{$v->id}}</td>
                          <td class="data {{$k}}"><p>{{$v->name}}</p><input type="text" class="form-control" style="display:none;" name="name" value="{{$v->name}}"></td>
                          <td class="data {{$k}}"><p>{{$v->email}}</p><input type="text" class="form-control" style="display:none;" name="email" value="{{$v->email}}"></td>
                          <td class="data {{$k}}"><p>Admin</p> <select class="form-control" style="display:none;" name="admin" value="@if($v->admin == 1) Admin @else Client @endif">
                            <option>Admin</option>
                            <option>Client</option></select>
                          </td>
                          <td class="data {{$k}} col-xs-1">@if($v->active == 1)
                              <p>Da</p>
                           @else
                             <p>Nu</p>
                           @endif </p><select name="active" class="form-control" style="display:none;" value="@if($v->active == 1)Da @else Nu @endif">
                            <option value="1">Da</option>
                            <option value="0">Nu</option>
                          </select></td>
                          <td>{{$v->created_at}}</td>
                          <td>{{$v->updated_at}}</td>
                          <td class="col-md-1"><a href="#" class="edit {{$k}} btn btn-primary">Editeaza</a></td>
                          <td class="save {{$k}}" style="display:none;"><input type="submit"  class="form-control btn btn-primary" value="Salveaza"></td>
                        </tr>
                        <input type="hidden" name="id" value="{{$v->id}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </form>
                      @endforeach
                     </table>
                  </div>
                  {{$users}}
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">
    $('.edit').click(function(){

      var chain = $(this).attr('class').split(/\s+/)[1];

      if($(this).hasClass('a')){
        $('.data.'+chain).children().show(200);
        $('.data.'+chain).children().next().hide();
        $(this).removeClass('a');
        $('.save.'+chain).hide();
        $(this).text('Editeaza');
      }else{
        $('.data.'+chain).children().hide();
        $('.data.'+chain).children().next().show(200);
        $(this).addClass('a');
        $('.save.'+chain).show(200);
        $(this).text('Anuleaza');
      }

    });
  </script>
@endsection
