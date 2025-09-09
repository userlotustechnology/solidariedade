function statusToString(value){
    if(value == 1){
        return '<small class="badge badge-primary"><strong>AGENDADA</strong></small>';
    }else if(value == 2){
        return '<small class="badge badge-warning"><strong>CHECK-IN</strong></small>';
    }else if(value == 3){
        return '<small class="badge badge-success"><strong>ATENDIDO</strong></small>';
    }else if(value == 4){
        return '<small class="badge badge-danger"><strong>FALTA</strong></small>';
    }else if(value == 5){
        return '<small class="badge badge-danger"><strong>DESMARCADA</strong></small>';
    }else if(value == 6){
        return '<small class="badge badge-success"><strong>FATURADA</strong></small>';
    }else if(value == 7){
        return '<small class="badge badge-danger"><strong>NÃO ATENDIDO</strong></small>';
    }
}

function validarCPF(cpf) {
	var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;

	if (!filtro.test(cpf)) {
		window.alert("CPF inválido. Tente novamente.");
		return false;
	}

	cpf = remove(cpf, ".");
	cpf = remove(cpf, "-");

	if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111"
		|| cpf == "22222222222" || cpf == "33333333333"
		|| cpf == "44444444444" || cpf == "55555555555"
		|| cpf == "66666666666" || cpf == "77777777777"
		|| cpf == "88888888888" || cpf == "99999999999") {
		window.alert("CPF inválido. Tente novamente.");
		return false;
	}

	soma = 0;
	for (i = 0; i < 9; i++) {
		soma += parseInt(cpf.charAt(i)) * (10 - i);
	}

	resto = 11 - (soma % 11);
	if (resto == 10 || resto == 11) {
		resto = 0;
	}
	if (resto != parseInt(cpf.charAt(9))) {
		window.alert("CPF inválido. Tente novamente.");
		return false;
	}

	soma = 0;
	for (i = 0; i < 10; i++) {
		soma += parseInt(cpf.charAt(i)) * (11 - i);
	}
	resto = 11 - (soma % 11);
	if (resto == 10 || resto == 11) {
		resto = 0;
	}

	if (resto != parseInt(cpf.charAt(10))) {
		window.alert("CPF inválido. Tente novamente.");
		return false;
	}

	return true;
}

function remove(str, sub) {
	i = str.indexOf(sub);
	r = "";
	if (i == -1)
		return str;
	{
		r += str.substring(0, i) + remove(str.substring(i + sub.length), sub);
	}

	return r;
}

function mascara(o, f) {
	v_obj = o
	v_fun = f
	setTimeout("execmascara()", 1)
}

function cpf_mask(v) {
	v = v.replace(/\D/g, "")
	v = v.replace(/(\d{3})(\d)/, "$1.$2")
	v = v.replace(/(\d{3})(\d)/, "$1.$2")
	v = v.replace(/(\d{3})(\d)/, "$1-$2")
	return v
}

function formatar(mascara, documento) {
	var i = documento.value.length;
	var saida = mascara.substring(0, 1);
	var texto = mascara.substring(i)

	if (texto.substring(0, 1) != saida) {
		documento.value += texto.substring(0, 1);
	}

}

function validarCNPJ(ObjCnpj) {
	var cnpj = ObjCnpj.value;
	var valida = new Array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
	var dig1 = new Number;
	var dig2 = new Number;

	exp = /\.|\-|\//g
	cnpj = cnpj.toString().replace(exp, "");
	var digito = new Number(eval(cnpj.charAt(12) + cnpj.charAt(13)));

	for (i = 0; i < valida.length; i++) {
		dig1 += (i > 0 ? (cnpj.charAt(i - 1) * valida[i]) : 0);
		dig2 += cnpj.charAt(i) * valida[i];
	}
	dig1 = (((dig1 % 11) < 2) ? 0 : (11 - (dig1 % 11)));
	dig2 = (((dig2 % 11) < 2) ? 0 : (11 - (dig2 % 11)));

	if (((dig1 * 10) + dig2) != digito)
		alert('CNPJ Invalido!');

}

function mascaraMutuario(o, f) {
	v_obj = o
	v_fun = f
	setTimeout('execmascara()', 1)
}

function execmascara() {
	v_obj.value = v_fun(v_obj.value)
}

function cpfCnpj(v) {

	v = v.replace(/\D/g, "")

	if (v.length <= 14) { //CPF

		v = v.replace(/(\d{3})(\d)/, "$1.$2")

		v = v.replace(/(\d{3})(\d)/, "$1.$2")

		v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")

	} else {

		v = v.replace(/^(\d{2})(\d)/, "$1.$2")

		v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")

		v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")

		v = v.replace(/(\d{4})(\d)/, "$1-$2")

	}
	return v
}

function MascaraCNPJ(cnpj) {
	if (mascaraInteiro(cnpj) == false) {
		event.returnValue = false;
	}
	return formataCampo(cnpj, '00.000.000/0000-00', event);
}

function MascaraCep(cep) {
	if (mascaraInteiro(cep) == false) {
		event.returnValue = false;
	}
	return formataCampo(cep, '00.000-000', event);
}

function MascaraData(data) {
	if (mascaraInteiro(data) == false) {
		event.returnValue = false;
	}
	return formataCampo(data, '00/00/0000', event);
}

function MascaraTelefone(tel) {
	if (mascaraInteiro(tel) == false) {
		event.returnValue = false;
	}
	return formataCampo(tel, '(00) 00000-0000', event);
}

function MascaraCPF(cpf) {
	if (mascaraInteiro(cpf) == false) {
		event.returnValue = false;
	}
	return formataCampo(cpf, '000.000.000-00', event);
}

function ValidaTelefone(tel) {
	exp = /\(\d{2}\)\ \d{4}\-\d{4}/
	if (!exp.test(tel.value))
		alert('Numero de Telefone Invalido!');
}

function ValidaCep(cep) {
	exp = /\d{2}\.\d{3}\-\d{3}/
	if (!exp.test(cep.value))
		alert('Numero de Cep Invalido!');
}

function ValidaData(data) {
	exp = /\d{2}\/\d{2}\/\d{4}/
	if (!exp.test(data.value))
		alert('Data Invalida!');
}

function ValidarCPF(Objcpf) {
	var cpf = Objcpf.value;
	exp = /\.|\-/g
	cpf = cpf.toString().replace(exp, "");
	var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
	var soma1 = 0, soma2 = 0;
	var vlr = 11;

	for (i = 0; i < 9; i++) {
		soma1 += eval(cpf.charAt(i) * (vlr - 1));
		soma2 += eval(cpf.charAt(i) * vlr);
		vlr--;
	}
	soma1 = (((soma1 * 10) % 11) == 10 ? 0 : ((soma1 * 10) % 11));
	soma2 = (((soma2 + (2 * soma1)) * 10) % 11);

	var digitoGerado = (soma1 * 10) + soma2;
	if (digitoGerado != digitoDigitado)
		alert('CPF Invalido!');
}

function mascaraInteiro() {
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
		return false;
	}
	return true;
}

function ValidarCNPJ(ObjCnpj) {
	var cnpj = ObjCnpj.value;
	var valida = new Array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
	var dig1 = new Number;
	var dig2 = new Number;

	exp = /\.|\-|\//g
	cnpj = cnpj.toString().replace(exp, "");
	var digito = new Number(eval(cnpj.charAt(12) + cnpj.charAt(13)));

	for (i = 0; i < valida.length; i++) {
		dig1 += (i > 0 ? (cnpj.charAt(i - 1) * valida[i]) : 0);
		dig2 += cnpj.charAt(i) * valida[i];
	}
	dig1 = (((dig1 % 11) < 2) ? 0 : (11 - (dig1 % 11)));
	dig2 = (((dig2 % 11) < 2) ? 0 : (11 - (dig2 % 11)));

	if (((dig1 * 10) + dig2) != digito)
		alert('CNPJ Invalido!');

}

function formataCampo(campo, Mascara, evento) {
	var boleanoMascara;

	var Digitato = evento.keyCode;
	exp = /\-|\.|\/|\(|\)| /g
	campoSoNumeros = campo.value.toString().replace(exp, "");

	var posicaoCampo = 0;
	var NovoValorCampo = "";
	var TamanhoMascara = campoSoNumeros.length;
	;

	if (Digitato != 8) {
		for (i = 0; i <= TamanhoMascara; i++) {
			boleanoMascara = ((Mascara.charAt(i) == "-")
				|| (Mascara.charAt(i) == ".") || (Mascara.charAt(i) == "/"))
			boleanoMascara = boleanoMascara
				|| ((Mascara.charAt(i) == "(")
					|| (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
			if (boleanoMascara) {
				NovoValorCampo += Mascara.charAt(i);
				TamanhoMascara++;
			} else {
				NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
				posicaoCampo++;
			}
		}
		campo.value = NovoValorCampo;
		return true;
	} else {
		return true;
	}
}

function numberToReal(numero) {
	var num = Number(numero);
	var number = num.toFixed(2).split('.');
	number[0] = "R$ " + number[0].split(/(?=(?:...)*$)/).join('.');
	return number.join(',');
}

function monthByNumber(number) {
	switch (number) {
		case "1":
			text = "Janeiro";
		  	break;
		case "2":
			text = "Fevereiro";
		  	break;
		case "3":
			text = "Março";
		  	break;
		case "4":
			text = "Abril";
		  	break;
		case "5":
			text = "Maio";
		  	break;
		case "6":
			text = "Junho";
		  	break;
		case "7":
			text = "Julho";
		  	break;
		case "8":
			text = "Agosto";
		  	break;
		case "9":
			text = "Setembro";
		  	break;
		case "10":
			text = "Outubro";
		  	break;
		case "11":
			text = "Novembro";
		  	break;
		case "12":
			text = "Dezembro";
		  	break;
		default:
		  text = "Looking forward to the Weekend";
	  }
	  return text;
}

function moeda(a, e, r, t) {
	let n = ""
		, h = j = 0
		, u = tamanho2 = 0
		, l = ajd2 = ""
		, o = window.Event ? t.which : t.keyCode;
	if (13 == o || 8 == o)
		return !0;
	if (n = String.fromCharCode(o),
		-1 == "0123456789".indexOf(n))
		return !1;
	for (u = a.value.length,
		h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
		;
	for (l = ""; h < u; h++)
		-1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
	if (l += n,
		0 == (u = l.length) && (a.value = ""),
		1 == u && (a.value = "0" + r + "0" + l),
		2 == u && (a.value = "0" + r + l),
		u > 2) {
		for (ajd2 = "",
			j = 0,
			h = u - 3; h >= 0; h--)
			3 == j && (ajd2 += e,
				j = 0),
				ajd2 += l.charAt(h),
				j++;
		for (a.value = "",
			tamanho2 = ajd2.length,
			h = tamanho2 - 1; h >= 0; h--)
			a.value += ajd2.charAt(h);
		a.value += r + l.substr(u - 2, u)
	}
	return !1
}
