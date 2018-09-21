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
                    Edit Paste
                </div>
                <div style="margin-top: 10px">
                    <div style="display: inline-block; width: calc(100% - 82px)">
                        <input 
                            name="paste_title" 
                            class="pb-input" 
                            style="{{ $errors->first('paste_title') ? 'border-color: #f08080' : '' }}"
                            value="{{ $errors->first('paste_title') ? '' : ( old('paste_title') ? old('paste_title') : $paste->title ) }}"
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
                    <div style="display: inline-block">
                        <a href="javascript:void(0)" onclick="document.getElementById('pb-form').submit()">
                            <i class="fa fa-floppy-o"></i>
                        </a>
                    </div>
                </div>
                <div style="margin-top: 10px">
                    <div>
                        <textarea 
                        	id="pb-textarea"
                            name="paste_content"
                            placeholder="Content"
                            class="pb-textarea"
                            style="height: 200px; {{ $errors->first('paste_content') ? 'border-color: #f08080' : '' }}"
                            placeholder="Content">{{ $errors->first('paste_content') ? '' : ( old('paste_content') ? old('paste_content') : $paste->content ) }}</textarea>
                        <small>
                            Date Modified: {{ $paste->updated_at->format('Y-m-d g:i A') }}
                        </small>
                        <a 
                        	href="javascript:void(0)" 
                        	onclick="pb_delete_paste('{{ $paste->id }}')" 
                        	style="float: right">
                            <i class="fa fa-trash"></i>
                        </a>
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