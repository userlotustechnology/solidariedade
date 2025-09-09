function new_entity(url, form, modal) {
	$.ajax({
		url : url,
		type : "POST",
		dataType : "JSON",
		data : $(form).serialize(),
		beforeSend : function() {
			swal.fire("Aguarde um instante...", { button: false });
		},
		success : function(data) {
            var msg = "Aguarde, página sendo atualizada";
            if(data.message !== null){
                msg = data.message;
            }
            swal.fire("Realizado com sucesso!", msg, "success");
            setTimeout(function() {
                location.reload();
            }, 1000);
		},
		error : function(data) {
			swal.fire("OPS!", data.message, "error");
		},
	});
}

function new_entity_with_file(url, form, modal) {
    let formData = new FormData($(form)[0]);
    let hasFile = $(form).find('input[type="file"]').length > 0;

    $.ajax({
        url : url,
        type : "POST",
        dataType : "JSON",
        data : formData,
        processData: !hasFile, // Don't process the files if there is a file input
        contentType: hasFile ? false : 'application/x-www-form-urlencoded; charset=UTF-8', // Set content type to false if there is a file input
        beforeSend : function() {
            swal.fire("Aguarde um instante...", { button: false });
        },
        success : function(data) {
            let msg = "Aguarde, página sendo atualizada";
            if(data.message !== null){
                msg = data.message;
            }
            swal.fire("Realizado com sucesso!", msg, "success");
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
        error : function(data) {
            swal.fire("OPS!", data.message, "error");
        },
    });
}

function update_entity(url, form, modal) {
	$.ajax({
		url : url,
		type : "PUT",
		dataType : "JSON",
		data : $(form).serialize(),
		beforeSend : function() {
			swal.fire("Aguarde um instante...", { button: false });
		},
		success : function(data) {
            var msg = "Aguarde, página sendo atualizada";
            if(data.message !== null){
                msg = data.message;
            }
            swal.fire("Realizado com sucesso!", msg, "success");
            setTimeout(function() {
                location.reload();
            }, 1000);
		},
		error : function(data) {
			swal.fire("OPS!", data.message, "error");
		},
	});
}
