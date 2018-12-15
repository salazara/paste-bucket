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
            action="/paste/store" 
            method="POST" 
            class="col-md-12">
            @csrf
            <div class="card" style="padding: 10px 20px; border: 1px solid #efefef">
                <div>
                    Create Paste
                </div>
                <div style="margin-top: 10px">
                    <div style="display: inline-block; width: calc(100% - 120px)">
                        <input 
                            name="paste_title" 
                            class="pb-input" 
                            style="{{ $errors->first('paste_title') ? 'border-color: #f08080' : '' }}"
                            placeholder="Title"
                            value="{{ old('paste_title') }}"/>
                    </div>
                    <div style="display: inline-block">
                        <a href="javascript:void(0)" onclick="pb_copy('pb-textarea', document.getElementById('pb-paste-copy-multiplier').innerHTML)">
                            <i class="fa fa-clone"></i>
                        </a>
                    </div>
                    <div style="display: inline-block">
                        x
                        <select onchange="pb_select_copy_multiplier(this, 'pb-paste-copy-multiplier')">
                            @for ($i = 1; $i <= 15; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <span id="pb-paste-copy-multiplier" style="display: none">1</span>
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
                            placeholder="Content">{{ old('paste_content') }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection