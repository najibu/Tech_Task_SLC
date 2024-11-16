@extends('layouts.app')

@section('title', 'Edit a Book')

@section('content')
    <edit-book :book-data="{{ $book }}"></edit-book>
@endsection
