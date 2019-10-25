@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-8">
    		<div class="card">
	    		<div class="card-header">
	    			Profile
	    		</div>
	    		<div class="card-body">
	    			@if(!empty($user))
	    				{!! Form::model($user, ['route' => ['update_profile',$user->id],'files'=>true]) !!}
	    			@else
	    				{!! Form::open(['route' => 'update_profile','files'=>true]) !!}
	    			@endif
	    			{{ csrf_field() }}
	    			<div class="form-group">
	    				<label>Name</label>
	    				{{ Form::text('name',null,['class'=>'form-control']) }}
	    			</div>
	    			<div class="form-group">
	    				<label>Username</label>
	    				{{ Form::text('username',null,['class'=>'form-control']) }}
	    			</div>
	    			<div class="form-group">
	    				<label>Email</label>
	    				{{ Form::text('email',null,['class'=>'form-control','readonly'=>true]) }}
	    			</div>
	    			<div class="form-group">
	    				<label>Avatar</label>
	    				{{ Form::file('avatar_file',['class'=>'form-control']) }}
	    				@if(!empty($user) && !empty($user->avatar))
	    				<img src="{{ Storage::url($user->avatar) }}" height="100">
	    				@endif
	    			</div>
	    			<div class="form-group">
	    				{{ Form::submit('Save',['class'=>'btn btn-primary']) }}
	    			</div>
	    			{!! Form::close() !!}
	    		</div>
	    	</div>
    	</div>
    </div>
</div>
@endsection
