<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Timing</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        @if (auth()->check())
        <li class="nav-item">
          <form id="logout_form">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li>
        @endif
      </ul>
    </div>
  </div>
  </nav>

  <script>
    $(document).on('submit','#logout_form',function(event){
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"/user/logout",
                type:"POST",
                processData: false,
                contentType: false,
                cache: false,
                data:formData,
                success:function(response){
                    $('#responseMessage').removeClass('d-none');
                    $('#responseMessage').text(response.message);
                    setTimeout(() => {
                        $('#responseMessage').addClass('d-none');
                        location.reload();
                    }, 2000);
                },
                error: function(xhr) {
                        var errors = xhr.responseJSON.error;
                        $.each(errors, function(i, item) {
                            $(".errors").append("<li class='alert alert-danger'>"+item+"</li>")
                        });
                        setTimeout(() => {
                            $('.errors').empty();
                        }, 3000);
            }
        });
    });
    </script>