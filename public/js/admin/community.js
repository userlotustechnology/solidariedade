function removeMember(communityUuid, memberUuid, memberName, memberType = 'membro') {
    let title, message;
    
    switch(memberType) {
        case 'pending':
            title = 'Remover Solicitação';
            message = `Tem certeza que deseja remover a solicitação de <strong>${memberName}</strong>?<br><br>
                      <small class="text-muted">Esta ação cancelará a solicitação de participação.</small>`;
            break;
        case 'rejected':
            title = 'Remover Registro';
            message = `Tem certeza que deseja remover o registro de rejeição de <strong>${memberName}</strong>?<br><br>
                      <small class="text-muted">Esta ação removerá o histórico de rejeição.</small>`;
            break;
        default:
            title = 'Remover Membro';
            message = `Tem certeza que deseja remover <strong>${memberName}</strong> desta comunidade?<br><br>
                      <small class="text-muted">Esta ação não poderá ser desfeita.</small>`;
    }

    Swal.fire({
        title: title,
        html: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, remover',
        cancelButtonText: 'Não, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostra loading
            Swal.fire({
                title: 'Processando...',
                html: 'Por favor, aguarde enquanto processamos sua solicitação.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Envia a requisição de remoção
            const form = document.createElement('form');
            form.method = 'POST';
            
            // Verifica se removeMemberUrl está definida
            if (typeof removeMemberUrl === 'undefined') {
                console.error('removeMemberUrl is not defined!');
                alert('Erro: URL de remoção não definida. Verifique o console.');
                return;
            }
            
            form.action = removeMemberUrl.replace(':memberUuid', memberUuid);
            
            console.log('Form action:', form.action);
            console.log('Member UUID:', memberUuid);
            console.log('RemoveMemberUrl:', removeMemberUrl);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            const csrfField = document.createElement('input');
            csrfField.type = 'hidden';
            csrfField.name = '_token';
            csrfField.value = csrfToken;

            form.appendChild(methodField);
            form.appendChild(csrfField);
            document.body.appendChild(form);

            console.log('Submitting form to:', form.action);
            console.log('Form method:', form.method);
            console.log('Form _method:', methodField.value);
            
            form.submit();
        }
    });
}
