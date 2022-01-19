<div class="form-group">
    {!! Form::label('matricula', 'Matrícula') !!}
    {!! Form::text('matricula', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la matrícula', 'maxlength' => 255, 'required']) !!}
    @error('matricula')
        <small>
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('fullname', 'Nombre') !!}
    {!! Form::text('fullname', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre', 'maxlength' => 255, 'required']) !!}
    @error('fullname')
        <small>
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>