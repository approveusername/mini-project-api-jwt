<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>post</title>
</head>
<body>
    <div class="container mt-5">
        <form id="post_form" class="">
            <div class="mt-2">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" rows="4" required></textarea>
            </div>
            <button type="submit" class="">Create</button>
        </form>

        @if($post_found)
        <table class="table">
            <thead>
                <tr><th>S.No. (id)</th><th>Title</th><th>Content</th><th>Actions</th></tr>
            </thead>
            <tbody id="post_manage"> </tbody>
        </table>
        @else
          <h6>No post here</h6>
        @endif
    </div>

    <div class="modal fade" id="editPostModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editPostForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit this post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editPostId">
                        <div class="">
                            <label for="edit_title" class="form-label">Title</label>
                            <input type="text" id="edit_title" name="title" required>
                        </div>
                        <div class="mt-3">
                            <label for="edit_content" class="form-label">content</label>
                            <textarea id="edit_content" name="content" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-seconday" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        manage_posts();

        function manage_posts() {
            $.ajax({
                url: '/api/posts',
                type: 'get',
                data: {"_token": "{{ csrf_token() }}"},
                // dataType : 'json',
                success: function(posts) {
                    // console.log(posts)
                    let rows = '';
                    posts.forEach(function(post) {
                        rows += `<tr><td>${post.id}</td><td>${post.title}</td><td>${post.content}</td><td>
                                    <button class="btn btn-sm" onclick="editPost(${post.id}, '${post.title}', '${post.content}')">Edit</button>
                                    <button class="btn btn-sm" onclick="deletePost(${post.id})">Delete</button>
                                </td>
                            </tr>`;
                    });
                    $('#post_manage').html(rows);
                },
                error: function(err) {
                    alert('something wrong!please try again.');
                }
            });
        }


        $('#post_form').on('submit', function(e) {
            e.preventDefault();
            let data = {
                title: $('#title').val(),
                content: $('#content').val(),
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: '/api/posts',
                type: 'post',
                data: data,
                success: function(response) {
                    console.log(response)
                    alert(response.message);
                    manage_posts();
                    $('#post_form')[0].reset();
                },
                error: function(err) {
                    alert('error! please try again later');
                }
            });
        });

        function editPost(id, title, content) {
            $('#editPostId').val(id);
            $('#edit_title').val(title);
            $('#edit_content').val(content);
                $('#editPostModal').modal('show');
        }

        $('#editPostForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#editPostId').val();
            let data = {
                title: $('#edit_title').val(),
                content: $('#edit_content').val(),
                _token: "{{ csrf_token() }}",
            };
            $.ajax({
            url: '/api/posts/'+id,
            type: 'put',
            data: data,
            success: function(response) {
                alert(response.message);
                $('#editPostModal').modal('hide');
                manage_posts();
            },
            error: function(err) {
                alert('something worng!');
                // alert(err.responseJSON.message+' some err!');
            }
            });
        });

        function deletePost(id) {
            if (confirm('Are you sure you want to delete this post?')) {
                $.ajax({
                    url: '/api/posts/'+id,
                    type: 'delete',
                    data:  {"_token": "{{ csrf_token()}}"},
                    success: function(response) {
                        alert(response.message);
                        manage_posts();
                    },
                    error: function(err) {
                        alert('something worng!');
                    }
                });
            }
        }

    </script>

</body>
</html>
