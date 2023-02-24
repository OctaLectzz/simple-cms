$(document).ready(function() {
    $('.btn-edit-comment').on('click', function() {
        let commentId = $(this).data('comment-id');
        let commentContent = $(this).siblings('p').text();
        $('#editCommentForm').attr('action', '/comments/' + commentId);
        $('#editCommentContent').val(commentContent);
        $('#editCommentModal').modal('show');
    });
});