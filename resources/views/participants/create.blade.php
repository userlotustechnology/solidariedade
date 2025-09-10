@extends('layouts.app')

@section('title', 'Cadastrar Participante')

@section('content')
<div class="container-fluid">

    @if ($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="ti-alert-circle me-2"></i>
                        <strong>Erro!</strong>
                    </div>
                    <p class="mb-2 mt-2">Por favor, corrija os seguintes erros:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('participants.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Formulário Principal -->
            <div class="col-lg-8">
                <!-- Dados Pessoais -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-user me-2"></i>Dados Pessoais
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="ti-user me-1"></i>Nome Completo
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="Digite o nome completo">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="document_type" class="form-label fw-semibold">
                                    <i class="ti-id-badge me-1"></i>Tipo de Documento
                                    <span class="text-danger">*</span>
                                </label>
                                <select id="document_type" class="form-select @error('document_type') is-invalid @enderror" name="document_type" required>
                                    <option value="">Selecione</option>
                                    <option value="CPF" {{ old('document_type') === 'CPF' ? 'selected' : '' }}>CPF</option>
                                    <option value="RG" {{ old('document_type') === 'RG' ? 'selected' : '' }}>RG</option>
                                    <option value="CNH" {{ old('document_type') === 'CNH' ? 'selected' : '' }}>CNH</option>
                                </select>
                                @error('document_type')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="document_number" class="form-label fw-semibold">
                                    <i class="ti-bookmark me-1"></i>Número do Documento
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="document_number" type="text" class="form-control @error('document_number') is-invalid @enderror"
                                       name="document_number" value="{{ old('document_number') }}" required
                                       placeholder="Número do documento">
                                @error('document_number')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="birth_date" class="form-label fw-semibold">
                                    <i class="ti-calendar me-1"></i>Data de Nascimento
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                       name="birth_date" value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="gender" class="form-label fw-semibold">
                                    <i class="ti-user me-1"></i>Gênero
                                </label>
                                <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">Não informar</option>
                                    <option value="M" {{ old('gender') === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gender') === 'F' ? 'selected' : '' }}>Feminino</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Outro</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="marital_status" class="form-label fw-semibold">
                                    <i class="ti-heart me-1"></i>Estado Civil
                                </label>
                                <select id="marital_status" class="form-select @error('marital_status') is-invalid @enderror" name="marital_status">
                                    <option value="">Selecione</option>
                                    <option value="solteiro" {{ old('marital_status') === 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                                    <option value="casado" {{ old('marital_status') === 'casado' ? 'selected' : '' }}>Casado(a)</option>
                                    <option value="divorciado" {{ old('marital_status') === 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                                    <option value="viuvo" {{ old('marital_status') === 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                                    <option value="uniao_estavel" {{ old('marital_status') === 'uniao_estavel' ? 'selected' : '' }}>União Estável</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="phone" class="form-label fw-semibold">
                                    <i class="ti-mobile me-1"></i>Celular
                                </label>
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}" placeholder="(11) 99999-9999">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="ti-email me-1"></i>E-mail
                                </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" placeholder="email@exemplo.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="photo" class="form-label fw-semibold">
                                    <i class="ti-camera me-1"></i>Foto do Participante
                                </label>
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                                       name="photo" accept="image/*">
                                <small class="form-text text-muted">
                                    <i class="ti-info-alt me-1"></i>Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB
                                </small>
                                @error('photo')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Endereço -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-location-pin me-2"></i>Endereço
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="address" class="form-label fw-semibold">
                                    <i class="ti-map me-1"></i>Endereço
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                       name="address" value="{{ old('address') }}" required
                                       placeholder="Rua, Avenida, número">
                                @error('address')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="address_complement" class="form-label fw-semibold">
                                    <i class="ti-home me-1"></i>Complemento
                                </label>
                                <input id="address_complement" type="text" class="form-control @error('address_complement') is-invalid @enderror"
                                       name="address_complement" value="{{ old('address_complement') }}"
                                       placeholder="Apto, casa, bloco">
                                @error('address_complement')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="neighborhood" class="form-label fw-semibold">
                                    <i class="ti-map-alt me-1"></i>Bairro
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="neighborhood" type="text" class="form-control @error('neighborhood') is-invalid @enderror"
                                       name="neighborhood" value="{{ old('neighborhood') }}" required
                                       placeholder="Nome do bairro">
                                @error('neighborhood')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <label for="city" class="form-label fw-semibold">
                                    <i class="ti-direction me-1"></i>Cidade
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                       name="city" value="{{ old('city') }}" required
                                       placeholder="Nome da cidade">
                                @error('city')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label fw-semibold">
                                    <i class="ti-flag me-1"></i>Estado
                                    <span class="text-danger">*</span>
                                </label>
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
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="zip_code" class="form-label fw-semibold">
                                    <i class="ti-pin me-1"></i>CEP
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                       name="zip_code" value="{{ old('zip_code') }}" required
                                       placeholder="00000-000">
                                @error('zip_code')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações Familiares e Trabalhistas -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-users me-2"></i>Informações Familiares e Trabalhistas
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="family_members" class="form-label fw-semibold">
                                    <i class="ti-users me-1"></i>Pessoas na Família
                                    <span class="text-danger">*</span>
                                </label>
                                <input id="family_members" type="number" class="form-control @error('family_members') is-invalid @enderror"
                                       name="family_members" value="{{ old('family_members', 1) }}" required min="1" max="20"
                                       placeholder="Número de pessoas">
                                @error('family_members')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="monthly_income" class="form-label fw-semibold">
                                    <i class="ti-wallet me-1"></i>Renda Mensal Familiar
                                </label>
                                <input id="monthly_income" type="number" class="form-control @error('monthly_income') is-invalid @enderror"
                                       name="monthly_income" value="{{ old('monthly_income') }}" step="0.01" min="0"
                                       placeholder="0,00">
                                @error('monthly_income')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="employment_status" class="form-label fw-semibold">
                                    <i class="ti-briefcase me-1"></i>Situação de Trabalho
                                </label>
                                <select id="employment_status" class="form-select @error('employment_status') is-invalid @enderror" name="employment_status">
                                    <option value="">Selecione</option>
                                    <option value="empregado" {{ old('employment_status') === 'empregado' ? 'selected' : '' }}>Empregado</option>
                                    <option value="desempregado" {{ old('employment_status') === 'desempregado' ? 'selected' : '' }}>Desempregado</option>
                                    <option value="aposentado" {{ old('employment_status') === 'aposentado' ? 'selected' : '' }}>Aposentado</option>
                                    <option value="pensionista" {{ old('employment_status') === 'pensionista' ? 'selected' : '' }}>Pensionista</option>
                                    <option value="autonomo" {{ old('employment_status') === 'autonomo' ? 'selected' : '' }}>Autônomo</option>
                                </select>
                                @error('employment_status')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="workplace" class="form-label fw-semibold">
                                    <i class="ti-location-pin me-1"></i>Local de Trabalho
                                </label>
                                <input id="workplace" type="text" class="form-control @error('workplace') is-invalid @enderror"
                                       name="workplace" value="{{ old('workplace') }}"
                                       placeholder="Nome da empresa ou local onde trabalha">
                                @error('workplace')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Benefícios e Observações -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-star me-2"></i>Benefícios e Observações
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="receives_government_benefit" class="form-label fw-semibold">
                                    <i class="ti-help me-1"></i>Recebe benefício do governo?
                                </label>
                                <select id="receives_government_benefit" class="form-select @error('receives_government_benefit') is-invalid @enderror" name="receives_government_benefit">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ old('receives_government_benefit') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('receives_government_benefit') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                                @error('receives_government_benefit')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="government_benefit_type" class="form-label fw-semibold">
                                    <i class="ti-list me-1"></i>Qual benefício recebe?
                                </label>
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
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="has_documents" class="form-label fw-semibold">
                                    <i class="ti-files me-1"></i>Possui documentos básicos?
                                </label>
                                <select id="has_documents" class="form-select @error('has_documents') is-invalid @enderror" name="has_documents">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ old('has_documents') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('has_documents') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                                <small class="text-muted">
                                    <i class="ti-info-alt me-1"></i>RG, CPF, Comprovante de residência
                                </small>
                                @error('has_documents')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="observations" class="form-label fw-semibold">
                                    <i class="ti-comment me-1"></i>Observações
                                </label>
                                <textarea id="observations" class="form-control @error('observations') is-invalid @enderror"
                                          name="observations" rows="3"
                                          placeholder="Informações adicionais sobre o participante...">{{ old('observations') }}</textarea>
                                @error('observations')
                                    <div class="invalid-feedback">
                                        <i class="ti-alert-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti-check me-2"></i>Cadastrar Participante
                            </button>
                            <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">
                                <i class="ti-arrow-left me-2"></i>Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Painel de Ajuda -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title text-primary fw-bold mb-0">
                            <i class="ti-help me-2"></i>Guia de Cadastro
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3 text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 80px; height: 80px;">
                                <i class="ti-user-plus text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <p class="text-muted mt-2 mb-0">Novo Participante</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-semibold text-dark mb-3">Campos Obrigatórios</h6>
                            <div class="bg-light p-3 rounded">
                                <div class="mb-2">
                                    <i class="ti-check text-success me-1"></i>
                                    <small>Nome completo</small>
                                </div>
                                <div class="mb-2">
                                    <i class="ti-check text-success me-1"></i>
                                    <small>Tipo e número do documento</small>
                                </div>
                                <div class="mb-2">
                                    <i class="ti-check text-success me-1"></i>
                                    <small>Data de nascimento</small>
                                </div>
                                <div class="mb-2">
                                    <i class="ti-check text-success me-1"></i>
                                    <small>Endereço completo</small>
                                </div>
                                <div>
                                    <i class="ti-check text-success me-1"></i>
                                    <small>Número de pessoas na família</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-semibold text-dark mb-3">Dicas Importantes</h6>
                            <div class="bg-info bg-opacity-10 p-3 rounded border border-info">
                                <div class="mb-2">
                                    <i class="ti-lightbulb text-info me-1"></i>
                                    <small>Use sempre o nome completo do participante</small>
                                </div>
                                <div class="mb-2">
                                    <i class="ti-lightbulb text-info me-1"></i>
                                    <small>Verifique se o documento está válido</small>
                                </div>
                                <div class="mb-2">
                                    <i class="ti-lightbulb text-info me-1"></i>
                                    <small>Confirme o endereço com o participante</small>
                                </div>
                                <div>
                                    <i class="ti-lightbulb text-info me-1"></i>
                                    <small>A foto é opcional mas recomendada</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-semibold text-dark mb-3">Tipos de Documento</h6>
                            <div class="bg-light p-3 rounded">
                                <div class="mb-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary me-2">CPF</span>
                                    <small class="text-muted">Documento mais comum</small>
                                </div>
                                <div class="mb-2">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary me-2">RG</span>
                                    <small class="text-muted">Documento de identidade</small>
                                </div>
                                <div>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info me-2">CNH</span>
                                    <small class="text-muted">Carteira de motorista</small>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-semibold text-dark mb-3">Próximos Passos</h6>
                            <div class="bg-success bg-opacity-10 p-3 rounded border border-success">
                                <div class="mb-2 d-flex align-items-center">
                                    <span class="badge bg-success text-white rounded-circle me-2" style="width: 20px; height: 20px; font-size: 0.7rem;">1</span>
                                    <small>Preencher dados pessoais</small>
                                </div>
                                <div class="mb-2 d-flex align-items-center">
                                    <span class="badge bg-success text-white rounded-circle me-2" style="width: 20px; height: 20px; font-size: 0.7rem;">2</span>
                                    <small>Confirmar endereço</small>
                                </div>
                                <div class="mb-2 d-flex align-items-center">
                                    <span class="badge bg-success text-white rounded-circle me-2" style="width: 20px; height: 20px; font-size: 0.7rem;">3</span>
                                    <small>Adicionar informações familiares</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success text-white rounded-circle me-2" style="width: 20px; height: 20px; font-size: 0.7rem;">4</span>
                                    <small>Salvar cadastro</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .badge {
        font-size: 0.75rem;
    }

    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }

    .invalid-feedback {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Máscara para telefone
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (value.length >= 7) {
                value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
            } else if (value.length >= 3) {
                value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            } else if (value.length >= 1) {
                value = value.replace(/(\d{0,2})/, '($1');
            }
            e.target.value = value;
        });
    }

    // Máscara para CEP
    const zipInput = document.getElementById('zip_code');
    if (zipInput) {
        zipInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 6) {
                value = value.replace(/(\d{5})(\d{0,3})/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    // Habilitar/desabilitar campo de benefício
    const receiveBenefitSelect = document.getElementById('receives_government_benefit');
    const benefitTypeSelect = document.getElementById('government_benefit_type');

    if (receiveBenefitSelect && benefitTypeSelect) {
        receiveBenefitSelect.addEventListener('change', function() {
            if (this.value === '0') {
                benefitTypeSelect.value = '';
                benefitTypeSelect.disabled = true;
            } else {
                benefitTypeSelect.disabled = false;
            }
        });

        // Verificar estado inicial
        if (receiveBenefitSelect.value === '0') {
            benefitTypeSelect.disabled = true;
        }
    }
});
</script>
@endpush
