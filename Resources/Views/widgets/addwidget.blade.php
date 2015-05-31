@extends('app')
@section('content')

<div class="container">
  <div class="col-sm-8">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (Session::has('message'))
      <div class="alert alert-success">
        <ul>
          <li>{{ Session::get('message') }}</li>
        </ul>
      </div>
    @endif
    
    <div class="col-sm-12">
      <div class="col-sm-6">
       <div class="form-group">
        <label for="widget_image">Widget Image</label>
        <img class="img-responsive" src="http://placehold.it/200x200" width="200" height="200" id="widget_image">
        <br>
        {!! $widgetImageMediaLibrary !!}
       </div>
      </div>
    </div>

    <form method="post" id="widget_form">  
      <input name="_token" type="hidden" value="{{ csrf_token() }}">
      <input type="hidden" name="image">

      <div class="form-group">
        <label for="slug">Widget Slug</label>
        <input 
        type             ="text" 
        class            ="form-control" 
        name             ="slug" 
        value            ="{{ old('slug') }}" 
        placeholder      ="Add slug here .." 
        aria-describedby ="sizing-addon2"
        >
      </div>

      <div class="form-group">
        <label for="title">Widget Title</label>
        <input 
        type             ="text" 
        class            ="form-control" 
        name             ="title" 
        value            ="{{ old('title') }}" 
        placeholder      ="Add title here .." 
        aria-describedby ="sizing-addon2"
        >
      </div>

      <div class="form-group">
        <label for="description">Widget Description</label>
        <input 
        type             ="text" 
        class            ="form-control" 
        name             ="description" 
        value            ="{{ old('description') }}" 
        placeholder      ="Widget Description .." 
        aria-describedby ="sizing-addon2"
        >
      </div>

      <div class="form-group">
              <label for="link">Link: <i>If you want to "#" it leave it blank </i></label>
              <div class="input-group">
                <span class="input-group-addon">@</span>
                <input 
                type             ="text" 
                class            ="form-control" 
                name             ="link" 
                value            ="{{ old('link') }}" 
                placeholder      ="Add Link here .." 
                aria-describedby ="sizing-addon2"
                id               ="link" 
                >
              </div>
            </div>

      <button type="submit" class="btn btn-primary form-control">Add Widget</button>
    </form>
  </div>  
</div>

@include('widget::widgets.assets.addwidgetimage')
@stop