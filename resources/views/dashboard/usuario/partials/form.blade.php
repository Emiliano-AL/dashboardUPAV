<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre', 'maxlength' => 255, 'required']) !!}
    @error('name')
        <small>
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el email', 'maxlength' => 255, 'required']) !!}
    @error('email')
        <small>
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('password', 'Contraseña') !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese una contraseña', 'maxlength' => 255]) !!}
    @error('password')
        <small>
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirmar Contraseña') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<div class="form-group">
    {!! Form::label('rol_id', 'Rol') !!}
    {!! Form::select('rol_id', $roles, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un rol', 'required']) !!}
    @error('rol_id')
        <small>
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::checkbox('status', 1) !!}
    {!! Form::label('status', 'Estatus') !!}
</div>