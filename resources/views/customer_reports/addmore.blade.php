@if($id == 1)
<tr>
	<td>{!! Form::select('type[]', $type, null,['class' => 'form-control refreshOption-1']) !!}</td>
	<td>{!! Form::select('size[]', $size, null,['class' => 'form-control refreshOption-2']) !!}</td>
	<td>{!! Form::select('brand_name[]', $brand, null,['class' => 'form-control refreshOption-3']) !!}</td>
	<td>{!! Form::select('color[]', $color, null,['class' => 'form-control refreshOption-4']) !!}</td>
	<td>{!! Form::select('material[]', $material, null,['class' => 'form-control refreshOption-5']) !!}</td>
	<td>
		<ul class="inline">
			<li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li>
		</ul>
	</td>
</tr>
@endif