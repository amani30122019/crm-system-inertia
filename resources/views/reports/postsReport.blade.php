@extends('reports.root')
@section('title','Posts Report')
@section('content')
<table>
    <thead>
        <tr>
            <th>
                <strong>ID</strong>
            </th>
            <th>
                <strong>Title</strong>
            </th>
            <th>
                <strong>Descriptions</strong>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>
                {{$post->id}}
            </td>
            <td>
                {{$post->title}}
            </td>
            <td>
                {{$post->description}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection