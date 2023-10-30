<script src="{{ asset(mix('assets/frontEnd/js/jquery.min.js')) }}"></script>
<script src="{{ asset(mix('assets/frontEnd/js/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/frontEnd/js/bootstrap.min.js')) }}"></script>
<script src="{{ asset(mix('assets/frontEnd/js/plugin/slick.min.js')) }}"></script>
<script src="{{ asset(mix('assets/frontEnd/js/plugin/html5lightbox.js')) }}"></script>
<script src="{{ asset(mix('assets/frontEnd/js/wow.min.js')) }}"></script>
<script src="{{ asset(mix('assets/frontEnd/js/script.js')) }}"></script>
<script>
    function selectLang(even) {
        $.ajax({
            url: "{{ route('web:select-lang') }}",
            type: 'POST',
            data: {
                locale: even.value,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response) {
                    location.reload();
                } else {
                    console.log(response);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>
