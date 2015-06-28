@extends('core::app')
@section('content')

<div class="container">
	<div class="col-sm-9">

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Widget Type id</th>
					<th>Widget Type Name</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				@foreach($widgetTypes as $widgetType)
					<tr>
						<th>{{ $widgetType->id }}</th>
						<th>{{ $widgetType->widget_type_name }}</th>
						<th>
							@if(\CMS::permissions()->can('show', 'Widgets'))
								<a 
								class ="btn btn-default" 
								href  ='{{ url("admin/widget/show", $widgetType->id) }}' 
								role  ="button">
								Widgets
								</a> 
							@endif
						</th>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop