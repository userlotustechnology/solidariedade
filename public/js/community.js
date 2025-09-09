function likePost(communityId, postId) {
    $.ajax({
        url: `/students/communities/${communityId}/posts/${postId}/like`,
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
            // Desabilita o botão durante a requisição
            $(`#like-button-${postId}`).prop('disabled', true);
        },
        success: function(data) {
            const likesCount = $(`#likes-count-${postId}`);
            const likeButton = $(`#like-button-${postId}`);

            likesCount.text(data.likes_count);

            if (data.action === 'liked') {
                likeButton.addClass('active');
            } else {
                likeButton.removeClass('active');
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            const errorMessage = response?.error || 'Ocorreu um erro ao curtir o post. Tente novamente.';

            // Mostra o erro usando o sistema de toast já presente na aplicação
            if (typeof $.toast === 'function') {
                $.toast({
                    heading: 'Erro',
                    text: errorMessage,
                    showHideTransition: 'slide',
                    icon: 'error',
                    position: 'top-right'
                });
            } else {
                alert(errorMessage);
            }
        },
        complete: function() {
            // Reabilita o botão após a requisição
            $(`#like-button-${postId}`).prop('disabled', false);
        }
    });
}

function showComments(postId) {
    const commentsSection = $(`#comments-section-${postId}`);
    commentsSection.slideToggle();
}

function submitComment(event, communityId, postId) {
    event.preventDefault();
    const input = $(`#comment-input-${postId}`);
    const content = input.val().trim();

    if (!content) return;

    $.ajax({
        url: `/students/communities/${communityId}/posts/${postId}/comment`,
        type: 'POST',
        dataType: 'JSON',
        data: { content: content },
        beforeSend: function() {
            input.prop('disabled', true);
        },
        success: function(data) {
            const commentsList = $(`#comments-list-${postId}`);
            const commentsCount = $(`#comments-count-${postId}`);

            // Adiciona o novo comentário à lista
            const newComment = `
                <div class="d-flex mb-3" id="comment-${data.comment.id}">
                    <img src="${data.comment.user.avatar_url}"
                        class="rounded-circle me-2"
                        alt="${data.comment.user.name}"
                        width="32"
                        height="32"
                        style="object-fit: cover;">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-0">${data.comment.user.name}</h6>
                                <small class="text-muted">${data.comment.created_at}</small>
                            </div>
                            <button class="btn btn-link text-danger btn-sm p-0"
                                    onclick="deleteComment('${communityId}', '${postId}', '${data.comment.id}')">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                        <p class="mb-0">${data.comment.content}</p>
                    </div>
                </div>
            `;
            commentsList.prepend(newComment);
            commentsCount.text(data.comments_count);
            input.val('');
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            const errorMessage = response?.error || 'Ocorreu um erro ao enviar o comentário. Tente novamente.';

            if (typeof $.toast === 'function') {
                $.toast({
                    heading: 'Erro',
                    text: errorMessage,
                    showHideTransition: 'slide',
                    icon: 'error',
                    position: 'top-right'
                });
            } else {
                alert(errorMessage);
            }
        },
        complete: function() {
            input.prop('disabled', false);
        }
    });
}

function deleteComment(communityId, postId, commentId) {
    if (!confirm('Tem certeza que deseja excluir este comentário?')) {
        return;
    }

    $.ajax({
        url: `/students/communities/${communityId}/posts/${postId}/comments/${commentId}`,
        type: 'DELETE',
        dataType: 'JSON',
        success: function(data) {
            const commentElement = $(`#comment-${commentId}`);
            const commentsCount = $(`#comments-count-${postId}`);

            commentElement.fadeOut(function() {
                $(this).remove();
            });
            commentsCount.text(data.comments_count);

            if (typeof $.toast === 'function') {
                $.toast({
                    heading: 'Sucesso',
                    text: 'Comentário excluído com sucesso.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right'
                });
            }
        },
        error: function(xhr) {
            const response = xhr.responseJSON;
            const errorMessage = response?.error || 'Ocorreu um erro ao excluir o comentário. Tente novamente.';

            if (typeof $.toast === 'function') {
                $.toast({
                    heading: 'Erro',
                    text: errorMessage,
                    showHideTransition: 'slide',
                    icon: 'error',
                    position: 'top-right'
                });
            } else {
                alert(errorMessage);
            }
        }
    });
}
