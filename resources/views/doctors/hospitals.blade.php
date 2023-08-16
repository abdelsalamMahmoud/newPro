@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Hospitals</h2>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">address</th>
                <th scope="col">operations</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($hospitals) && $hospitals->count() > 0)
                @foreach($hospitals as $hospital)
                    <tr>
                        <th scope="row">{{$hospital['id']}}</th>
                        <td>{{$hospital['name']}}</td>
                        <td>{{$hospital['address']}}</td>
                        <td>
                            <a href="{{route('doctors.all',$hospital['id'])}}" class="btn btn-success">Show doctors</a>
                            <a href="{{route('delete.hospital',$hospital['id'])}}" class="btn btn-danger">Delete Hospital</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop
