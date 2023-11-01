@php use App\Models\Teacher; @endphp
@foreach($teachers as $teacher)
    
    <p>{{$teacher->first_name}} {{$teacher->last_name}}</p>
    <p>{{$teacher::country()->country_name}}</p>
@endforeach