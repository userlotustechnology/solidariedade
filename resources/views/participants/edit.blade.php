@extends('layouts.sidebar-simple')

@section('page-title', 'Editar Participante')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Editar Participante') }}</h4>
                    <div>
                        <a href="{{ route('participants.show', $participant) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Visualizar
                        </a>
                        <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('participants.update', $participant) }}">
                        @csrf
                        @method('PUT')

                        <!-- Informações Pessoais -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-primary">Informações Pessoais</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('Nome Completo') }} <span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', $participant->name) }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="document_type" class="form-label">{{ __('Tipo de Documento') }} <span class="text-danger">*</span></label>
                                <select id="document_type" class="form-select @error('document_type') is-invalid @enderror" name="document_type" required>
                                    <option value="">Selecione</option>
                                    <option value="CPF" {{ old('document_type', $participant->document_type) === 'CPF' ? 'selected' : '' }}>CPF</option>
                                    <option value="RG" {{ old('document_type', $participant->document_type) === 'RG' ? 'selected' : '' }}>RG</option>
                                    <option value="CNH" {{ old('document_type', $participant->document_type) === 'CNH' ? 'selected' : '' }}>CNH</option>
                                    <option value="Passaporte" {{ old('document_type', $participant->document_type) === 'Passaporte' ? 'selected' : '' }}>Passaporte</option>
                                </select>
                                @error('document_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="document_number" class="form-label">{{ __('Número do Documento') }} <span class="text-danger">*</span></label>
                                <input id="document_number" type="text" class="form-control @error('document_number') is-invalid @enderror"
                                       name="document_number" value="{{ old('document_number', $participant->document_number) }}" required>
                                @error('document_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="birth_date" class="form-label">{{ __('Data de Nascimento') }} <span class="text-danger">*</span></label>
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                       name="birth_date" value="{{ old('birth_date', $participant->birth_date->format('Y-m-d')) }}" required>
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="gender" class="form-label">{{ __('Gênero') }}</label>
                                <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">Não informar</option>
                                    <option value="M" {{ old('gender', $participant->gender) === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gender', $participant->gender) === 'F' ? 'selected' : '' }}>Feminino</option>
                                    <option value="Other" {{ old('gender', $participant->gender) === 'Other' ? 'selected' : '' }}>Outro</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="phone" class="form-label">{{ __('Telefone') }}</label>
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone', $participant->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">{{ __('E-mail') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email', $participant->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-primary">Endereço</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="address" class="form-label">{{ __('Endereço Completo') }} <span class="text-danger">*</span></label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                       name="address" value="{{ old('address', $participant->address) }}" required
                                       placeholder="Rua, Avenida, número, complemento">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="neighborhood" class="form-label">{{ __('Bairro') }} <span class="text-danger">*</span></label>
                                <input id="neighborhood" type="text" class="form-control @error('neighborhood') is-invalid @enderror"
                                       name="neighborhood" value="{{ old('neighborhood', $participant->neighborhood) }}" required>
                                @error('neighborhood')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="city" class="form-label">{{ __('Cidade') }} <span class="text-danger">*</span></label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                       name="city" value="{{ old('city', $participant->city) }}" required>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="state" class="form-label">{{ __('Estado') }} <span class="text-danger">*</span></label>
                                <input id="state" type="text" class="form-control @error('state') is-invalid @enderror"
                                       name="state" value="{{ old('state', $participant->state) }}" required maxlength="2"
                                       placeholder="Ex: SP">
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="zip_code" class="form-label">{{ __('CEP') }} <span class="text-danger">*</span></label>
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                       name="zip_code" value="{{ old('zip_code', $participant->zip_code) }}" required>
                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Informações Familiares -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-primary">Informações Familiares</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="family_members" class="form-label">{{ __('Pessoas na Família') }} <span class="text-danger">*</span></label>
                                <input id="family_members" type="number" class="form-control @error('family_members') is-invalid @enderror"
                                       name="family_members" value="{{ old('family_members', $participant->family_members) }}" required min="1" max="20">
                                @error('family_members')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="monthly_income" class="form-label">{{ __('Renda Mensal Familiar') }}</label>
                                <input id="monthly_income" type="number" class="form-control @error('monthly_income') is-invalid @enderror"
                                       name="monthly_income" value="{{ old('monthly_income', $participant->monthly_income) }}" step="0.01" min="0"
                                       placeholder="0,00">
                                @error('monthly_income')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="active" class="form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                                <select id="active" class="form-select @error('active') is-invalid @enderror" name="active" required>
                                    <option value="1" {{ old('active', $participant->active) == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ old('active', $participant->active) == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="observations" class="form-label">{{ __('Observações') }}</label>
                                <textarea id="observations" class="form-control @error('observations') is-invalid @enderror"
                                          name="observations" rows="3" placeholder="Informações adicionais sobre o participante...">{{ old('observations', $participant->observations) }}</textarea>
                                @error('observations')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Informações de Cadastro -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-secondary">Informações de Cadastro</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="registered_by" class="form-label">{{ __('Cadastrado por') }}</label>
                                <input id="registered_by" type="text" class="form-control" value="{{ $participant->registeredBy->name }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="registered_at" class="form-label">{{ __('Data do Cadastro') }}</label>
                                <input id="registered_at" type="text" class="form-control" value="{{ $participant->registered_at->format('d/m/Y H:i') }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="updated_at" class="form-label">{{ __('Última Atualização') }}</label>
                                <input id="updated_at" type="text" class="form-control" value="{{ $participant->updated_at->format('d/m/Y H:i') }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ __('Atualizar Participante') }}
                                </button>
                                <a href="{{ route('participants.show', $participant) }}" class="btn btn-info">
                                    {{ __('Visualizar') }}
                                </a>
                                <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
