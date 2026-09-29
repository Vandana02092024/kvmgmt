
<div class="row form-group">
	<label class="col-sm-6">Email</label>
	<div class="col-sm-6">
		{{ $seller->email }}
		{!! Form::hidden('vendor_name', $seller->name, ['class' => 'form-control']) !!}
		{!! Form::hidden('vendor_email', $seller->email, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row form-group">
	<label class="col-sm-6">Phone</label>
	<div class="col-sm-6">
		{{ $seller->phone }}
		{!! Form::hidden('vendor_phone', $seller->phone, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row form-group">
	<label class="col-sm-6">Address</label>
	<div class="col-sm-6">
		{{ $seller->address }}
		{!! Form::hidden('vendor_address', $seller->address, ['class' => 'form-control']) !!}
	</div>
</div>