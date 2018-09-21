@extends('layouts.app')

@section('content')
<div class="container">

    <div style="margin-top: 5px; margin-bottom: 10px">
	    <a href="/home" class="pb-button">
	        <i class="fa fa-chevron-left"></i>
	    </a>
	</div>

    <div class="row justify-content-center" style="margin-bottom: -15px">
        <form 
            id="pb-form" 
            action="/paste/update" 
            method="POST" 
        	class="col-md-12">
            @csrf
      		<!-- paste id -->
            <input name="id" value="{{ $paste->id }}" style="display: none"/>
            <div class="card" style="padding: 10px 20px">
                <div>
                    Show Paste
                </div>
                <div style="margin-top: 10px">
                    <div style="display: inline-block; width: calc(100% - 56px)">
                        <input 
                            readonly
                            name="paste_title" 
                            class="pb-input" 
                            value="{{ $paste->title }}"
                            placeholder="Title" />
                    </div>
                    <div style="display: inline-block">
                        <a href="javascript:void(0)" onclick="pb_copy('pb-textarea')">
                            <i class="fa fa-clone"></i>
                        </a>
                    </div>
                    <div style="display: inline-block">
                        <a href="javascript:void(0)" onclick="pb_copy('pb-input-link-{{ $paste->id }}')">
                            <i class="fa fa-link"></i>
                        </a>
                    </div>
                </div>
                <div style="margin-top: 10px">
                    <div>
                        <textarea 
                        	id="pb-textarea"
                            readonly
                            name="paste_content"
                            placeholder="Content"
                            class="pb-textarea"
                            style="height: 200px; outline: none"
                            placeholder="Content">{{ $paste->content }}</textarea>
                        <small>
                            Date Modified: {{ $paste->updated_at->format('Y-m-d g:i A') }}
                        </small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <input 
        id="pb-input-link-{{ $paste->id }}" 
        style="display: none" 
        value="{{ url('paste/show', [ $paste->id ]) }}"/>
</div>
@endsection