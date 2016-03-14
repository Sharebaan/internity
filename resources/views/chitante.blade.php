@extends('layouts.app')
@section('title','Chitante')
@section('content')
  <div class="container">
    <div class="row" style="margin-bottom:10px;">
      <form class="col-xs-4 col-sm-4 col-md-4 col-lg-4" method="get" action="/searchplata" role="search">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Cauta" name="plata">
              <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
          </div>
          <input type="hidden" name="userid" value="">
      </form>
      <form class="col-md-4 col-md-offset-4" action="/rangeplata" id="range" method="get">
        <div class="input-group input-daterange">
            <input type="text" placeholder="Prima data" name="f" id="f" class="form-control" value="">
            <span class="input-group-addon">pana la</span>
            <input type="text" placeholder="Ultima data" id="l" name="l" class="form-control" value="">
        </div>
      </form>
    </div>



      <div class="row">
          <div class="col-md-12 ">
              <div class="panel panel-default">
                  <div class="panel-heading">Chitante</div>
                  <div class="panel-body">
                    <div class="table-responsive">
                     <table class="table table-small-font table-bordered table-striped table-hover">
                       <tr>
                         <th>Utilizator</th>
                         <th>CodAbonatRtc</th>
                         <th>SumaPlatita</th>
                         <th>DataPlatii</th>
                         <th>OraPlatii</th>
                         <th>ModPlata</th>
                         <th>ObiectPlata</th>
                         <th>Telefon</th>
                         <th>IdAgentIncasator</th>
                       </tr>
                      @foreach($c as $k=>$v)
                        <tr>
                          <td>{{$v['user']->name}}</td>
                          <td>{{$v->CodAbonatRtc}}</td>
                          <td>{{$v->SumaPlatita}}</td>
                          <td>{{$v->DataPlatii}}</td>
                          <td>{{$v->OraPlatii}}</td>
                          <td>{{$v->ModPlata}}</td>
                          <td>{{$v->ObiectPlata}}</td>
                          <td>{{$v->Telefon}}</td>
                          <td>{{$v->IdAgentIncasator}}</td>
                          <td><a href="plata/{{$v->id}}">Deschide</a></td>
                        </tr>
                      @endforeach
                     </table>
                  </div>
                  {{$c}}
                  </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">

  $('.input-daterange input').each(function() {
    $(this).datepicker("clearDates");
  });
  $('.input-daterange input') .on("changeDate", function(e) {
        //console.log(e);
        //$(this).addClass('done');
        //console.log($(this).attr('id'));
        if($(this).attr('id') == 'f'){
          if(!$('#f').hasClass('done')){
            $('#f').addClass('done');
          }
        }else if($(this).attr('id') == 'l'){
          if(!$('#l').hasClass('done')){
            $('#l').addClass('done');
          }
        }

        if($('#f').hasClass('done') && $('#l').hasClass('done')){
          $('#range').submit();
        }
    });
  </script>
@endsection
