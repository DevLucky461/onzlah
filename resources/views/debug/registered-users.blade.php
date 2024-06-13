@extends('layouts.blank-app')

@section('prescript')
<div class="container-fluid">
  <div class="row">
    <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Registered User</h5>
      <p class="card-text">Currently Registered Users: {{$usercount}}</p>

      <b class="font-weight-bold">Register activity for the last 7 Days</b>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Count</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $u)
          <tr>
            <td>{{today()->modify('-'.$loop->index." day")->format('d/m/Y')}}
            <td>{{$u->count()}}
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

  </div>
</div>

@endsection

@section('content')

@endsection

@section('postscript')
 
@endsection