@extends('store.store')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Novo usuário</div>
				<div class="panel-body">
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nome completo</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>


                        <div class="form-group">
                            {!! Form::label('street_one', 'Endereço', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('street_one', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('city', 'Cidade', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                               {!! Form::text('city', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('state', 'Estado', ['class' => 'col-md-4 control-label']) !!}
                             <div class="col-md-6">
                               {!! Form::text('state', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        {!! Form::hidden('country', 'brazil') !!}

                        <div class="form-group">
                            {!! Form::label('postal_code', 'CEP', ['class' => 'col-md-4 control-label']) !!}
                              <div class="col-md-6">
                              {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                              </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('phone', 'Telefone', ['class' => 'col-md-4 control-label']) !!}
                              <div class="col-md-6">
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>
                        </div>

						<div class="form-group">
							<label class="col-md-4 control-label">Senha</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirme a senha</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Cadastrar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
