<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre', 'maxlength' => 255,'required']) !!}

    @error('name')
        <small>
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::checkbox('status', 1) !!}
    {!! Form::label('status', 'Estatus') !!}
</div>