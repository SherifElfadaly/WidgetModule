@extends('core::app')
@section('content')

<div class="container">
	<div class="col-sm-9">	
		
		<h3>{{ $widgetType->widget_type_name }}'s Widgets</h3>
		<div class="col-sm-4">
			@if(\CMS::permissions()->can('add', 'Widgets'))
				<a 
				class ="btn btn-default" href='{{ url("admin/widget/create", $widgetType->id) }}' 
				role  ="button">
				Add Widget
				</a>
			@endif
		</div>
	</div>
	<div class="col-sm-9">

		<br>
		<table class="table table-striped">
			<tr>
				<th>Widget ID</th>
				<th>Widget slug</th>
				<th>Options</th>
			</tr>
			@foreach($widgets as $widget)
				<tr>
					<th>{{ $widget->id }}</th>
					<th>{{ $widget->slug }}</th>
					<th>
						@if(\CMS::permissions()->can('edit', 'Widgets'))
							<a 
							class ="btn btn-default" 
							href  ='{{ url("admin/widget/edit/$widget->id") }}' 
							role  ="button">
							Edit
							</a> 
						@endif
						@if(\CMS::permissions()->can('delete', 'Widgets'))
							<a 
							class ="btn btn-default" 
							href  ='{{ url("admin/widget/delete/$widget->id") }}' 
							role  ="button">
							Delete
							</a> 
						@endif
						@if(\CMS::permissions()->can('show', 'LanguageContents'))
							<a 
							class ="btn btn-default" 
							href  ='{{ url("admin/language/languagecontents/show/widget/$widget->id") }}'
							role  ="button">
							Translations
							</a> 
						@endif
					</th>
				</tr>
			@endforeach
		</table>
		{!! $widgets->render() !!}
	</div>
</div>
@stop