@extends('layouts.app')

@section('title', 'Cadastrar Participante')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="ti-user me-2"></i>{{ __('Cadastrar Participante') }}
                    </h4>
                    <a href="{{ route('participants.index') }}" class="btn btn-light btn-sm">
                        <i class="ti-list me-1"></i>{{ __('Ver Participantes') }}
                    </a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6>{{ __('Por favor, corrija os seguintes erros:') }}</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('participants.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Dados Pessoais -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-primary">Dados Pessoais</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('Nome Completo') }} <span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                    <option value="CPF" {{ old('document_type') === 'CPF' ? 'selected' : '' }}>CPF</option>
                                    <option value="RG" {{ old('document_type') === 'RG' ? 'selected' : '' }}>RG</option>
                                    <option value="CNH" {{ old('document_type') === 'CNH' ? 'selected' : '' }}>CNH</option>
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
                                       name="document_number" value="{{ old('document_number') }}" required>
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
                                       name="birth_date" value="{{ old('birth_date') }}" required>
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
                                    <option value="M" {{ old('gender') === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gender') === 'F' ? 'selected' : '' }}>Feminino</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Outro</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="marital_status" class="form-label">{{ __('Estado Civil') }}</label>
                                <select id="marital_status" class="form-select @error('marital_status') is-invalid @enderror" name="marital_status">
                                    <option value="">Selecione</option>
                                    <option value="solteiro" {{ old('marital_status') === 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                                    <option value="casado" {{ old('marital_status') === 'casado' ? 'selected' : '' }}>Casado(a)</option>
                                    <option value="divorciado" {{ old('marital_status') === 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                                    <option value="viuvo" {{ old('marital_status') === 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                                    <option value="uniao_estavel" {{ old('marital_status') === 'uniao_estavel' ? 'selected' : '' }}>União Estável</option>
                                </select>
                                @error('marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="phone" class="form-label">{{ __('Celular') }}</label>
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}" placeholder="(11) 99999-9999">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="email" class="form-label">{{ __('E-mail') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="photo" class="form-label">{{ __('Foto do Participante') }}</label>
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                                       name="photo" accept="image/*">
                                <small class="form-text text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                                @error('photo')
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
                            <div class="col-md-6">
                                <label for="address" class="form-label">{{ __('Endereço') }} <span class="text-danger">*</span></label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                       name="address" value="{{ old('address') }}" required
                                       placeholder="Rua, Avenida, número">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="address_complement" class="form-label">{{ __('Complemento') }}</label>
                                <input id="address_complement" type="text" class="form-control @error('address_complement') is-invalid @enderror"
                                       name="address_complement" value="{{ old('address_complement') }}"
                                       placeholder="Apto, casa, bloco">
                                @error('address_complement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="neighborhood" class="form-label">{{ __('Bairro') }} <span class="text-danger">*</span></label>
                                <input id="neighborhood" type="text" class="form-control @error('neighborhood') is-invalid @enderror"
                                       name="neighborhood" value="{{ old('neighborhood') }}" required>
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
                                       name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="state" class="form-label">{{ __('Estado') }} <span class="text-danger">*</span></label>
                                <select id="state" class="form-select @error('state') is-invalid @enderror" name="state" required>
                                    <option value="">Selecione</option>
                                    <option value="AC" {{ old('state') === 'AC' ? 'selected' : '' }}>Acre</option>
                                    <option value="AL" {{ old('state') === 'AL' ? 'selected' : '' }}>Alagoas</option>
                                    <option value="AP" {{ old('state') === 'AP' ? 'selected' : '' }}>Amapá</option>
                                    <option value="AM" {{ old('state') === 'AM' ? 'selected' : '' }}>Amazonas</option>
                                    <option value="BA" {{ old('state') === 'BA' ? 'selected' : '' }}>Bahia</option>
                                    <option value="CE" {{ old('state') === 'CE' ? 'selected' : '' }}>Ceará</option>
                                    <option value="DF" {{ old('state') === 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                    <option value="ES" {{ old('state') === 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                    <option value="GO" {{ old('state') === 'GO' ? 'selected' : '' }}>Goiás</option>
                                    <option value="MA" {{ old('state') === 'MA' ? 'selected' : '' }}>Maranhão</option>
                                    <option value="MT" {{ old('state') === 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                    <option value="MS" {{ old('state') === 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                    <option value="MG" {{ old('state') === 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                    <option value="PA" {{ old('state') === 'PA' ? 'selected' : '' }}>Pará</option>
                                    <option value="PB" {{ old('state') === 'PB' ? 'selected' : '' }}>Paraíba</option>
                                    <option value="PR" {{ old('state') === 'PR' ? 'selected' : '' }}>Paraná</option>
                                    <option value="PE" {{ old('state') === 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                    <option value="PI" {{ old('state') === 'PI' ? 'selected' : '' }}>Piauí</option>
                                    <option value="RJ" {{ old('state') === 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                    <option value="RN" {{ old('state') === 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                    <option value="RS" {{ old('state') === 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                    <option value="RO" {{ old('state') === 'RO' ? 'selected' : '' }}>Rondônia</option>
                                    <option value="RR" {{ old('state') === 'RR' ? 'selected' : '' }}>Roraima</option>
                                    <option value="SC" {{ old('state') === 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                    <option value="SP" {{ old('state') === 'SP' ? 'selected' : '' }}>São Paulo</option>
                                    <option value="SE" {{ old('state') === 'SE' ? 'selected' : '' }}>Sergipe</option>
                                    <option value="TO" {{ old('state') === 'TO' ? 'selected' : '' }}>Tocantins</option>
                                </select>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="zip_code" class="form-label">{{ __('CEP') }} <span class="text-danger">*</span></label>
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                       name="zip_code" value="{{ old('zip_code') }}" required>
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
                                       name="family_members" value="{{ old('family_members', 1) }}" required min="1" max="20">
                                @error('family_members')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="monthly_income" class="form-label">{{ __('Renda Mensal Familiar') }}</label>
                                <input id="monthly_income" type="number" class="form-control @error('monthly_income') is-invalid @enderror"
                                       name="monthly_income" value="{{ old('monthly_income') }}" step="0.01" min="0"
                                       placeholder="0,00">
                                @error('monthly_income')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Benefícios e Documentação -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-primary">Benefícios e Documentação</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="receives_government_benefit" class="form-label">{{ __('Recebe benefício do governo?') }}</label>
                                <select id="receives_government_benefit" class="form-select @error('receives_government_benefit') is-invalid @enderror" name="receives_government_benefit">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ old('receives_government_benefit') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('receives_government_benefit') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                                @error('receives_government_benefit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="government_benefit_type" class="form-label">{{ __('Qual benefício recebe?') }}</label>
                                <select id="government_benefit_type" class="form-select @error('government_benefit_type') is-invalid @enderror" name="government_benefit_type">
                                    <option value="">Selecione</option>
                                    <option value="Auxílio Brasil" {{ old('government_benefit_type') === 'Auxílio Brasil' ? 'selected' : '' }}>Auxílio Brasil</option>
                                    <option value="BPC" {{ old('government_benefit_type') === 'BPC' ? 'selected' : '' }}>BPC (Benefício de Prestação Continuada)</option>
                                    <option value="Aposentadoria" {{ old('government_benefit_type') === 'Aposentadoria' ? 'selected' : '' }}>Aposentadoria</option>
                                    <option value="Pensão por Morte" {{ old('government_benefit_type') === 'Pensão por Morte' ? 'selected' : '' }}>Pensão por Morte</option>
                                    <option value="Auxílio Doença" {{ old('government_benefit_type') === 'Auxílio Doença' ? 'selected' : '' }}>Auxílio Doença</option>
                                    <option value="Seguro Desemprego" {{ old('government_benefit_type') === 'Seguro Desemprego' ? 'selected' : '' }}>Seguro Desemprego</option>
                                    <option value="Vale Gás" {{ old('government_benefit_type') === 'Vale Gás' ? 'selected' : '' }}>Vale Gás</option>
                                    <option value="Tarifa Social de Energia" {{ old('government_benefit_type') === 'Tarifa Social de Energia' ? 'selected' : '' }}>Tarifa Social de Energia</option>
                                    <option value="Outro" {{ old('government_benefit_type') === 'Outro' ? 'selected' : '' }}>Outro</option>
                                </select>
                                @error('government_benefit_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="has_documents" class="form-label">{{ __('Possui documentos básicos?') }}</label>
                                <select id="has_documents" class="form-select @error('has_documents') is-invalid @enderror" name="has_documents">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ old('has_documents') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('has_documents') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                                <small class="text-muted">RG, CPF, Comprovante de residência</small>
                                @error('has_documents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Situação Trabalhista -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h5 class="text-primary">Situação Trabalhista</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="employment_status" class="form-label">{{ __('Situação de Trabalho') }}</label>
                                <select id="employment_status" class="form-select @error('employment_status') is-invalid @enderror" name="employment_status">
                                    <option value="">Selecione</option>
                                    <option value="empregado" {{ old('employment_status') === 'empregado' ? 'selected' : '' }}>Empregado</option>
                                    <option value="desempregado" {{ old('employment_status') === 'desempregado' ? 'selected' : '' }}>Desempregado</option>
                                    <option value="aposentado" {{ old('employment_status') === 'aposentado' ? 'selected' : '' }}>Aposentado</option>
                                    <option value="pensionista" {{ old('employment_status') === 'pensionista' ? 'selected' : '' }}>Pensionista</option>
                                    <option value="autonomo" {{ old('employment_status') === 'autonomo' ? 'selected' : '' }}>Autônomo</option>
                                </select>
                                @error('employment_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="workplace" class="form-label">{{ __('Local de Trabalho') }}</label>
                                <input id="workplace" type="text" class="form-control @error('workplace') is-invalid @enderror"
                                       name="workplace" value="{{ old('workplace') }}"
                                       placeholder="Nome da empresa ou local onde trabalha">
                                @error('workplace')
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
                                          name="observations" rows="3" placeholder="Informações adicionais sobre o participante...">{{ old('observations') }}</textarea>
                                @error('observations')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti-save me-1"></i> {{ __('Cadastrar Participante') }}
                                </button>
                                <a href="{{ route('participants.index') }}" class="btn btn-secondary ms-2">
                                    <i class="ti-arrow-left me-1"></i> {{ __('Cancelar') }}
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
