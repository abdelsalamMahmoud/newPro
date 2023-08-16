@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Services of {{$doctor['name']}}</h2>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($services) && $services->count() > 0)
                @foreach($services as $service)
                    <tr>
                        <th scope="row">{{$service['id']}}</th>
                        <td>{{$service['name']}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <br><br>
        <h2>Add Services</h2>
        <br>
        <form method="POST" action="{{route('save.doctors.services')}}">
            @csrf

            <div class="mb-3">
                <label for="doctor_id" class="form-label">Select doctor</label>
                <select class="form-control" name="doctor_id">
                    @if(isset($doctors) && $doctors->count() > 0)
                        @foreach($doctors as $doctor)
                            <option value="{{$doctor['id']}}">{{$doctor['name']}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="mb-3">
                <label for="service_id" class="form-label">Select Services</label>
                <select class="form-control" name="service_id[]" multiple>
                    @if(isset($allServices) && $allServices->count() > 0)
                        @foreach($allServices as $oneService)
                            <option value="{{$oneService['id']}}">{{$oneService['name']}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                {{__('massage.save')}}
            </button>

        </form>

    </div>
@stop
