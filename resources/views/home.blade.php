@extends('layouts.app')

@section('content')
<div id="dashboard" class="container">

    <div style="margin-bottom: 5px">
        <a href="/paste/create" class="pb-button">
            <i class="fa fa-plus"></i>
        </a>
        <input 
            id="pb-search-input"
            placeholder="Search"
            style="
                padding: 4px 10px; 
                width: calc(100% - 40px); 
                margin: 0px; 
                margin-left: 2px;
                border: 1px solid #dfdfdf; 
                border-radius: 5px
            "
            onkeyup="pb_search()" />
    </div>

    @foreach ($pastes as $paste)
    <div class="pb-paste" style="margin-bottom: 5px">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="padding: 10px 20px">
                    <div>
                        <a 
                            class="pb-paste-title"
                            href="javascript:void(0)"
                            style="display: inline-block; width: calc(100% - 82px)"
                            data-toggle="collapse" 
                            data-target="#collapse{{ $paste->id }}">
                            {{ $paste->title }}
                        </a>
                        <div style="display: inline-block">
                            <a href="javascript:void(0)" onclick="pb_copy('pb-textarea-{{ $paste->id }}')">
                                <i class="fa fa-clone"></i>
                            </a>
                        </div>
                        <div style="display: inline-block">
                            <a href="javascript:void(0)" onclick="pb_copy('pb-input-link-{{ $paste->id }}')">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                        <div style="display: inline-block">
                            <a href="/paste/edit/{{ $paste->id }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    </div>
                    <div 
                        id="collapse{{ $paste->id }}" 
                        class="collapse" 
                        style="margin-top: 10px">
                        <div>
                            <textarea 
                                id="pb-textarea-{{ $paste->id }}"
                                readonly 
                                class="pb-textarea" 
                                style="height: 200px; outline: none">{{ $paste->content }}</textarea>
                            <small>
                                Date Modified: {{ $paste->updated_at->format('Y-m-d g:i A') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input 
        id="pb-input-link-{{ $paste->id }}" 
        style="display: none" 
        value="{{ url('paste/show', [ $paste->id ]) }}"/>
    @endforeach
</div>
@endsection