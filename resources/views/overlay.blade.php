@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid z-indexer gift-overlay-pos text-center">
    <div class="row">
        <div class="col-12 text-left">
            <p class="font-komikaaxis font-size-20px">GIFT</p>
        </div>
    </div>
    <div class="row mt-4 row-border-bottom">
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
        <div class="col-3">
            <img class="sticker" src="{{url('img/sticker/teststicker.png')}}">
            <p class="mb-0 font-latobold font-size-13px">love</p>
            <p class="font-latoregular font-size-11px font-color-gray">free</p>
        </div>
    </div>
    <div class="row row-coin mt-4">
        <div class="col-2 my-auto">
            # 695
        </div>
        <div class="col-6 text-right pr-0">
            <button class="btn btn-light font-size-25px"> - </button>
            <button class="btn btn-light font-latobold"> 1 </button>
            <button class="btn btn-light font-size-25px"> + </button>
        </div>
        <div class="col-4">
            <a class="btn text-white button-yellow-small font-komikaaxis py-1">send</a>
        </div>
    </div>
</div>
@endsection
