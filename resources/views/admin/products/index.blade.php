@extends('admin.layouts.main')

@section('title')
    Product-List
@endsection
@push('styles')
    <style>
        a{
            color: white;
        }
    </style>
@endpush



@section('content')
<h2>Trang danh sách sản phẩm</h2>

{{-- <x-notification background="gray">
    <x-text type="title">
        Cảnh báo
    </x-text>
    <div class="body">
        <x-text type="content" background="red">
            Vui lòng ...
        </x-text>
    </div>
    <div class="button">
        <x-button background="gray">Cancel</x-button>
        <x-button background="blue" color="white">Ok</x-button>
    </div>
</x-notification> --}}

@endsection

@push('scripts')
    
@endpush