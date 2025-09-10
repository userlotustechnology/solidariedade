@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Editar Participante</h3>
                <h6 class="font-weight-normal mb-0">Atualize as informações do participante {{ $participant->name }}</h6>
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

<form action="{{ route('participants.update', $participant) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Informações Pessoais -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações Pessoais</h4>

                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $participant->name) }}"
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
                                <select id="document_type" class="form-control @error('document_type') is-invalid @enderror" name="document_type" required>
                                    <option value="">Selecione</option>
                                    <option value="CPF" {{ old('document_type', $participant->document_type) === 'CPF' ? 'selected' : '' }}>CPF</option>
                                    <option value="RG" {{ old('document_type', $participant->document_type) === 'RG' ? 'selected' : '' }}>RG</option>
                                    <option value="CNH" {{ old('document_type', $participant->document_type) === 'CNH' ? 'selected' : '' }}>CNH</option>
                                    <option value="Passaporte" {{ old('document_type', $participant->document_type) === 'Passaporte' ? 'selected' : '' }}>Passaporte</option>
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
                                       value="{{ old('document_number', $participant->document_number) }}"
                                       placeholder="Digite o número do documento"
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
                                       value="{{ old('birth_date', $participant->birth_date->format('Y-m-d')) }}"
                                       required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">Gênero</label>
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">Não informar</option>
                                    <option value="M" {{ old('gender', $participant->gender) === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gender', $participant->gender) === 'F' ? 'selected' : '' }}>Feminino</option>
                                    <option value="Other" {{ old('gender', $participant->gender) === 'Other' ? 'selected' : '' }}>Outro</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="marital_status">Estado Civil</label>
                                <select id="marital_status" class="form-control @error('marital_status') is-invalid @enderror" name="marital_status">
                                    <option value="">Selecione</option>
                                    <option value="solteiro" {{ old('marital_status', $participant->marital_status) === 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                                    <option value="casado" {{ old('marital_status', $participant->marital_status) === 'casado' ? 'selected' : '' }}>Casado(a)</option>
                                    <option value="divorciado" {{ old('marital_status', $participant->marital_status) === 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                                    <option value="viuvo" {{ old('marital_status', $participant->marital_status) === 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                                    <option value="uniao_estavel" {{ old('marital_status', $participant->marital_status) === 'uniao_estavel' ? 'selected' : '' }}>União Estável</option>
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
                                       value="{{ old('phone', $participant->formatted_phone) }}"
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
                                       value="{{ old('email', $participant->email) }}"
                                       placeholder="usuario@exemplo.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Foto do Participante -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Foto do Participante</h4>

                    @if($participant->photo)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $participant->photo) }}"
                                 alt="Foto do participante"
                                 class="img-fluid rounded"
                                 style="max-height: 200px; max-width: 100%;">
                            <p class="text-muted mt-2 mb-0">Foto atual</p>
                        </div>
                    @else
                        <div class="text-center mb-3">
                            <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 200px;">
                                <i class="mdi mdi-account-box-outline" style="font-size: 4rem; color: #ccc;"></i>
                            </div>
                            <p class="text-muted mt-2 mb-0">Nenhuma foto cadastrada</p>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="photo">Alterar Foto</label>
                        <input type="file"
                               class="form-control @error('photo') is-invalid @enderror"
                               id="photo"
                               name="photo"
                               accept="image/*">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Formato aceito: JPG, PNG, GIF (máx. 2MB)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Endereço -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Endereço</h4>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zipcode">CEP</label>
                                <input type="text"
                                       class="form-control @error('zipcode') is-invalid @enderror"
                                       id="zipcode"
                                       name="zipcode"
                                       value="{{ old('zipcode', $participant->zipcode) }}"
                                       placeholder="00000-000">
                                @error('zipcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="address">Logradouro</label>
                                <input type="text"
                                       class="form-control @error('address') is-invalid @enderror"
                                       id="address"
                                       name="address"
                                       value="{{ old('address', $participant->address) }}"
                                       placeholder="Rua, Avenida, etc.">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address_number">Número</label>
                                <input type="text"
                                       class="form-control @error('address_number') is-invalid @enderror"
                                       id="address_number"
                                       name="address_number"
                                       value="{{ old('address_number', $participant->address_number) }}"
                                       placeholder="123">
                                @error('address_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="address_complement">Complemento</label>
                                <input type="text"
                                       class="form-control @error('address_complement') is-invalid @enderror"
                                       id="address_complement"
                                       name="address_complement"
                                       value="{{ old('address_complement', $participant->address_complement) }}"
                                       placeholder="Apto, Bloco, etc.">
                                @error('address_complement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="neighborhood">Bairro</label>
                                <input type="text"
                                       class="form-control @error('neighborhood') is-invalid @enderror"
                                       id="neighborhood"
                                       name="neighborhood"
                                       value="{{ old('neighborhood', $participant->neighborhood) }}"
                                       placeholder="Nome do bairro">
                                @error('neighborhood')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input type="text"
                                       class="form-control @error('city') is-invalid @enderror"
                                       id="city"
                                       name="city"
                                       value="{{ old('city', $participant->city) }}"
                                       placeholder="Nome da cidade">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="state">UF</label>
                                <select id="state" class="form-control @error('state') is-invalid @enderror" name="state">
                                    <option value="">UF</option>
                                    <option value="AC" {{ old('state', $participant->state) === 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="AL" {{ old('state', $participant->state) === 'AL' ? 'selected' : '' }}>AL</option>
                                    <option value="AP" {{ old('state', $participant->state) === 'AP' ? 'selected' : '' }}>AP</option>
                                    <option value="AM" {{ old('state', $participant->state) === 'AM' ? 'selected' : '' }}>AM</option>
                                    <option value="BA" {{ old('state', $participant->state) === 'BA' ? 'selected' : '' }}>BA</option>
                                    <option value="CE" {{ old('state', $participant->state) === 'CE' ? 'selected' : '' }}>CE</option>
                                    <option value="DF" {{ old('state', $participant->state) === 'DF' ? 'selected' : '' }}>DF</option>
                                    <option value="ES" {{ old('state', $participant->state) === 'ES' ? 'selected' : '' }}>ES</option>
                                    <option value="GO" {{ old('state', $participant->state) === 'GO' ? 'selected' : '' }}>GO</option>
                                    <option value="MA" {{ old('state', $participant->state) === 'MA' ? 'selected' : '' }}>MA</option>
                                    <option value="MT" {{ old('state', $participant->state) === 'MT' ? 'selected' : '' }}>MT</option>
                                    <option value="MS" {{ old('state', $participant->state) === 'MS' ? 'selected' : '' }}>MS</option>
                                    <option value="MG" {{ old('state', $participant->state) === 'MG' ? 'selected' : '' }}>MG</option>
                                    <option value="PA" {{ old('state', $participant->state) === 'PA' ? 'selected' : '' }}>PA</option>
                                    <option value="PB" {{ old('state', $participant->state) === 'PB' ? 'selected' : '' }}>PB</option>
                                    <option value="PR" {{ old('state', $participant->state) === 'PR' ? 'selected' : '' }}>PR</option>
                                    <option value="PE" {{ old('state', $participant->state) === 'PE' ? 'selected' : '' }}>PE</option>
                                    <option value="PI" {{ old('state', $participant->state) === 'PI' ? 'selected' : '' }}>PI</option>
                                    <option value="RJ" {{ old('state', $participant->state) === 'RJ' ? 'selected' : '' }}>RJ</option>
                                    <option value="RN" {{ old('state', $participant->state) === 'RN' ? 'selected' : '' }}>RN</option>
                                    <option value="RS" {{ old('state', $participant->state) === 'RS' ? 'selected' : '' }}>RS</option>
                                    <option value="RO" {{ old('state', $participant->state) === 'RO' ? 'selected' : '' }}>RO</option>
                                    <option value="RR" {{ old('state', $participant->state) === 'RR' ? 'selected' : '' }}>RR</option>
                                    <option value="SC" {{ old('state', $participant->state) === 'SC' ? 'selected' : '' }}>SC</option>
                                    <option value="SP" {{ old('state', $participant->state) === 'SP' ? 'selected' : '' }}>SP</option>
                                    <option value="SE" {{ old('state', $participant->state) === 'SE' ? 'selected' : '' }}>SE</option>
                                    <option value="TO" {{ old('state', $participant->state) === 'TO' ? 'selected' : '' }}>TO</option>
                                </select>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações Socioeconômicas -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações Socioeconômicas</h4>

                    <div class="form-group">
                        <label for="receives_government_benefit">Recebe Benefício do Governo?</label>
                        <select id="receives_government_benefit" class="form-control @error('receives_government_benefit') is-invalid @enderror" name="receives_government_benefit">
                            <option value="">Selecione</option>
                            <option value="1" {{ old('receives_government_benefit', $participant->receives_government_benefit) == '1' ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ old('receives_government_benefit', $participant->receives_government_benefit) == '0' ? 'selected' : '' }}>Não</option>
                        </select>
                        @error('receives_government_benefit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" id="benefit_type_group" style="{{ old('receives_government_benefit', $participant->receives_government_benefit) == '1' ? '' : 'display: none;' }}">
                        <label for="benefit_type">Tipo de Benefício</label>
                        <select id="benefit_type" class="form-control @error('benefit_type') is-invalid @enderror" name="benefit_type">
                            <option value="">Selecione o benefício</option>
                            <option value="Bolsa Família" {{ old('benefit_type', $participant->benefit_type) === 'Bolsa Família' ? 'selected' : '' }}>Bolsa Família</option>
                            <option value="Auxílio Brasil" {{ old('benefit_type', $participant->benefit_type) === 'Auxílio Brasil' ? 'selected' : '' }}>Auxílio Brasil</option>
                            <option value="BPC" {{ old('benefit_type', $participant->benefit_type) === 'BPC' ? 'selected' : '' }}>BPC</option>
                            <option value="Auxílio Emergencial" {{ old('benefit_type', $participant->benefit_type) === 'Auxílio Emergencial' ? 'selected' : '' }}>Auxílio Emergencial</option>
                            <option value="Outros" {{ old('benefit_type', $participant->benefit_type) === 'Outros' ? 'selected' : '' }}>Outros</option>
                        </select>
                        @error('benefit_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="family_members">Quantidade de Pessoas na Família</label>
                                <input type="number"
                                       class="form-control @error('family_members') is-invalid @enderror"
                                       id="family_members"
                                       name="family_members"
                                       value="{{ old('family_members', $participant->family_members) }}"
                                       min="1"
                                       placeholder="Ex: 4">
                                @error('family_members')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monthly_income">Renda Mensal Familiar (R$)</label>
                                <input type="number"
                                       class="form-control @error('monthly_income') is-invalid @enderror"
                                       id="monthly_income"
                                       name="monthly_income"
                                       value="{{ old('monthly_income', $participant->monthly_income) }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="Ex: 1200.00">
                                @error('monthly_income')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="observations">Observações</label>
                        <textarea class="form-control @error('observations') is-invalid @enderror"
                                  id="observations"
                                  name="observations"
                                  rows="3"
                                  placeholder="Informações adicionais sobre o participante">{{ old('observations', $participant->observations) }}</textarea>
                        @error('observations')
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
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('participants.show', $participant) }}" class="btn btn-light">
                        <i class="mdi mdi-arrow-left"></i> Voltar
                    </a>
                </div>
                <div>
                    <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-cancel"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary ml-2">
                        <i class="mdi mdi-content-save"></i> Salvar Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Controle do campo de tipo de benefício
    const benefitSelect = document.getElementById('receives_government_benefit');
    const benefitTypeGroup = document.getElementById('benefit_type_group');
    const benefitTypeSelect = document.getElementById('benefit_type');

    benefitSelect.addEventListener('change', function() {
        if (this.value === '1') {
            benefitTypeGroup.style.display = 'block';
            benefitTypeSelect.setAttribute('required', 'required');
        } else {
            benefitTypeGroup.style.display = 'none';
            benefitTypeSelect.removeAttribute('required');
            benefitTypeSelect.value = '';
        }
    });

    // Máscara para telefone
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            if (value.length === 14) {
                e.target.value = value;
            } else if (value.length < 14) {
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                e.target.value = value;
            }
        }
    });

    // Máscara para CEP
    const zipcodeInput = document.getElementById('zipcode');
    zipcodeInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 8) {
            value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
            e.target.value = value;
        }
    });
});
</script>

@endsection
