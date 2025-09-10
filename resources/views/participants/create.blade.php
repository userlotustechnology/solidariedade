@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Novo Participante</h3>
                <h6 class="font-weight-normal mb-0">Cadastre um novo participante no sistema</h6>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Corrija os campos abaixo:
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<form action="{{ route('participants.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <!-- Dados Pessoais -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dados Pessoais</h4>

                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Digite o nome completo do participante"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_type">Tipo de Documento</label>
                                <select class="form-control @error('document_type') is-invalid @enderror"
                                        id="document_type"
                                        name="document_type"
                                        required>
                                    <option value="">Selecione</option>
                                    <option value="CPF" {{ old('document_type') === 'CPF' ? 'selected' : '' }}>CPF</option>
                                    <option value="RG" {{ old('document_type') === 'RG' ? 'selected' : '' }}>RG</option>
                                    <option value="CNH" {{ old('document_type') === 'CNH' ? 'selected' : '' }}>CNH</option>
                                </select>
                                @error('document_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_number">Número do Documento</label>
                                <input type="text"
                                       class="form-control @error('document_number') is-invalid @enderror"
                                       id="document_number"
                                       name="document_number"
                                       value="{{ old('document_number') }}"
                                       placeholder="Número do documento"
                                       required>
                                @error('document_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth_date">Data de Nascimento</label>
                                <input type="date"
                                       class="form-control @error('birth_date') is-invalid @enderror"
                                       id="birth_date"
                                       name="birth_date"
                                       value="{{ old('birth_date') }}"
                                       required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">Gênero</label>
                                <select class="form-control @error('gender') is-invalid @enderror"
                                        id="gender"
                                        name="gender">
                                    <option value="">Não informar</option>
                                    <option value="M" {{ old('gender') === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gender') === 'F' ? 'selected' : '' }}>Feminino</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Outro</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="marital_status">Estado Civil</label>
                                <select class="form-control @error('marital_status') is-invalid @enderror"
                                        id="marital_status"
                                        name="marital_status">
                                    <option value="">Selecione</option>
                                    <option value="solteiro" {{ old('marital_status') === 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                                    <option value="casado" {{ old('marital_status') === 'casado' ? 'selected' : '' }}>Casado(a)</option>
                                    <option value="divorciado" {{ old('marital_status') === 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                                    <option value="viuvo" {{ old('marital_status') === 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                                    <option value="uniao_estavel" {{ old('marital_status') === 'uniao_estavel' ? 'selected' : '' }}>União Estável</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Celular</label>
                                <input type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="(11) 99999-9999">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="email@exemplo.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">Foto do Participante</label>
                        <input type="file"
                               class="form-control @error('photo') is-invalid @enderror"
                               id="photo"
                               name="photo"
                               accept="image/*">
                        <small class="form-text text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar de Informações -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações</h4>

                    <div class="mb-3 text-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width: 100px; height: 100px;">
                            <i class="ti-user" style="font-size: 2.5rem; color: #ccc;"></i>
                        </div>
                        <p class="text-muted mt-2 small">Foto do participante</p>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Status do Participante</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="d-flex align-items-center">
                                <i class="ti-user text-primary me-2"></i>
                                <div>
                                    <strong>Ativo</strong>
                                    <br>
                                    <small class="text-muted">Participante ativo no sistema</small>
                                </div>
                            </div>
                        </div>
                        <small class="form-text text-muted">Participantes são criados como ativos por padrão</small>
                    </div>

                    <div class="form-group">
                        <div class="mb-2">
                            <strong>Funcionalidades</strong>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <div class="mb-2">
                                <i class="ti-package text-success me-1"></i>
                                <small>Pode receber entregas</small>
                            </div>
                            <div class="mb-2">
                                <i class="ti-printer text-primary me-1"></i>
                                <small>Geração de carteirinha</small>
                            </div>
                            <div>
                                <i class="ti-clipboard text-info me-1"></i>
                                <small>Histórico de entregas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Endereço -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Endereço</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Endereço Completo</label>
                                <input type="text"
                                       class="form-control @error('address') is-invalid @enderror"
                                       id="address"
                                       name="address"
                                       value="{{ old('address') }}"
                                       placeholder="Rua, Avenida, número"
                                       required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address_complement">Complemento</label>
                                <input type="text"
                                       class="form-control @error('address_complement') is-invalid @enderror"
                                       id="address_complement"
                                       name="address_complement"
                                       value="{{ old('address_complement') }}"
                                       placeholder="Apto, casa, bloco">
                                @error('address_complement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="neighborhood">Bairro</label>
                                <input type="text"
                                       class="form-control @error('neighborhood') is-invalid @enderror"
                                       id="neighborhood"
                                       name="neighborhood"
                                       value="{{ old('neighborhood') }}"
                                       placeholder="Nome do bairro"
                                       required>
                                @error('neighborhood')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input type="text"
                                       class="form-control @error('city') is-invalid @enderror"
                                       id="city"
                                       name="city"
                                       value="{{ old('city') }}"
                                       placeholder="Nome da cidade"
                                       required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <select class="form-control @error('state') is-invalid @enderror"
                                        id="state"
                                        name="state"
                                        required>
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">CEP</label>
                                <input type="text"
                                       class="form-control @error('zip_code') is-invalid @enderror"
                                       id="zip_code"
                                       name="zip_code"
                                       value="{{ old('zip_code') }}"
                                       placeholder="00000-000">
                                @error('zip_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informações Socioeconômicas -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações Socioeconômicas</h4>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="family_income">Renda Familiar</label>
                                <select class="form-control @error('family_income') is-invalid @enderror"
                                        id="family_income"
                                        name="family_income">
                                    <option value="">Selecione</option>
                                    <option value="ate_1_salario" {{ old('family_income') === 'ate_1_salario' ? 'selected' : '' }}>Até 1 salário mínimo</option>
                                    <option value="1_a_2_salarios" {{ old('family_income') === '1_a_2_salarios' ? 'selected' : '' }}>De 1 a 2 salários mínimos</option>
                                    <option value="2_a_3_salarios" {{ old('family_income') === '2_a_3_salarios' ? 'selected' : '' }}>De 2 a 3 salários mínimos</option>
                                    <option value="3_a_5_salarios" {{ old('family_income') === '3_a_5_salarios' ? 'selected' : '' }}>De 3 a 5 salários mínimos</option>
                                    <option value="acima_5_salarios" {{ old('family_income') === 'acima_5_salarios' ? 'selected' : '' }}>Acima de 5 salários mínimos</option>
                                </select>
                                @error('family_income')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="family_members">Membros da Família</label>
                                <input type="number"
                                       class="form-control @error('family_members') is-invalid @enderror"
                                       id="family_members"
                                       name="family_members"
                                       value="{{ old('family_members') }}"
                                       placeholder="Número de pessoas na família"
                                       min="1">
                                @error('family_members')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="has_special_needs">Necessidades Especiais</label>
                                <select class="form-control @error('has_special_needs') is-invalid @enderror"
                                        id="has_special_needs"
                                        name="has_special_needs">
                                    <option value="0" {{ old('has_special_needs') === '0' ? 'selected' : '' }}>Não</option>
                                    <option value="1" {{ old('has_special_needs') === '1' ? 'selected' : '' }}>Sim</option>
                                </select>
                                @error('has_special_needs')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="additional_notes">Observações Adicionais</label>
                        <textarea class="form-control @error('additional_notes') is-invalid @enderror"
                                  id="additional_notes"
                                  name="additional_notes"
                                  rows="3"
                                  placeholder="Informações adicionais sobre o participante">{{ old('additional_notes') }}</textarea>
                        @error('additional_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">
                            <i class="ti-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-check"></i> Cadastrar Participante
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
