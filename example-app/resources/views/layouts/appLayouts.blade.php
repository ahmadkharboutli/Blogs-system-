<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <link rel="stylesheet" href="{{ asset('admin/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
        <!-- Navbar Brand-->
        <div>
            <a class="navbar-brand ps-3" href="{{ route('posts.index') }}">Blog system</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
        </div>
        <div>
            <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="POST"
                action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm order-1 order-lg-0 me-4 me-lg-0 " type="submit">Log
                    out</button>
            </form>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('posts.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Posts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('posts.create') }}">Add posts</a>
                                <a class="nav-link" href="{{ route('posts.allPosts') }}">View All posts</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="{{ route('adminProfile.edit') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Profile
                        </a>
                    </div>

            </nav>
        </div>

        <div id="layoutSidenav_content">
            @yield('content')
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright © Hyber blogs 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            ·
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('admin/js/datatables-simple-demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/word_counter.min.js"></script>

    @if (Route::currentRouteName() == 'posts.edit' || Route::currentRouteName() == 'posts.create')
        <script>
            // Initialize the Froala Editor with the desired configuration
            var editor = new FroalaEditor('#example', {
                charCounterCount: true, // Enable character count display
                charCounterMax: 900000, // Set the maximum character limit
                wordCounterCount: true, // Enable word count display
                wordCounterMax: 300000, // Set the maximum word limit
            }, function() {
                var description = {!! json_encode($post->description) !!};
                this.html.set(description);
            });
        </script>
    @endif


    <script>
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var postId = button.getAttribute('data-id'); // Extract info from data-* attributes
            var form = deleteModal.querySelector('#deleteForm');
            form.action = '/admin/posts/' + postId; // Update this to match your route
        });
    </script>
    <script>
        var deleteModal2 = document.getElementById('deleteModal2');
        deleteModal2.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var postId = button.getAttribute('data-id'); // Extract info from data-* attributes
            var form = deleteModal2.querySelector('#deleteForm2');
            form.action = '/admin/posts/forceDelete/' + postId; // Update this to match your route
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#sort-date').click(function() {
                $.ajax({
                    url: '{{ route('posts.sort-by-date') }}',
                    type: 'GET',
                    success: function(data) {
                        updateTable(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        function updateTable(posts) {
            var tbody = $('#posts-table');
            tbody.empty();
            $.each(posts, function(index, post) {
                var row = '<tr>' +
                    '<td>' + post.id + '</td>' +
                    '<td>' + post.title + '</td>' +
                    '<td>' + post.description + '</td>' +
                    '<td>' + (post.user ? post.user.name : 'N/A') + '</td>' +
                    '<td>' + formatDate(post.created_at) + '</td>' +

                    '</tr>';
                tbody.append(row);
            });
        }

        function formatDate(dateString) {
            var options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            };
            return new Date(dateString).toLocaleDateString('en-GB', options).replace(',', '');
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const descriptions = document.querySelectorAll('#description');
            descriptions.forEach(description => {
                let wordCount = description.innerText.trim().split(/\s+/).length;

                function round(value, precision) {
                    var multiplier = Math.pow(10, precision || 0);
                    return Math.round(value * multiplier) / multiplier;
                }
                const timeCount = round(wordCount / 200, 1);
                description.closest('.card-body').querySelector('#time-count').innerText =
                    `${timeCount} min read`;
            });
        });
    </script>




</body>

</html>
